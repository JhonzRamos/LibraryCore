<?php
namespace Laraveldaily\Quickadmin\Controllers;

use Laraveldaily\Quickadmin\Models\Files;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class QuickadminFilesController extends Controller
{

    /**
     * Quickadmin menu list page
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $fileList = Files::all();

        return view('qa::files.index', compact('$fileList'));
    }
    public function table()
    {
        return Datatables::of(Files::all())->make(true);
    }

}


