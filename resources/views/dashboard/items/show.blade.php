@extends('dashboard.layouts.main')

@section('container')

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
                <h1 class="pb-2">{{ $item->name }}</h1>
                <img src="{{ asset('storage/' . $item->image) }}" alt="" class="img-fluid mb-3">
                <a href="/dashboard/items" class="text-decoration-none btn btn-success">Back</a>
                <a href="/dashboard/posts/{{ $item->name }}/edit" class="text-decoration-none btn btn-warning">Edit</a>
                <form action="/dashboard/posts/{{ $item->id }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete</button>
                </form>
                

                @can('staff')

                @if ($item->auction?->status == 'Open')
                  <form action="/dashboard/closeAuction" method="GET">
                    <input type="hidden" name="status" value="Closed">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-danger">Close</button>
                  </form>
                  
                @else
                
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Open Auction
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Open Auction</h1>
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
                        <button type="submit" class="btn btn-primary">Open</button>
                      </div>
                    </div>
                  </div>
                </div>
                    </form>


                @endif
              @endcan
              
                <article>
                    {!! $item->desc !!}
                </article>    
        </div>
    </div>
</div>

@endsection