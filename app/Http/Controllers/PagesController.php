<?php

namespace Fiorella\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Fiorella\Work;
use Fiorella\Http\Requests;
use Fiorella\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        $works = Work::all();
        $usedTechniques = DB::table('techniques')
                            ->select('techniques.*')
                            ->join('works', 'techniques.id', '=', 'works.technique_id')
                            ->groupBy('works.technique_id')
                            ->get();
        return view('pages.home', compact('works', 'usedTechniques'));
    }

    public function admin()
    {
        return view('admin.index');
    }
}
