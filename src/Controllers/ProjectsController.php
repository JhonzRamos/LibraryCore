<?php

namespace Laraveldaily\Quickadmin\Controllers;


use App\Http\Controllers\Controller;
use App\ProjectSettings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laraveldaily\Quickadmin\Models\Menu;
use Laraveldaily\Quickadmin\Models\ProjectMenus;
use Laraveldaily\Quickadmin\Models\Projects;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\CreateProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;
use Illuminate\Http\Request;



class ProjectsController extends Controller {

	/**
	 * Display a listing of projects
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {

        $projects = Projects::all();

		return view('qa::projects.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new projects
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

		$skin = Projects::$skin;


		return view('qa::projects.create', compact('skin'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$projects = Projects::find($id);
		$active = Projects::where('active', 1)->first();
		$menus1 = ProjectMenus::where('project_id',$active->id)->pluck('menu_id');
		$skin = Projects::$skin;
		$models = Menu::with('children')->where('menu_type', '=', 1)->orderBy('position')->whereIn('id',$menus1)->get();



		$view = "view";
		return view('qa::projects.edit', compact('projects', 'view',  'skin', 'models'));
	}


	/**
	 * Store a newly created projects in storage.
	 *
     * @param CreateProjectsRequest|Request $request
	 */
	public function store(Request $request)
	{


		$validation = Validator::make($request->all(), [
			'name' => 'required'
		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		Projects::create($request->all());

		return redirect()->route('menu');
	}

	/**
	 * Show the form for editing the specified projects.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{

		$projects = Projects::find($id);
		$active = Projects::where('active', 1)->first();
		$menus1 = ProjectMenus::where('project_id',$active->id)->pluck('menu_id');
		$skin = Projects::$skin;
		$models = Menu::where('menu_type', '=', 1)->orderBy('position')->whereIn('id',$menus1)->pluck('title', 'name');


//		$this->className = ucfirst(Str::camel($this->name)); //saving
		return view('qa::projects.edit', compact('projects', 'skin', 'models'));
	}

	/**
	 * Update the specified projects in storage.
     * @param UpdateProjectsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, Request $request)
	{
		$request->landing = $this->className = ucfirst(Str::camel($request->landing)); //saving

		$validation = Validator::make($request->all(), [
			'name' => 'required',
		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

		$projects = Projects::findOrFail($id);

        

		$projects->update($request->all());

		return redirect()->route('menu');
	}

	/**
	 * Remove the specified projects from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Projects::destroy(decrypt($id));

		return redirect()->back();
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
//        if ($request->get('toDelete') != 'mass') {
//            $toDelete = json_decode($request->get('toDelete'));
//
//            foreach($toDelete as $row){
//            	$toDelete[$row] = decrypt($row);
//            }
//            Projects::destroy($toDelete);
//        } else {
//            Projects::whereNotNull('id')->delete();
//        }

        return redirect()->back();
    }

	public function active($id)
	{
		$projects = Projects::all();

		foreach($projects as $row){
			$row->active = 0;
			$row->save();
		}


		$projects = Projects::findOrFail($id);
		$projects->active = 1;
		$projects->save();



		return redirect()->route('menu');
	}


}
