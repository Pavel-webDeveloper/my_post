<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listaTag = config('tag');

        foreach($listaTag as $tag){

            $newTag = new Tag();
            $newTag->name = $tag['name'];

            // definisco lo slug
            $slug = Str::of($tag['name'])->slug("-");

            // contatore
            $count = 1;

            // controllo se nel database è già presente uno slug uguale
            while(Tag::where("slug", $slug)->first()){
                $slug = Str::of($tag['name']->slug("-")) . "-{$count}";
                $count++;
            }

            $newTag->slug = $slug;

            $newTag->save();

        }
    }
}
