<?php

namespace Fiorella\Http\Controllers;

use Illuminate\Http\Request;

use Fiorella\Show;
use Fiorella\Http\Controllers\Controller;

class ShowsController extends Controller
{
    private $commonValidationRules = [
        'place' => 'required',
        'date' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = Show::all();
        return view('admin.shows.index', compact('shows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submitText = 'Aggiungi esposizione';
        return view('admin.shows.create', compact('submitText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array_merge($this->commonValidationRules, [
            'title' => 'required|unique:shows,title'
        ]);
        $this->validate($request, $rules);

        Show::create($request->all());

        session()->flash('flash-message', 'Esposizione creata con successo!');

        return redirect(route('admin.shows.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $show = Show::where('slug', '=', $slug)->firstOrFail();
        return view('admin.shows.show', compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $show = Show::where('slug', '=', $slug)->firstOrFail();
        $submitText = 'Modifica esposizione';
        return view('admin.shows.edit', compact('show', 'submitText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $rules = array_merge($this->commonValidationRules, [
            'title' => 'required'
        ]);
        $this->validate($request, $rules);

        $show = Show::where('slug', '=', $slug)->firstOrFail();

        $show->fill($request->all())->save();

        session()->flash('flash-message', 'Esposizione modificata con successo!');

        return redirect(route('admin.shows.show', $slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $show = Show::where('slug', '=', $slug)->firstOrFail();
        $show->delete();

        session()->flash('flash-message', 'Esposizione eliminata con successo!');

        return redirect(route('admin.shows.index'));
    }
}
