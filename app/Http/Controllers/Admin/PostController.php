<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // REGOLE DI VALIDAZIONE
    protected $validateData = [
        "title" => "required| max:100",
        "description" => "required",
        "image" => "required",
    ];


    public function index()
    {
        $listaPost = Post::all();
        return view('admin.post.index', compact('listaPost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(('admin.post.create'));
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
        
        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->description = $data['description'];
        $newPost->image = $data['image'];

        $slug = $this->getSlug($data['title']);
        // @var_dump($slug);
        $newPost->slug = $slug;

        // @dd($newPost);
        $newPost->save();
        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validateData);

        $data = $request->all();

        if($data['title'] != $post['title']){
            $slug = $this->getSlug($data['title']);
            $post['slug'] = $slug;
            // @dd($post['slug']);
        }

        $post->update($data);
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    public function getSlug($titolo){

        $slug = Str::of($titolo)->slug("-");

        $count = 1;

        while(Post::where("slug", $slug)->first()) {
            $slug = Str::of($titolo)->slug("-") . "-{$count}";
            $count++;
        }

        return $slug;
    }
}
