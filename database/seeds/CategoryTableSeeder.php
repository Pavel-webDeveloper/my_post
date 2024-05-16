<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listaCategories = config('category');

        foreach ($listaCategories as $cat) {
            $newCategory = new Category();
            $newCategory->name = $cat["nome"];

            // definisco lo slug
            $slug = Str::of($cat['nome'])->slug("-");

            // contatore
            $count = 1;

            // controllo se nel database è già presente uno slug uguale
            while(Category::where("slug", $slug)->first()){
                $slug = Str::of($cat['nome']->slug("-")) . "-{$count}";
                $count++;
            }
            $newCategory->slug = $slug;
            

            $newCategory->save();
        }
    }
}
