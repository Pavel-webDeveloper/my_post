@extends('layouts.admin')

@section('pageActive', 'Categories')

@section('link-extra-start')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('link-extra-end')
    <li>
        <a href="{{route('admin.categories.create')}}">Nuova Categoria+</a>
    </li>
@endsection

@section('content')
    <ul>
        @foreach ($listaCategory as $cat)
            <li>
                {{$cat->name}} - <a href="{{route('admin.categories.show', $cat->id)}}">vedi piatti</a>
            </li>
        @endforeach
    </ul>
@endsection