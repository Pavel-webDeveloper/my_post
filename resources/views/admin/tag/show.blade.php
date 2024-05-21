@extends('layouts.admin')

@section('pageActive', 'Tags')

@include('admin/partials/modal')

@section('link-extra-start')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
    <div class="container d-flex align-items-center flex-column">
      <div class="action-botton d-flex justify-content-between align-items-baseline" style="gap: 10px;">
        <h1 class="my-4" style="font-style: italic; margin-right: 20px;">{{$tag->name}}</h1>
        <a href="{{route('admin.categories.edit', $tag->id)}}" class="btn btn-primary">Modifica</a>

        {{-- form per cancellare elemento --}}
        <form action="{{route('admin.categories.destroy', $tag->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" onclick="myGlobalObject.openModal(event, {{$tag}})">Elimina</button>
        </form>
      </div>

      <div class="container">
        <div class="row">
         
        </div>
      </div>     
    </div>


@endsection