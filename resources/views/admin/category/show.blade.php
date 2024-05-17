@extends('layouts.admin')

@section('pageActive', 'Categories')

@include('admin/partials/modal')

@section('link-extra-start')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
    <div class="container d-flex align-items-center flex-column">
      <div class="action-botton d-flex justify-content-between align-items-baseline" style="gap: 10px;">
        <h1 class="my-4" style="font-style: italic; margin-right: 20px;">{{$category->name}}</h1>
        <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-primary">Modifica</a>

        {{-- form per cancellare elemento --}}
        <form action="{{route('admin.categories.destroy', $category->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" onclick="myGlobalObject.openModal(event, {{$category}})">Elimina</button>
        </form>
      </div>

      <div class="container">
        <div class="row">
          @if (count($postWhithCategory) > 0)
            @foreach ($postWhithCategory as $item)
              <div class="col d-flex justify-content-center" style="">
                <div class="card" style="width: 18rem; margin-bottom: 20px; {{$category->name == 'Bevande' ? 'display: flex; align-items: center; padding-top: 10px;' : ''}}">
                  <img src="{{$item->image}}" class="card-img-top" alt="..." style="{{$category->name == 'Bevande' ? 'height: 300px; max-width: max-content;' : ''}}">
                  <div class="card-body">
                    <h5 class="card-title">{{$item->title}}</h5>
                    <a href="{{route('admin.posts.show', $item->id)}}" class="btn btn-primary">Visualizza</a>
                  </div>
                </div>
              </div>
            @endforeach
          @else
             <h2>Non ci sono piatti per questa Categoria</h2> 
          @endif
          
        </div>
      </div>     
    </div>


@endsection