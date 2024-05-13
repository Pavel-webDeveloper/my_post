@extends('layouts.admin')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 80%;">
            <img src="{{$post->image}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $post->title }}</h5>
              <p class="card-text">{{ $post->description }}</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
    </div>


@endsection