<?php

namespace Laraveldaily\Quickadmin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Laraveldaily\Quickadmin\Builders\ConfigBuilder;
use Laraveldaily\Quickadmin\Builders\DataSeederBuilder;
use Laraveldaily\Quickadmin\Builders\GateBuilder;
use Laraveldaily\Quickadmin\Builders\ProviderBuilder;
use Laraveldaily\Quickadmin\Builders\RoutesBuilder;
use Laraveldaily\Quickadmin\Builders\SeederBuilder;
use Laraveldaily\Quickadmin\Builders\SidebarBuilder;
use Laraveldaily\Quickadmin\Models\Files;
use Laraveldaily\Quickadmin\Models\Menu;
use Laraveldaily\Quickadmin\Models\ProjectMenus;
use Laraveldaily\Quickadmin\Models\Projects;
use Laraveldaily\Quickadmin\Models\RolePermissions;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use ZipArchive;

class JSZipController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
		return view('admin.jszip.index');
	}

	public function download($id){

//		if(in_array(2, [1, 2])){
//			return 'In array';
//		}else{
//			return 'Not In array';
//		}
//








		$active_projects = Projects::findorfail($id);







		$rootPath = 'C:\xampp\htdocs\adminCMS3\vendor\laraveldaily\quickadmin\src\Laravel\5';

		//menu ids
		$menus = ProjectMenus::where('project_id',$id)->pluck('menu_id');

		if(1>count($menus)){
			return redirect()->back()->withMessage('There are no menu for this project');
		}
		if($active_projects->landing == null){
			return 'Landing cannot be null';
		}

		if (file_exists(public_path('temp'))) {

			//remove directory
			$dir = public_path('temp');
			$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
			$files = new RecursiveIteratorIterator($it,
				RecursiveIteratorIterator::CHILD_FIRST);
			foreach($files as $file) {
				if ($file->isDir()){
					rmdir($file->getRealPath());
				} else {
					unlink($file->getRealPath());
				}
			}
			rmdir($dir);
		}

		$source = $rootPath;

		$destination=  public_path('temp');
		//Create 'temp' Directory
		mkdir(public_path('temp'));
		foreach (
			$iterator = new \RecursiveIteratorIterator(
				new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
				\RecursiveIteratorIterator::SELF_FIRST) as $item
		) {
			if ($item->isDir()) {
				mkdir($destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName(), 0777);
			} else {
				copy($item, $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
			}
		}

		$tables = [];

		foreach($menus as $key){

			$files = Files::where('menu_id', $key)->get();
			foreach ($files as $row) {

				if ($row->type == 'Model') {
					$content = file_get_contents($row->path);
					$start = "\$table    = '";
					$end = "';";

					$start1 = 'class ';
					$end1 = ' extends';

					$tables[] = array(
						'tableName' => $this->getBetween($content, $start, $end),
						'modelName' => $this->getBetween($content, $start1, $end1)
					);

					$destination = public_path('temp').DIRECTORY_SEPARATOR .'app'.DIRECTORY_SEPARATOR  ; //model
					copy($row->path, $destination.$row->filename);

					//Create Gates
					$gate = new GateBuilder();
					$gate->build($key, $this->getBetween($content, $start1, $end1));

				}elseif($row->type == 'Migration'){
					$destination =  public_path('temp').DIRECTORY_SEPARATOR .'database'.DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR ; //migrations
					copy($row->path, $destination.$row->filename);
				}elseif($row->type == 'Controller'){
					$destination =  public_path('temp').DIRECTORY_SEPARATOR .'app'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'Admin'.DIRECTORY_SEPARATOR ;
					copy($row->path, $destination.$row->filename);
				}elseif($row->type == 'Request'){
					$destination =  public_path('temp').DIRECTORY_SEPARATOR .'app'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Requests'.DIRECTORY_SEPARATOR ; //Request Location
					copy($row->path, $destination.$row->filename);
				}elseif($row->type == 'View'){

					$menu_name = Menu::findorfail($key);
					$destination =  public_path('temp').DIRECTORY_SEPARATOR .'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR . 'admin'.DIRECTORY_SEPARATOR . strtolower(camel_case($menu_name->name).DIRECTORY_SEPARATOR )  ;

					if (! file_exists($destination)) {
						mkdir($destination);
						chmod($destination, 0777);
					}

					copy($row->path, public_path('temp').DIRECTORY_SEPARATOR .'resources'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR . 'admin'.DIRECTORY_SEPARATOR.$row->filename);
				}

			}

		}



		$menus2 = Menu::with('children')->where('menu_type', '=', 2)->orderBy('position')->whereIn('id',$menus)->get();
		//generate Gate for Menu2
		foreach($menus2 as $key => $value){
			$gate = new GateBuilder();
			$gate->build($value->id, '');
		}


//		//create routes file
		$routes = new RoutesBuilder();
		$routes->build();

		//Generate Seeds for Roles and Users
		$tables2 = array(
			[
				'tableName' => 'roles',
				'modelName' => 'Role'
			],
			[
				'tableName' => 'users',
				'modelName' => 'User'
			]

		);

		$table_merged =array_merge($tables,$tables2);
		//Generate Seeds
		$seeder = new DataSeederBuilder();
		$seeder->build($table_merged);

		//Generate Sidebar
		$sidebar = new SidebarBuilder();
		$sidebar->build();

		//Generate Project Config
		$config = new ConfigBuilder();
		$config->build($id);


		$active_projects = Projects::findorfail($id);


		$filename = strtolower(camel_case($active_projects->name));


		// Initialize archive object
		$zip = new ZipArchive();
		$zip->open('$filename.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator(public_path('temp'),RecursiveDirectoryIterator::SKIP_DOTS),
			RecursiveIteratorIterator::LEAVES_ONLY
		);

		foreach ($files as $name => $file) {
			// Skip directories (they would be added automatically)
			if (!$file->isDir()) {
				// Get real and relative path for current file
				$filePath = $file->getRealPath();
				$relativePath = substr($filePath, strlen(public_path('temp'))+1);

				// Add current file to archive
				$zip->addFile($filePath, $relativePath);
			}
		}

		// Zip archive will be created only after closing object
		$zip->close();

		header("Content-type: application/zip");
		header("Content-Disposition: attachment; filename='$filename.zip'");
		header("Content-length: " . filesize('$filename.zip'));
		header("Pragma: no-cache");
		header("Expires: 0");
		readfile('$filename.zip');

		if(file_exists('$filename.zip')){
			unlink('$filename.zip');
		}

//
		//remove directory
		$dir = public_path('temp');
		$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
		$files = new RecursiveIteratorIterator($it,
			RecursiveIteratorIterator::CHILD_FIRST);
		foreach($files as $file) {
			if ($file->isDir()){
				rmdir($file->getRealPath());
			} else {
				unlink($file->getRealPath());
			}
		}
		rmdir($dir);


	}

	private function getBetween($content,$start,$end){
		$r = explode($start, $content);
		if (isset($r[1])){
			$r = explode($end, $r[1]);
			return $r[0];
		}
		return '';
	}


}