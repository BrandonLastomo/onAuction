@extends('dashboard.layouts.main')

@section('container')

<div class="container my-4">

  <div class="row mb-3">
    <div class="col-md-5">
        <img src="{{ asset("storage/" . $item->image) }}" class="rounded float-start" style="width: 350px">
    </div>
    <div class="col">
        <div class="row">
            <h2 class="fw-bold">{{ $item->name }}</h2 >
            <p class="fs-4 mt-3 mb-1">Starts from <small><b>Rp{{ number_format($item->bid_price, 2, ',', '.') }}</b></small></p>
            <p class="fs-4 mb-2">Item description: </p>
            <p>{{ $item->desc }}</p>
        </div>
    </div>
  </div>

    <a href="/dashboard/items" class="text-decoration-none btn btn-brown">Back</a>
    <a href="/dashboard/items/{{ $item->slug }}/edit" class="text-decoration-none btn btn-warning">Edit</a>
    <form action="/dashboard/items/{{ $item->slug }}" method="post" class="d-inline">
        @csrf
        @method('delete')
        <button class="btn btn-danger">Delete</button>
    </form>
    

    {{-- Open and Close Auction --}}
      @can('staff')

      @if ($item->auction?->status == 'Open')
        <form action="/dashboard/closeAuction" method="GET" class="d-inline">
          <input type="hidden" name="status" value="Closed">
          <input type="hidden" name="item_id" value="{{ $item->slug }}">
          <button type="submit" class="btn btn-dark">Close</button>
        </form>
        
      @else
      
      <button type="button" class="btn btn-light border-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Open Auction
      </button>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-4" id="exampleModalLabel">Open Auction</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div class="col-lg-8">
                <form action="/dashboard/items/{{ $item->slug }}/openAuction" method="GET">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" name="user_id" value="0">
                <input type="hidden" name="sold_price" value="0">
                <input type="hidden" name="status" value="open">
                <div class="form-floating">
                    <input type="text" class="form-control border-dark mb-2" 
                    id="ends_in" name="ends_in" placeholder="Auction's Duration" autofocus required>
                    <label for="ends_in" class="text-secondary">Open Auction for xx Days</label>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
              <button type="submit" class="btn btn-light border-dark text-green">Open</button>
            </div>
          </div>
        </div>
      </div>
          </form>


      @endif
    @endcan
    {{-- End of OCA --}}

</div>

@endsection