@extends('dashboard.layouts.main')

@section('container')

<div class="mt-4">
  <h3 class="mb-3">Items List</h3>
  <hr class="border-2 border-top border-secondary mb-4">
  
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-6 float-end" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

      <a href="/dashboard/items/create" class="btn btn-dark mb-3">Add new item</a>
        <div class="table-responsive col-lg-12">
        <table class="table table-striped table-sm">
          <thead class="table-dark">
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Name</th>
              <th scope="col">Bid Price</th>
              <th scope="col">Category</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                <td>{{ $item->name }}</td>
                <td>Rp {{ number_format($item->bid_price, 2, '.', ',') }}</td>
                <td>{{ $item->category->name }}</td>
                <td>
                    <a href="/dashboard/items/{{ $item->slug }}" class="btn btn-brown">Detail</a> 
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