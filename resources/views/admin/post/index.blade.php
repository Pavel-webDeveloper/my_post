@extends('layouts.admin')

@section('pageActive', 'Post')

@section('link-extra-start')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('link-extra-end')
    <li>
        <a href="{{route('admin.posts.create')}}">Nuovo Post+</a>
    </li>
@endsection

@section('content')
    <ul>
        @foreach ($listaPost as $post)
            <li>
                {{$post->title}} - <a href="{{route('admin.posts.show', $post->id)}}">vedi dettaglio</a>
            </li>
        @endforeach
    </ul>
@endsection