@extends('layouts.admin')

@section('content')
    <h1>Sono index</h1>

    <ul>
        @foreach ($listaPost as $post)
            <li>
                {{$post->title}} - <a href="{{route('admin.posts.show', $post->id)}}">vedi dettaglio</a>
            </li>
        @endforeach
    </ul>
@endsection