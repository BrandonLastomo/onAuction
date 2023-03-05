@extends('dashboard.layouts.main')

@section('container')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{ session('success') }}
</div>
@endif

  <div class="mt-4">
    <h3 class="mb-3">Items List</h3>
    <hr>
      <a href="/dashboard/items/create" class="btn btn-dark mb-3">Add new item</a>
        <div class="table-responsive col-lg-12">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                <td>{{ $item->name }}</td>
                <td>
                    <a href="/dashboard/items/{{ $item->slug }}" class="btn btn-success">Detail</a> 
                    <a href="/dashboard/items/{{ $item->slug }}/edit" class="btn btn-warning">Edit</a>
                    <form action="/dashboard/items/{{ $item->slug }}" method="post" class="d-inline">
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