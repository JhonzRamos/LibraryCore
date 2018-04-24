<?php

namespace Laraveldaily\Quickadmin\Controllers;

use App\Http\Controllers\Controller;

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

	public function download(){

		//copy the desired files

		// Get real path for our folder__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Laravel' . DIRECTORY_SEPARATOR . '5'. DIRECTORY_SEPARATOR
		$rootPath = 'C:\xampp\htdocs\adminCMS3\vendor\laraveldaily\quickadmin\src\Laravel\5'	;

		// Initialize archive object
		$zip = new ZipArchive();
		$zip->open('file.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($rootPath,RecursiveDirectoryIterator::SKIP_DOTS),
			RecursiveIteratorIterator::LEAVES_ONLY
		);

		foreach ($files as $name => $file) {
			// Skip directories (they would be added automatically)
			if (!$file->isDir()) {
				// Get real and relative path for current file
				$filePath = $file->getRealPath();
				$relativePath = substr($filePath, strlen($rootPath)+1);

				// Add current file to archive
				$zip->addFile($filePath, $relativePath);
			}
		}

		// Zip archive will be created only after closing object
		$zip->close();

		header("Content-type: application/zip");
		header("Content-Disposition: attachment; filename=file.zip");
		header("Content-length: " . filesize('file.zip'));
		header("Pragma: no-cache");
		header("Expires: 0");
		readfile("file.zip");

		if(file_exists('file.zip')){
			unlink('file.zip');
		}

	}

}