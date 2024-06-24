@extends('layouts.admin')

@section('pageActive', 'Tags')

@include('admin/partials/modal')

@section('link-extra-start')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
    {{-- <div class="container d-flex align-items-center flex-column"> --}}
    <div class="container">
      {{-- <div class="action-botton d-flex justify-content-between align-items-baseline" style="gap: 10px;"> --}}
      <div class="action-botton d-flex" style="align-items: baseline;">
        <h1 class="my-4" style="font-style: italic; margin-right: 20px;">{{$tag->name}}</h1>


        <a href="{{route('admin.tags.edit', $tag->id)}}" class="btn btn-primary">Modifica</a>
        {{-- form per cancellare elemento --}}
        <form action="{{route('admin.tags.destroy', $tag->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" onclick="myGlobalObject.openModal(event, {{$tag}})">Elimina</button>
        </form>
      </div>

      <div class="container">
        
        @if (count($tag->posts) > 0)
          <div class="row">
            @foreach ($tag->posts as $item)
              <div class="col-4" style="margin-bottom: 20px;">
                <a href="{{route('admin.posts.show', $item->id)}}">
                  <div class="card" style="">
                    <div class="image" style="max-height:185px; overflow: hidden;">
                      <img src="{{$item->image}}" alt="{{$item->title}}" style="
                          {{$item->category_id == 7 ? 'object-fit: contain; width: 100%; height: 185px;' :
                          'object-fit: cover; width: 100%; height: 185px;'}}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$item->title}}</h5>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        @else
          nessuna
        @endif
      
      </div>     
    </div>


@endsection