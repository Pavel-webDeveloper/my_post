<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // REGOLE DI VALIDAZIONE
    protected $validateData = [
        "name" => "required| max:80",
    ];


    public function index()
    {
        $listaCategory = Category::all();

        return view('admin.category.index', compact('listaCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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

        $newCategory = new Category();
        $newCategory->name = $data['name'];

        $slug = $this->getSlug($data['name']);
        // @var_dump($slug);
        $newCategory->slug = $slug;

        $newCategory->save();
        return redirect()->route('admin.categories.show', $newCategory->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate($this->validateData);
        $data = $request->all();

        if($data['name'] != $category['name']){
            $slug = $this->getSlug($data['name']);
            $category['slug'] = $slug;
            // @dd($category['slug']);
        }

        $category->update($data);
        return redirect()->route('admin.categories.show', $category->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }

    
    public function getSlug($nome){

        $slug = Str::of($nome)->slug("-");

        $count = 1;

        while(Category::where("slug", $slug)->first()) {
            $slug = Str::of($nome)->slug("-") . "-{$count}";
            $count++;
        }

        return $slug;
    }
}
