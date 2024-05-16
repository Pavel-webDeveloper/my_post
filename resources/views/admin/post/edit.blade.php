@extends('layouts.admin')

@section('pageActive', 'Post')

@section('link-extra')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
<h1>Aggiungi un nuovo Post</h1>
    <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
        </div>

        <div class="form-group">
            <label for="title" class="form-label">description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$post->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">image</label>
            <input type="text" class="form-control" id="image" name="image" value="{{$post->image}}" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifica</button>
    </form>
@endsection

