<?php

namespace Fiorella\Http\Controllers;

use Illuminate\Http\Request;

use Fiorella\Work;
use Fiorella\Technique;
use Fiorella\Http\Requests\WorksRequest;
use Fiorella\Http\Controllers\Controller;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $works = Work::all();
        return view('admin.works.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $submitText = "Aggiungi lavoro";
        return view('admin.works.create', compact('submitText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(WorksRequest $request)
    {
        $request->merge(['technique_id' => $this->CreateNewTechniqueIfExists($request->technique_id)]);
        Work::create($request->all());

        session()->flash('flash-message', 'Lavoro creato con successo!');

        return redirect(route('admin.works.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $work = Work::where('slug', '=', $slug)->firstOrFail();
        return view('admin.works.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {
        $work = Work::where('slug', '=', $slug)->firstOrFail();
        $submitText = "Modifica lavoro";
        return view('admin.works.edit', compact('work', 'submitText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(WorksRequest $request, $slug)
    {
        $request->merge(['technique_id' => $this->CreateNewTechniqueIfExists($request->technique_id)]);
        $work = Work::where('slug', '=', $slug)->firstOrFail();
        $work->fill($request->all())->save();

        session()->flash('flash-message', 'Lavoro modificato con successo!');

        return redirect(route('admin.works.show', $slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($slug)
    {
        $work = Work::where('slug', '=', $slug)->firstOrFail();
        $work->delete();

        session()->flash('flash-message', 'Lavoro eliminato con successo!');

        return redirect(route('admin.works.index'));
    }

    private function CreateNewTechniqueIfExists($technique_id)
    {
        // $technique_id might be a real id but could also be a string with the new technique name!
        if(!is_numeric($technique_id)){
            $technique = Technique::where("name", "=", $technique_id)->first();

            if(!$technique){
                $technique = Technique::create(['name' => $technique_id]);
            }

            $technique_id = $technique->id;
        }

        return $technique_id;
    }
}
