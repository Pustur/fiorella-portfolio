<?php

namespace Fiorella\Http\Controllers;

use Illuminate\Http\Request;

use Fiorella\Work;
use Fiorella\Http\Requests;
use Fiorella\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        $works = Work::all();
        return view('pages.home', compact('works'));
    }

    public function admin()
    {
        return view('admin.index');
    }
}
