<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $listaPost = config('post');

        foreach($listaPost as $post){

            $newPost = new Post();
            $newPost->title = $post['titolo'];
            $newPost->description = $post['descrizione'];
            $newPost->image = $post['immagine'];

            // definisco lo slug
            $slug = Str::of($post['titolo'])->slug("-");

            // contatore
            $count = 1;

            // controllo se nel database è già presente uno slug uguale
            while(Post::where("slug", $slug)->first()){
                $slug = Str::of($post['titolo']->slug("-")) . "-{$count}";
                $count++;
            }

            $newPost->slug = $slug;

            $newPost->save();

        }
    }
}
