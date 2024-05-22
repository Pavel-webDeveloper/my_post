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
            <input type="text" class="form-control @error('name') is invalid @enderror" id="name" name="name" value="{{old('name')}}">
        </div>
        @error('name')
            <div class="alert alert-danger">
                {{'Nome errato: nome già esistente o non inserito'}}
            </div>
        @enderror
        
        <button type="submit" class="btn btn-primary">Aggiungi</button>
  </form>
@endsection