<?php

namespace Laraveldaily\Quickadmin\Controllers;

use App\Http\Controllers\Controller;

class FormsController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {

		return view('qa::forms.index');
	}

}