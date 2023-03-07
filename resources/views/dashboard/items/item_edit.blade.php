@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $item->name }}</h1>
</div>

<form action="/dashboard/items/{{ $item->slug }}" method="POST" class="row g-3" enctype="multipart/form-data">
  @csrf
  @method('put')
  <div class="col-md-6">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="inputName" value="{{ $item->name }}" autofocus>
  </div>
  <div class="col-md-6">
    <label for="inputPrice" class="form-label">Bid Price</label>
    <div class="input-group">
      <span class="input-group-text text-light bg-dark border-dark">Rp</span>
      <input type="number" class="form-control" name="bid_price" id="input_price" value="{{ $item->bid_price }}" >
    </div>
  </div>
  <div class="col-12">
    <label for="inputCategory" class="form-label">Category</label>
    <select id="inputCategory" class="form-select" name="category_id">
      @foreach ($categories as $category)
        @if (old('category_id', $item->category_id) == $category->id)
        {{-- jika value category_id yang lama sama dengan id dari table category, maka: --}}
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
        @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endif
      @endforeach
    </select>
  </div>
  <div class="col-12">
    <label for="inputImage" class="form-label">Item Image</label>
    <input class="form-control" type="file" name="image" id="inputImage">
  </div>
  <div class="col-12">
    <label for="inputDesc" class="form-label">Item Desciption</label>
    <textarea class="form-control" name="desc" id="inputDesc" rows="5">{{ $item->desc }}</textarea>
  </div>
  <div class="col-12 mb-3">
    <button type="submit" class="btn btn-dark float-end">Create</button>
  </div>
</form>

@endsection