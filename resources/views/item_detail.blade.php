@extends('layouts.main')

@extends('partials.navbar')

@section('contents')
    <div class="container">
        {{-- {{ dd($auctions) }} --}}
        <div class="row mb-3">
            <div class="col-md-5">
                <img src="{{ asset("storage/" . $items->image) }}" class="rounded float-start" style="width: 400px; height: 400px">
            </div>
            <div class="col">
                <div class="row">
                    <h1>{{ $items->name }}</h1>
                    <p class="fs-4">Starts from <small><b>Rp {{ $items->bid_price }}</b></small></p>
                    <p class="fs-4 mb-5">Auction will be closed
                        @if ($rule == 0)
                            : today
                        @else
                            in: {{ $rule }} days
                            {{-- {{ $end }} {{ $end2 }} --}}
                        @endif

                    </p>
                    <p class="mb-2">Item description: </p>
                    <p>{{ $items->desc }}</p>
                </div>
            </div>
        </div>

        <hr class="mb-5">

        <h3 class="ms-2">Auction Leaderboard</h3>
        
        <div class="table-responsive">
            <table class="table border">
              <thead class="table-dark">
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Name</th>
                  <th scope="col">Amount of Bid</th>
                </tr>
              </thead>
              <tbody>
                  @if ($items->auction->status == "Closed")
                    @foreach ($auctions as $auction)
                    <tr class="{{ $auction->user ? 'bg-success' : ''}}">
                        <td>{{ $loop->iteration }}</td>
                        {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                        <td>{{ $auction->user->name ?? 'No one has done any bid'}}</td>
                        <td>{{ $auction->sold_price ?? ''}}</td>
                    </tr>
                    @endforeach
                    @foreach ($histories->sortByDesc('bid_amount') as $history)
                    <tr>
                        <td>{{ $loop->iteration+1 }}</td>
                        {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                        <td>{{ $history->user->name }}</td>
                        <td>{{ $history->bid_amount}}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                @foreach ($auctions as $auction)
                    <td>{{ $loop->iteration }}</td>
                    {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                    <td>{{ $auction->user->name ?? 'No one has done any bid'}}</td>
                    <td>{{ $auction->sold_price ?? ''}}</td>
                </tr>
                @endforeach
                @foreach ($histories->sortByDesc('bid_amount') as $history)
                <tr>
                    <td>{{ $loop->iteration+1 }}</td>
                    {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                    <td>{{ $history->user->name }}</td>
                    <td>{{ $history->bid_amount}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
        </div>

        @auth
            @can('rakyat')
            <form action="/{{ $items->slug }}/bidStore" method="GET">
                    <input type="hidden" name="item_id" value="{{ $items->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                @foreach ($auctions as $auction)
                    <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                    <input type="hidden" name="sold_price_old" value="{{ $auction->sold_price }}">
                @endforeach
                <div class="input-group mb-3">
                    <span class="input-group-text bg-dark text-light border-dark">Rp</span>
                @if ($auction->status == "Open")
                <input type="text" name="bid_amount" class="form-control" placeholder="Place amount of your bid here" aria-describedby="button-addon2">
                <button class="btn btn-dark px-5" type="submit" id="button-addon2">Bid</button>
                @else
                <input type="text" name="bid_amount" class="form-control" placeholder="This item's auction has been closed" aria-describedby="button-addon2" disabled>
                <button class="btn btn-dark px-5" type="submit" id="button-addon2" disabled>Bid</button>
                </div>
                @endif
            </form>
            @endcan
        @endauth
        </form>
        @auth
            @cannot('rakyat')
            <div class="d-flex justify-content-end">
                <a href="/{{ $items->slug }}/generate-report" class="btn btn-dark" >Generate report</a>
            </div>
            @endcannot
        @endauth
    </div>
@endsection

