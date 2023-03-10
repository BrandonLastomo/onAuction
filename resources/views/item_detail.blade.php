@extends('layouts.main')

@extends('partials.navbar')

@section('contents')

    <div class="container">

        {{-- {{ dd($histories) }} --}}

        {{-- Item Data --}}
        <div class="row mb-3">
            <div class="col-md-5">
                <img src="{{ asset("storage/" . $items->image) }}" class="rounded float-start" style="width: 400px; height: 400px">
            </div>
            <div class="col">
                <div class="row">
                    <h2 class="fw-bold">{{ $items->name }}</h2 >
                    <p class="fs-4 mt-3 mb-1">Starts from <small><b>Rp{{ number_format($items->bid_price, 2, ',', '.') }}</b></small></p>
                    <p class="fs-4 mb-4 mt-0">Auction
                        @if ($rule == 0)
                            has been closed
                        @elseif ($rule == 1)
                            will be closed: <span class="text-danger fs-4">today's midnight</span>
                        @else
                            will be closed in: <span class="text-success fs-4">{{ $rule }} days</span>
                            {{-- {{ $end }} {{ $end2 }} --}}
                        @endif

                    </p>
                    <p class="fs-4 mb-2">Item description: </p>
                    <p>{{ $items->desc }}</p>
                </div>
            </div>
        </div>

        {{-- Leaderboard --}}
        <div class="rounded shadow p-3 mb-5">
                <h3 class="ms-2">Auction Leaderboard</h3>
                @if (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('tooLow'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('tooLow') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table border">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Amount of Bid</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($items->auction->status == "Closed")
                            @foreach ($auctions as $auction)
                            <tr class="{{ $auction->user ? 'bg-success' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                                <td>{{ $auction->user->name ?? 'No one has done any bid'}}</td>
                                <td>Rp{{ number_format($auction->sold_price  ?? '', 0, ',', '.') }}</td>
                                <td>{{ $auction->user ? "Winner" : 'Undefined' }}</td>
                            </tr>
                            @endforeach
                            @foreach ($histories->sortByDesc('bid_amount') as $history)
                            <tr>
                                <td>{{ $loop->iteration+1 }}</td>
                                {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                                <td>{{ $history->user->name ?? 'No one has done any bid' }}</td>
                                <td>Rp{{ number_format($history->bid_amount ?? '', 2, ',', '.') }}</td>
                                <td>Lose</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                        @foreach ($auctions as $auction)
                            <td>{{ $loop->iteration }}</td>
                            {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                            <td>{{ $auction->user->name ?? 'No one has done any bid'}}</td>
                            <td>Rp{{ number_format($auction->sold_price ?? '', 2, ',', '.') ?? ''}}</td>
                            <td>{{ $auction->user ? "Winner" : 'Undefined' }}</td>
                        </tr>
                        @endforeach
                        @foreach ($histories->sortByDesc('bid_amount') as $history)
                        <tr>
                            <td>{{ $loop->iteration+1 }}</td>
                            {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                            <td>{{ $history->user->name ?? 'No one has done any bid'}}</td>
                            <td>Rp{{ number_format($history->bid_amount ?? '', 2, ',', '.') }}</td>
                            <td>Lose</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    </table>
                </div>

                {{-- Input Bid Price --}}
                @auth
                    @can('citizen')
                    <form action="/{{ $items->slug }}/bidStore" method="GET">
                            <input type="hidden" name="item_id" value="{{ $items->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @foreach ($auctions as $auction)
                            <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                            <input type="hidden" name="sold_price_old" value="{{ $auction->sold_price }}">
                            <input type="hidden" name="old_winner" value="{{ $auction->user->id }}">
                            @endforeach
                            @foreach ($histories->sortByDesc('user_id') as $history)
                            <input type="hidden" name="other_bid" value="{{ $history->bid_amount ?? '' }}">
                            {{-- {{ dd( $history->user->id) }} --}}
                            <input type="hidden" name="old_bidder_id" value="{{ $history->user->id ?? '' }}">
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

                {{-- Generate Report --}}
                @auth
                    @cannot('citizen')
                    <div class="d-flex justify-content-end">
                        <a href="/{{ $items->slug }}/generate-report" class="btn btn-dark" >Generate report</a>
                    </div>
                    @endcannot
                @endauth
            </div>
            {{-- End of Leaderboard --}}

        <hr class="border-2 border-top border-secondary mb-4">

        {{-- More Items --}}
        {{-- {{ dd($moreItemsCount) }} --}}
        <h4 class="mb-3 fw-bold">More Items</h4>
          <div class="row">
            
              {{-- Item Card --}}
              @foreach ($moreItems as $auctionItem)
                <div class="col-md-3">
                  <div class="card shadow-sm mb-5">
                    <img src="{{ asset('storage/' . $auctionItem->item->image ?? 'item-images/imgnotfound.jpg') }}" class="card-img-top img-fluid">
                    <div class="card-body">
                        <h5 class="card-title">{{ $auctionItem->item->name }}</h5>
                        <h5 class="card-title fw-bold">Rp{{ number_format($auctionItem->item->bid_price, 2, ',', '.') }}</h2>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <form action="/{{ $auctionItem->item->slug }}" method="GET" class="d-inline">
                          <input type="hidden" name="item_id" value="{{ $auctionItem->item->id }}">
                          <button type="submit" class="btn btn-brown">Item Detail</button>
                        </form>
                        {{-- <a href="/{{ $auctionItem->item->slug }}" class="btn btn-dark">Item Detail</a> --}}
                        @auth
                          @cannot('citizen')
                            <a href="/dashboard/items/{{ $auctionItem->item->slug }}/edit" class="btn btn-warning">Edit</a>  
                          @endcannot
                        @endauth
                    </div>
                  </div>
                </div>
              @endforeach

            </div>

    </div>
@endsection

