@extends('layouts.main')

@section('contents')


<div class="container mb-5">

    {{-- Ongoing Auction --}}
    <div class="rounded shadow p-3 mb-5">

        <h4>Your Latest Auction</h4>
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
                    {{-- {{ $countAuctionsOpen }}    --}}
                    {{-- @if ($countAuctions > 0 OR $countAuctionHistories > 0 ) --}}
                    @if ($countAuctionsOpen > 0)
                        @foreach ($auctionsOpen as $auction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $auction->item->name }}</td>
                                <td>Rp{{ number_format($auction->sold_price, 2, ',', '.') }}</td>
                                <td>
                                    <a href="/{{ $auction->item->slug }}" class="btn btn-success">Go to Item Detail Page</a>
                                </td>
                            </tr>
                        @endforeach
                    @elseif ($countAuctionHistoriesOpen > 0)
                        {{-- @if ($auctions->status == 'Open') --}}
                            @foreach ($auctionHistoriesOpen as $history)
                                <tr>
                                    <td>{{ $loop->iteration+1 }}</td>
                                    <td>{{ $history->auction->item->name }}</td>
                                    <td>Rp{{ number_format($history->bid_amount, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="/{{ $history->auction->item->slug }}" class="btn btn-success">Go to Item Detail Page</a>
                                    </td>
                                </tr>
                            @endforeach
                        {{-- @endif --}}
                    @else
                        <tr>
                            <td>You are not in any auction right now.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
    {{-- End of Ongoing Auction --}}

    {{-- Bid History --}}
    <div class="rounded shadow p-3 mb-5">
    
        <h4>Bid History</h4>
        <div class="table-responsive">
            <table class="table border table-sm">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Amount of Bid</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>  
                    @if ($countAuctionsClosed > 0 OR $countAuctionHistoriesClosed > 0)
                    {{-- @if ($countAuctions > 0) --}}
                        @foreach ($auctionsClosed as $auction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $auction->item->name }}</td>
                                <td>Rp{{ number_format($auction->sold_price, 2, ',', '.') }}</td>
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
                                    <td>{{ $loop->iteration+1 }}</td>
                                    <td>{{ $history->auction->item->name }}</td>
                                    <td>Rp{{ number_format($history->bid_amount, 2, ',', '.') }}</td>
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
    {{-- End of Bid History --}}
    
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