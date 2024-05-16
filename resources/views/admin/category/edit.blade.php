@extends('layouts.admin')

@section('pageActive', 'Categories')

@section('link-extra')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
    <h1>{{$category->name}}</h1>
    <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-label">name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
        </div>

        <button type="submit" class="btn btn-primary">Modifica</button>
    </form>
@endsection

