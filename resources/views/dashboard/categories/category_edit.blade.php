@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $category->name }}</h1>
</div>

<form action="/dashboard/categories/{{ $category->slug }}" method="POST" class="row g-3" enctype="multipart/form-data">
  @csrf
  @method('put')
  <div class="col-md-6">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="inputName" value="{{ $category->name }}" autofocus>
  </div>
  <div class="col-md-6">
    <label for="inputImage" class="form-label">Category Image</label>
    <input class="form-control" type="file" name="image" id="inputImage">
  <div class="col-12 mb-3">
    <button type="submit" class="btn btn-dark float-end mt-3">Edit</button>
  </div>
</form>

@endsection