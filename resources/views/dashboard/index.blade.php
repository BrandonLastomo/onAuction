@extends('dashboard.layouts.main')

@section('container')

    @if (session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Hello, {{ auth()->user()->name }}</h1>
    </div>

    {{-- <form action="" class="mb-2">
      <input type="text" name="search" class="py-1 px-5">
      <button class="btn btn-dark" type="submit">Search</button>
    </form> --}}
    
    <h4>These are our web's brief data</h4>
    <div class="row mb-3">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title pb-3">Current Auctions: {{ $countAuction }}</h5>
            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            <a href="#" class="btn btn-dark float-end">Go to Auction List</a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title pb-3">Items: {{ $countItem }}</h5>
            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            <a href="/dashboard/items" class="btn btn-dark float-end">Go to Item List</a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title pb-3">Categories: {{ $countCategory }}</h5>
            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            <a href="/dashboard/categories" class="btn btn-dark float-end">Go to Category List</a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title pb-3">Staffs: {{ $countStaff }}</h5>
            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            <a href="/dashboard/staff" class="btn btn-dark float-end">Go to Staff List</a>
          </div>
        </div>
      </div>
    </div>

    <h4>This is ongoing auctions list</h4>
    <div class="table-responsive col-lg-12">
      {{-- <a href="/dashboard/categories/create" class="btn btn-dark mb-3 py-2">Create new category</a> --}}
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Item Name</th>
            <th scope="col">Bid Price</th>
            <th scope="col">Sold Price</th>
            <th scope="col">Sold to</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($auctions as $auction)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $auction->item->name }}</td>
              <td>Rp {{ $auction->item->bid_price }}</td>
              <td>Rp {{ $auction->sold_price }}</td>
              <td>{{ $auction->user->name ?? 'NULL' }}</td>
              <td>{{ $auction->status }}</td>
              <td>
                  <form action="/dashboard/closeAuction" method="GET" class="d-inline">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $auction->item->id }}">
                  @if ($auction->status == "Closed")
                    <input type="hidden" name="status" value="Open">
                    <button type="submit" class="btn btn-success">Open</button>
                  @else
                    <input type="hidden" name="status" value="Closed">
                    <button type="submit" class="btn btn-danger">Close</button>
                  @endif
                  </form>
                  <a href="/dashboard/{{ $auction->item->slug }}" class="btn btn-success">Detail</a>
                  <form action="/dashboard/{{ $auction->item->slug }}/deleteAuction" method="GET" class="d-inline">
                      @csrf
                      <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                  </form>
              </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

@endsection