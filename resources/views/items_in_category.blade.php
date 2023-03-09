@extends('layouts.main')

@section('contents')

  <div class="container mb-5">

@if ($countAuctions > 0)

  {{-- Items list --}}
    <div class="container mt-3"> 
      
      <h3 class="mb-3 fw-bold"> {{ $pageIn }} </h3>
        <div class="row">

            {{-- Item Card --}}
            @foreach ($auctions as $auction)
              <div class="col-md-3">
                <div class="card shadow mb-5">
                  <img src="https://source.unsplash.com/400x400?furniture" class="card-img-top">
                  <div class="card-body">
                      <h5 class="card-title fw-bold">{{ $auction->item->name }}</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="/{{ $auction->item->slug }}" class="btn btn-brown">Item Detail</a>
                      @auth
                        @cannot('rakyat')
                          <a href="/dashboard/items/{{ $auction->item->slug }}/edit" class="btn btn-warning">Edit</a>  
                        @endcannot
                      @endauth
                  </div>
                </div>
              </div>
            @endforeach

        </div>

    </div>
  @else
      <h3>There are no items</h3>
  @endif
  
  </div>

    <!-- Footer -->
    <div class="footer text-center text-lg-start bg-light">

      
      <section class="pt-1 border-top">
        <div class="container text-center text-md-start mt-4">
          
          <div class="row mt-3">
            
            <div class="col-md-3 col-lg-4 col-xl-3 mt-5">
              <!-- Content -->
              <h1>
                <b><a href="/" class="text-decoration-none text-dark">onAuction</a></b> 
              </h1>
              {{-- <p>
                Here you can use rows and columns to organize your footer content. Lorem ipsum
                dolor sit amet, consectetur adipisicing elit.
              </p> --}}
            </div>
            

            
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              
              <h5 class="fw-bold mb-4">CONTACT</h5>
              <p><i class="bi bi-geo-alt pe-1"></i> Karawang, Indonesia</p>
              <p><i class="bi bi-envelope-at pe-1"></i> onauction@gmail.com</p>
              <p><i class="bi bi-telephone pe-1"></i> +62 888 8888 8888</p>
            </div>
          </div>
        </div>
      </section>

    </div>
    <!-- Footer -->

@endsection

