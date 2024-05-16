@extends('layouts.admin')

@section('pageActive', 'Categories')

@section('link-extra')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
    <h1>Aggiungi Categoria</h1>
    <form action="{{route('admin.categories.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">name</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>
        
        <button type="submit" class="btn btn-primary">Aggiungi</button>
  </form>
@endsection