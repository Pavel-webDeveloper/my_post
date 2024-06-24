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
        <div class="card align-items-center" style="width: 80%; {{$post->category_id == "7" ? 'padding-top: 25px' : ''}}">
            <img src="{{$post->image}}" class="card-img-top" alt="..." style="{{$post->category_id == "7" ? 'width: 150px' : ''}}">
            <div class="card-body">
              <h4 class="card-title">Categoria: 
                @if($post->category_id != null) 
                <a href="{{route('admin.categories.show', $categoryPost->id)}}">{{$categoryPost->name}}</a>
                @else
                  Nessuna
                @endif 
              </h4>
              <p class="card-text">{{ $post->description }}</p>

              @if (count($post->tags) > 0)
              <h5>Preparazione:</h5>
                <ul>
                  @foreach ($post->tags as $item)
                    <li><a href="{{route('admin.tags.show', $item->id)}}">{{$item->name}}</a></li>  
                  @endforeach
                </ul>
              @endif

              <div class="action-botton d-flex justify-content-between align-items-baseline">
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