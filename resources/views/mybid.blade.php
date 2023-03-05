@extends('layouts.main')

@section('contents')


<div class="container mb-5">

    <h4>Your Latest Auction</h4>
    <div class="table-responsive">
        <table class="table border">
            <thead class="table-dark">
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Amount of Bid</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auctions as $auction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                        <td>{{ $auction->item->name ?? 'No one has done any bid'}}</td>
                        <td>{{ $auction->sold_price ?? ''}}</td>
                        <td>
                            <a href="/{{ $auction->item->slug }}" class="btn btn-success">Go to Item Detail Page</a>
                        </td>
                    </tr>
                @endforeach
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
                </tr>
            </thead>
            <tbody>
                @foreach ($auctions as $auction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                        <td>{{ $auction->item->name ?? 'No one has done any bid'}}</td>
                        <td>{{ $auction->sold_price ?? ''}}</td>
                    </tr>
                @endforeach
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