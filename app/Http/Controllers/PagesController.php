<?php

namespace Fiorella\Http\Controllers;

use Illuminate\Http\Request;

use Fiorella\Http\Requests;
use Fiorella\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function admin()
    {
        return view('admin.index');
    }
}
