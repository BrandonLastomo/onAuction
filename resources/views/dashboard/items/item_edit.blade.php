@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $item->name }}</h1>
</div>

<form action="/dashboard/items/{{ $item->slug }}" method="POST" class="row g-3" enctype="multipart/form-data">
  @csrf
  @method('put')

  <div class="col-md-6">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}" autofocus>
    @error('name')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-md-6">
    <label for="price" class="form-label">Bid Price</label>
    <div class="input-group">
      <span class="input-group-text text-light bg-dark border-dark">Rp</span>
      <input type="number" class="form-control" name="bid_price" id="price" value="{{ $item->bid_price }}" >
    </div>
    @error('price')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>
  
  <div class="col-12">
    <label for="category" class="form-label">Category</label>
    <select id="category" class="form-select" name="category_id">
      @foreach ($categories as $category)
        @if (old('category_id', $item->category_id) == $category->id)
        {{-- jika value category_id yang lama sama dengan id dari table category, maka: --}}
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
        @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endif
      @endforeach
    </select>
    @error('category')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>
  
  <div class="col-12">
    <label for="inputImage" class="form-label">Item Image</label>
    <input class="form-control" type="file" name="image" id="inputImage">
  </div>

  <div class="col-12">
    <label for="desc" class="form-label">Item Desciption</label>
    <textarea class="form-control" name="desc" id="desc" rows="5">{{ $item->desc }}</textarea>
    @error('desc')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>
  <div class="col-12 mb-3">
    <button type="submit" class="btn btn-dark float-end">Create</button>
  </div>
</form>

@endsection