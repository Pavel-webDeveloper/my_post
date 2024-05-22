<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // REGOLE DI VALIDAZIONE
    protected $validateData = [
        "name" => "required|unique:tags|max:80",
    ];


    public function index()
    {
        $listaTag = Tag::all();
        return view('admin.tag.index', compact('listaTag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validateData);
        $data = $request->all();
        // @dd($data);

        $newTag = new Tag();
        $newTag->name = $data['name'];


        $slug = Str::of($data['name'])->slug("-");
        $count = 1;
        while(Tag::where('slug', $slug)->first()){
            $slug = Str::of($data['name'])->slug("-") . "-{$count}";
            $count++;
        }
        $newTag->slug = $slug;

        $newTag->save();
        return redirect()->route('admin.tags.show', $newTag->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate($this->validateData);
        $data =$request->all();

        if($tag->name != $data["name"]){
            $tag->name = $data["name"];
            $slug = Str::of($tag->name)->slug("-");
            $count = 1;
            while(Tag::where('slug', $slug)->first()){
                $slug = Str::of($tag->name)->slug("-") . "-{$count}";
                $count++;
            }
            $tag->slug = $slug;
        }
        $tag->update($data);
        return redirect()->route('admin.tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
