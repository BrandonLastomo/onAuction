@extends('layouts.main')

@section('contents')

  <div class="container mb-5">
    
    @if ($countAuctions > 3)
    
    <h4 class="fw-bold">{{ $pageIn }}</h4>
        
    {{-- Carousel --}}
    <div id="carouselExampleCaptions" class="carousel slide mb-4" data-bs-ride="false">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          {{-- <a href="/{{ $auctions[0]->item->slug }}"> --}}
            <div class="carousel-item active">
              
              <form action="/{{ $auctions[0]->item->slug }}" method="POST">
                @method('get')
                <input type="hidden" name="item_id" value="{{ $auctions[0]->item->id }}">
                  <button type="submit" class="p-0 border-0 rounded">
                    <img src="{{ asset('img/furniture_edit.jpg') }}" class="d-block w-100 rounded">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>{{ $auctions[0]->item->name }}</h5>
                      <p>Some representative placeholder content for the second slide.</p>
                    </div>
                  </button>
              </form>

            </div>
          {{-- </a> --}}
          {{-- <a href="/{{ $auctions[1]->item->slug }}"> --}}
            <div class="carousel-item">
              
              <form action="/{{ $auctions[1]->item->slug }}" method="POST">
                @method('GET')
                <input type="hidden" name="item_id" value="{{ $auctions[1]->item->id }}">
                  <button type="submit" class="p-0 border-0 rounded">
                    <img src="{{ asset('img/furniture_edit.jpg') }}" class="d-block w-100 rounded">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>{{ $auctions[1]->item->name }}</h5>
                      <p>Some representative placeholder content for the second slide.</p>
                    </div>
                  </button>
              </form>

            </div>
          {{-- </a>
          <a href="/{{ $auctions[2]->item->slug }}"> --}}
            <div class="carousel-item">
              <form action="/{{ $auctions[2]->item->slug }}" method="POST">
                @method('GET')
                <input type="hidden" name="item_id" value="{{ $auctions[2]->item->id }}">
                  <button type="submit" class="p-0 border-0 rounded">
                    <img src="{{ asset('img/furniture_edit.jpg') }}" class="d-block w-100 rounded">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>{{ $auctions[2]->item->name }}</h5>
                      <p>Some representative placeholder content for the second slide.</p>
                    </div>
                  </button>
              </form>
            </div>
          {{-- </a> --}}
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- Items list --}}
    
      <div class="rounded shadow-sm p-3">
        <h4 class="mb-3 fw-bold">Maybe You Need These</h4>
          <div class="row">
            
              {{-- Item Card --}}
              @foreach ($auctions->skip(3)->take(4) as $auction)
                <div class="col-md-3">
                  <div class="card shadow-sm mb-5">
                    <img src="{{ asset('storage/' . $auction->item->image) }}" class="card-img-top img-fluid">
                    <div class="card-body">
                        <h5 class="card-title">{{ $auction->item->name }}</h5>
                        <h5 class="card-title fw-bold">Rp{{ number_format($auction->item->bid_price, 2, ',', '.') }}</h2>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <form action="/{{ $auction->item->slug }}" method="GET" class="d-inline">
                          <input type="hidden" name="item_id" value="{{ $auction->item->id }}">
                          <button type="submit" class="btn btn-brown">Item Detail</button>
                        </form>
                        {{-- <a href="/{{ $auction->item->slug }}" class="btn btn-dark">Item Detail</a> --}}
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

      <hr class="border-2 border-top border-secondary mb-4">

      {{-- Categories Section --}}
      <h4 class="mb-4 fw-bold">Browse by Category <a href="/categories" class="text-decoration-none"><span class="text-brown fs-6 ps-3">See More...</span></a></h4>
        <div class="row">
          
          @foreach ($categories as $category)   
          <div class="col-md-4 mb-3">
              <a href="/categories/{{ $category->slug }}">
              <div class="card text-bg-dark">
                  <img src="{{ asset('storage/' . $category->image) }}" class="card-img" style="height: 125px">
                  <div class="card-img-overlay p-0 d-flex justify-content-center bg-dark bg-opacity-50">  
                      <h5 class="card-title px-5 py-5">{{ $category->name }}</h5>
                  </div>
              </div>
              </a>
          </div>   
          @endforeach

        </div>

  @elseif ($countAuctions <= 3)
  
          {{-- Items list --}}
    <div class="container mt-3"> 
      
      <h3 class="mb-3 fw-bold"> Maybe You Need These </h3>
        <div class="row">

            {{-- Item Card --}}
            @foreach ($auctions as $auction)
              <div class="col-md-3">
                <div class="card shadow mb-5">
                  <img src="https://source.unsplash.com/400x400?furniture" class="card-img-top">
                  <div class="card-body">
                      <h5 class="card-title fw-bold">{{ $auction->item->name }}</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <form action="/{{ $auction->item->slug }}" method="GET" class="d-inline">
                        <input type="hidden" name="item_id" value="{{ $auction->item->id }}">
                        <button type="submit" class="btn btn-brown">Item Detail</button>
                      </form>
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
        
      <hr class="border-2 border-top border-secondary mb-4">

      {{-- Categories Section --}}
      <h4 class="mb-4 fw-bold">Browse by Category <a href="/categories" class="text-decoration-none"><span class="text-brown fs-6 ps-3">See More...</span></a></h4>
        <div class="row">
          
          @foreach ($categories as $category)   
          <div class="col-md-4 mb-3">
              <a href="/categories/{{ $category->slug }}">
              <div class="card text-bg-dark">
                  <img src="{{ asset('storage/' . $category->image) }}" class="card-img" style="height: 125px">
                  <div class="card-img-overlay p-0 d-flex justify-content-center bg-dark bg-opacity-50">  
                      <h5 class="card-title px-5 py-5">{{ $category->name }}</h5>
                  </div>
              </div>
              </a>
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

