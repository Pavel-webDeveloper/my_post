@extends('layouts.admin')

@section('pageActive', 'Tags')

@section('link-extra')
    <li>
        <a href="/admin">Dashboard</a>
    </li>
@endsection

@section('content')
    <h1>Aggiungi Tag</h1>
    <form action="{{route('admin.tags.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">name</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>
        
        <button type="submit" class="btn btn-primary">Aggiungi</button>
  </form>
@endsection