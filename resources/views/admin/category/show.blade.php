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
      <h1 class="my-4" style="font-style: italic;">{{$category->name}}</h1>

      {{-- content --}}
      {{-- code## --}}

      <div class="action-botton d-flex justify-content-between align-items-baseline">
        <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-primary">Modifica</a>

        {{-- form per cancellare elemento --}}
        <form action="{{route('admin.categories.destroy', $category->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" onclick="myGlobalObject.openModal(event, {{$category}})">Elimina</button>
        </form>
      </div>
    </div>


@endsection