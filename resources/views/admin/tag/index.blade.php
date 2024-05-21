@extends('layouts.admin')

@section('pageActive', 'Tags')

@section('link-extra-start')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('link-extra-end')
    <li>
        <a href="{{route('admin.tags.create')}}">Nuovo Tag+</a>
    </li>
@endsection

@section('content')
    <ul>
        @foreach ($listaTag as $tag)
            <li>
                {{$tag->name}} - <a href="{{route('admin.tags.show', $tag->id)}}">vedi tag</a>
            </li>
        @endforeach
    </ul>
@endsection