@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
    </div>

@if (session()->has('success'))
<div class="alert alert-success col-lg-6" role="alert">
  {{ session('success') }}
</div>
@endif

<form action="/dashboard/categories" method="POST" enctype="multipart/form-data">
  {{-- karena udh pake route resource, jadi klo ada action ke posts methodnya POST, 
  langsung masuk ke method store di dashboardcontroller --}}

  {{-- ectype dipake biar formnya bisa ngambil input file --}}
  @csrf
  <div class="row mb-3">
    <div class="form-floating col-lg-5">
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
      id="name" placeholder="name@example.com" autofocus required value="{{ old('name') }}">
      <label for="name" class="text-secondary ps-3">New category</label>
      @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>
    <div class="col">
      <button type="submit" name="add" class="btn btn-dark mt-2"><i class="bi bi-plus h4"></i></button>
    </div>
  </div>

</form>

    <div class="table-responsive col-lg-12">
        {{-- <a href="/dashboard/categories/create" class="btn btn-dark mb-3 py-2">Create new category</a> --}}
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Category Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <!-- Button trigger modal -->
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Edit
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category's Name</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="col-lg-8">
                                <form action="/dashboard/categories/{{ $category->slug }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="mb-3">
                                      <label for="name" class="form-label">Name</label>
                                      <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                      id="name" name="name" value="{{ old('name', $category->name) }}" required autofocus>
                                      @error('title')
                                        <div class="invalid-feedback">
                                          {{ $message }}
                                        </div>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                  <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    {{-- <a href="/dashboard/categories/{{ $category->slug }}/edit" class="btn btn-warning">Edit</a> --}}
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
@endsection