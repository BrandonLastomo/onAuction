@extends('dashboard.layouts.main')

@section('container')

<div class="mt-4">

    <h3 class="mb-3">Categories</h3>
    <hr class="border-2 border-top border-secondary mb-4">

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-6 float-end" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

<!-- Button trigger modal -->
<button type="button" class="btn btn-dark mb-3" data-bs-toggle="modal" data-bs-target="#addCategory">
  Add new category
</button>

<!-- Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-10">
          <form action="/dashboard/categories" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                id="name" name="name" required autofocus>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="inputImage" class="form-label">Item Image</label>
                <input class="form-control" type="file" name="image" id="inputImage">
              </div>
          </div>
        </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-dark">Add</button>
          </form>
          </div>
    </div>
  </div>
</div>

    <div class="table-responsive col-lg-12">
        {{-- <a href="/dashboard/categories/create" class="btn btn-dark mb-3 py-2">Create new category</a> --}}
        <table class="table table-striped table-sm">
          <thead class="table-dark">
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Name</th>
              <th scope="col" style="width: 50%">Image</th>
              <th scope="col" style="width: 20%">Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td><img src="{{ asset('storage/' . $category->image) }}" class="rounded" style="width: 50%"></td>
                <td>
                    <a href="/dashboard/categories/{{ $category->slug }}/edit" class="btn btn-warning">Edit</a>
                    <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
</div>
@endsection