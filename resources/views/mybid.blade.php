@extends('layouts.main')

@section('contents')


<div class="container mb-5">

    <h4>This Is Your Latest Auction, {{ Auth::user()->name }}</h4>
    <div class="table-responsive mb-3">
        <table class="table border table-sm">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount of Bid</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{ $countAuctionHistories }}    --}}
                {{-- @if ($countAuctions > 0 OR $countAuctionHistories > 0 ) --}}
                @if ($countAuctions > 0)
                    @foreach ($auctionsOpen as $auction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $auction->item->name}}</td>
                            <td>{{ $auction->sold_price}}</td>
                            <td>
                                <a href="/{{ $auction->item->slug }}" class="btn btn-success">Go to Item Detail Page</a>
                            </td>
                        </tr>
                    @endforeach
                @elseif ($countAuctionHistories > 0)
                    {{-- @if ($auctions->status == 'Open') --}}
                        @foreach ($auctionHistoriesOpen as $history)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $history->auction->item->name}}</td>
                                <td>{{ $history->bid_amount}}</td>
                                <td>
                                    <a href="/{{ $history->auction->item->slug }}" class="btn btn-success">Go to Item Detail Page</a>
                                </td>
                            </tr>
                        @endforeach
                    {{-- @endif --}}
                @else
                    <tr>
                        <td>You haven't done any bid yet.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>


    <h4>Bid History</h4>
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
                @if ($countAuctions > 0 OR $countAuctionHistories > 0)
                {{-- @if ($countAuctions > 0) --}}
                    @foreach ($auctionsClosed as $auction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $auction->item->name}}</td>
                            <td>{{ $auction->sold_price}}</td>
                            <td>
                                {{-- <a href="/{{ $auction->item->slug }}" class="btn btn-success">Go to Item Detail Page</a> --}}
                                <p>Win</p>
                            </td>
                        </tr>
                    @endforeach
                {{-- @elseif ($countAuctionHistories > 0) --}}
                    {{-- @if ($auctions->status == 'Open') --}}
                        @foreach ($auctionHistoriesClosed as $history)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $history->auction->item->name}}</td>
                                <td>{{ $history->bid_amount}}</td>
                                <td>
                                    {{-- <a href="/{{ $history->auction->item->slug }}" class="btn btn-success">Go to Item Detail Page</a> --}}
                                    <p>Lose</p>
                                </td>
                            </tr>
                        @endforeach
                    {{-- @endif --}}
                @else
                    <tr>
                        <td>You haven't done any bid yet.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

    <!-- Footer -->
    <div class="footer text-center text-lg-start bg-light">

      
        <section class="pt-1 border-top">
          <div class="container text-center text-md-start mt-4">
            
            <div class="row mt-3">
              
              <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
                <!-- Content -->
                <h6 class="mb-4">
                  <b>onAuction</b> 
                </h6>
                <p>
                  Here you can use rows and columns to organize your footer content. Lorem ipsum
                  dolor sit amet, consectetur adipisicing elit.
                </p>
              </div>
              
  
              
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                
                <h6 class="fw-bold mb-4">CONTACT</h6>
                <p>Karawang, Indonesia</p>
                <p>onauction@gmail.com</p>
                <p>+62 888 8888 8888</p>
              </div>
            </div>
          </div>
        </section>
  
    </div>
     <!-- Footer -->

@endsection