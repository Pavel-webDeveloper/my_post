<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

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
        // prendo categorie e tag e li ritorno alla view
        $listaCategories = Category::all();
        $listaTag = Tag::all();
        return view('admin.post.create', compact(['listaCategories', 'listaTag']));
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

        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->description = $data['description'];
        $newPost->image = $data['image'];

        $slug = $this->getSlug($data['title']);
        // @var_dump($slug);
        $newPost->slug = $slug;

        // se viene passato dall'utente la categoria la vado a settare
        if( isset($data['category_id'])){
            $newPost->category_id = $data['category_id'];
        }
        // @dd($newPost);

        $newPost->save();

        // POPOLO LA TABELLA PIVOT DOPO IL SALVATAGGIO NEL DATABASE DEL POST
        if( isset($data['tags'])){
            $newPost->tags()->sync($data['tags']);
        }


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
        // controllo se il post ha una categoria associata
        if($post->category_id){
            $categoryPost = Category::findOrFail($post->category_id);
        }else{
            $categoryPost = null;
        }
        
        // @dd($categoryPost);
        return view('admin.post.show', compact(['post', 'categoryPost']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $listaCategories = Category::all();
        $listaTag = Tag::all();
        $myTags = [];
        foreach ($post->tags as $item) {
            $myTags[] = $item->id;
        }

        return view('admin.post.edit', compact(['post', 'listaCategories', 'listaTag', 'myTags']));
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
        // @dd($data);

        if($data['title'] != $post['title']){
            $slug = $this->getSlug($data['title']);
            $post['slug'] = $slug;
            // @dd($post['slug']);
        }

        $post->update($data);

        if(isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

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
        return redirect()->route('admin.posts.index')->with("messaggio", "{$post->name} è stato eliminato con successo!");
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
