@extends('dashboard.layouts.main')

@section('container')

<div class="mt-4">
      <h3 class="mb-3">These are Our Web's Brief Datas</h3>
      <hr class="border-2 border-top border-secondary mb-4">

    {{-- <form action="" class="mb-2">
      <input type="text" name="search" class="py-1 px-5">
      <button class="btn btn-dark" type="submit">Search</button>
    </form> --}}
    
    <div class="row mb-4">
      <div class="col-sm-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title pb-3">Current Auctions: {{ $countAuction }}</h5>
            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            <a href="#" class="btn btn-brown float-end">Go to Auction List</a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title pb-3">Items: {{ $countItem }}</h5>
            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            <a href="/dashboard/items" class="btn btn-brown float-end">Go to Item List</a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title pb-3">Categories: {{ $countCategory }}</h5>
            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            <a href="/dashboard/categories" class="btn btn-brown float-end">Go to Category List</a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title pb-3">Staffs: {{ $countStaff }}</h5>
            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            <a href="/dashboard/staff" class="btn btn-brown float-end">Go to Staff List</a>
          </div>
        </div>
      </div>
</div>

  <div class="rounded shadow p-3">
    <h4 class="d-inline">This is ongoing auctions list</h4>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show float-end" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="table-responsive col-lg-12 pt-3">
      {{-- <a href="/dashboard/categories/create" class="btn btn-dark mb-3 py-2">Create new category</a> --}}
      <table class="table table-striped table-sm">
        <thead class="table-dark">
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
              <td>{{ $auction->item->name ?? 'Item is unavalaible, please delete this auction immidiately' }}</td>
              <td>Rp {{ number_format($auction->item->bid_price ?? 0, 2, ',', '.') }}</td>
              <td>Rp {{ number_format($auction->sold_price, 2, ',', '.') }}</td>
              <td>{{ $auction->user->name ?? 'No one has done any bid' }}</td>
              <td>{{ $auction->status }}</td>
              <td>
                  <form action="/dashboard/closeAuction" method="GET" class="d-inline">
                    @csrf
                    <input type="hidden" name="auction_id" value="{{ $auction->id ?? '' }}">
                  @if ($auction->status == "Closed")
                    <input type="hidden" name="status" value="Open">
                    <button type="submit" class="btn btn-light border-dark">Open</button>
                  @else
                    <input type="hidden" name="status" value="Closed">
                    <button type="submit" class="btn btn-dark">Close</button>
                  @endif
                  </form>
                  <a href="/dashboard/{{ $auction->item->slug ?? '' }}" class="btn btn-brown">Detail</a>
                  <form action="/dashboard/{{ $auction->id ?? '' }}/deleteAuction" method="GET" class="d-inline">
                      @csrf
                      <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                      <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                  </form>
              </td>
          </tr>
          @endforeach

        </tbody>

        
      </table>
      {{ $auctions->links() }}
    </div>
  </div>
</div>


@endsection