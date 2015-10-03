<?php

namespace Fiorella\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Fiorella\Work;
use Fiorella\Technique;
use Fiorella\Http\Controllers\Controller;

class WorksController extends Controller
{
    private $commonValidationRules = [
        'size' => 'required',
        'technique_id' => 'required'
    ];

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
        $submitText = 'Aggiungi lavoro';
        return view('admin.works.create', compact('submitText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array_merge($this->commonValidationRules, [
            'title' => 'required|unique:works,title',
            'imageFile' => 'required|image'
        ]);
        $this->validate($request, $rules);

        $request->merge([
            'technique_id' => $this->CreateNewTechniqueIfExists($request->technique_id),
            'image' => $this->SaveImage($request->imageFile, $request->title)
        ]);

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
        $submitText = 'Modifica lavoro';
        return view('admin.works.edit', compact('work', 'submitText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $rules = array_merge($this->commonValidationRules, [
            'title' => 'required',
            'imageFile' => 'image'
        ]);
        $this->validate($request, $rules);

        $work = Work::where('slug', '=', $slug)->firstOrFail();

        if($request->hasFile('imageFile')){
            $this->DeletePreviousImages($work->image);
            $request->merge(['image' => $this->SaveImage($request->imageFile, $request->title)]);
        }

        $request->merge(['technique_id' => $this->CreateNewTechniqueIfExists($request->technique_id)]);
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
        $this->DeletePreviousImages($work->image);
        $work->delete();

        session()->flash('flash-message', 'Lavoro eliminato con successo!');

        return redirect(route('admin.works.index'));
    }

    private function CreateNewTechniqueIfExists($technique_id)
    {
        // $technique_id might be a real id but could also be a string with the new technique name!
        if(!is_numeric($technique_id)){
            $technique = Technique::where('name', '=', $technique_id)->first();

            if(!$technique){
                $technique = Technique::create(['name' => $technique_id]);
            }

            $technique_id = $technique->id;
        }

        return $technique_id;
    }

    private function SaveImage($img, $title)
    {
        $imagePath = Str::slug($title) . '.' . $img->guessExtension();
        $publicPath = public_path() . '/img/works/';

        $image = \Image::make($img);

        $image->save($publicPath . $imagePath);

        $thumbnailSize = 400;
        if($image->width() > $thumbnailSize){
            if($image->width() <= $image->height()){
                $image = $image->resize($thumbnailSize, null, function($constraint){
                    $constraint->aspectRatio();
                });
            }
            else{
                $image = $image->resize(null, $thumbnailSize, function($constraint){
                    $constraint->aspectRatio();
                });
            }
            $image = $image->crop($thumbnailSize, $thumbnailSize);
        }

        $image->save($publicPath . 'thumbnail-' . $imagePath);

        return $imagePath;
    }

    private function DeletePreviousImages($oldImage)
    {
        $publicPath = public_path() . '/img/works/';

        @unlink($publicPath . $oldImage);
        @unlink($publicPath . 'thumbnail-' . $oldImage);
    }
}
