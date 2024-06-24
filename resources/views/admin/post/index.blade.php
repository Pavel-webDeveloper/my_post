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
    <div class="container">
        <div class="row">
            @foreach ($listaPost as $post)
                <div class="col-4" style="margin-bottom: 20px;">
                    <a href="{{route('admin.posts.show', $post->id)}}">
                        <div class="card" style="">
                            <div class="image" style="max-height:185px; overflow: hidden;">
                                <img src="{{$post->image}}" alt="{{$post->title}}" style="
                                    {{$post->category_id == 7 ? 'object-fit: contain; width: 100%; height: 185px;' :
                                    'object-fit: cover; width: 100%; height: 185px;'}}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection