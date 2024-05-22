@extends('layouts.admin')

@section('pageActive', 'Tags')

@section('link-extra')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
    <h1>Tags</h1>
    <form action="{{route('admin.tags.update', $tag->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-label">name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$tag->name}}">
        </div>

        <button type="submit" class="btn btn-primary">Modifica</button>
    </form>
@endsection

