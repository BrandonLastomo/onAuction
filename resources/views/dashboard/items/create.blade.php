@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Item</h1>
</div>

<form action="/dashboard/items" method="POST" class="row g-3" enctype="multipart/form-data">
  @csrf

  <div class="col-md-6">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName" autofocus value="{{ old('name') }}">    
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
      <input type="number" class="form-control @error('price') is-invalid @enderror" name="bid_price" id="price" value="{{ old('price') }}">
    </div>    
    @error('price')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-12">
    <label for="category" class="form-label">Category</label>
    <select id="category" class="form-select @error('category') is-invalid @enderror" name="category_id">
      @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>    
    @error('category')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-12">
    <label for="image" class="form-label">Item Image</label>
    <input class="form-control" type="file" name="image" id="image">    
  </div>

  <div class="col-12">
    <label for="desc" class="form-label">Item Desciption</label>
    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" rows="5">{{ old('desc') }}</textarea>    
    @error('desc')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>
  <div class="col-12 mb-3">
    <button type="submit" class="btn btn-green float-end">Create</button>
  </div>
</form>

@endsection