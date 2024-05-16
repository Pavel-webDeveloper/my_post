@extends('layouts.admin')

@section('pageActive', 'Post')

@include('admin/partials/modal')

@section('link-extra-start')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
    <div class="container d-flex align-items-center flex-column">
      <h1 class="my-4" style="font-style: italic;">{{$post->title}}</h1>
        <div class="card" style="width: 80%;">
            <img src="{{$post->image}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Categoria: </h5>
              <p class="card-text">{{ $post->description }}</p>
              <div class="action-botton d-flex justify-content-between">
                <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-primary">Modifica</a>

                {{-- form per cancellare elemento --}}
                <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="myGlobalObject.openModal(event, {{$post}})">Elimina</button>
                </form>
              </div>
            </div>
          </div>
    </div>


@endsection