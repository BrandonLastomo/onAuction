@extends('layouts.main')

@section('contents')

  <div class="container mb-5">
    
    <h4>{{ $pageIn }}</h4>
  
  @php($count = $auctions->count())

  @if ($count >= 3)
        
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
                  <button type="submit" class="border-0 p-0">
                    <img src="https://source.unsplash.com/1200x300?furniture" class="d-block w-100">
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
                  <button type="submit" class="border-0 p-0">
                    <img src="https://source.unsplash.com/1200x300?furniture" class="d-block w-100">
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
                  <button type="submit" class="border-0 p-0">
                    <img src="https://source.unsplash.com/1200x300?furniture" class="d-block w-100">
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

    <hr>

    {{-- Items list --}}
    <div class="container mt-4"> 
      
      <h4 class="mb-3">Title</h4>
        <div class="row">

            {{-- Item Card --}}
            @foreach ($auctions->skip(3) as $auction)
              <div class="col-md-3">
                <div class="card shadow mb-5">
                  <img src="{{ asset('storage/' . $auction->item->image) }}" class="card-img-top img-fluid">
                  <div class="card-body">
                      <h5 class="card-title">{{ $auction->item->name }}</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <form action="/{{ $auction->item->slug }}" method="GET" class="d-inline">
                        <input type="hidden" name="item_id" value="{{ $auction->item->id }}">
                        <button type="submit" class="btn btn-dark">Item Detail</button>
                      </form>
                      {{-- <a href="/{{ $auction->item->slug }}" class="btn btn-dark">Item Detail</a> --}}
                      @auth
                        @cannot('rakyat')
                          <a href="/dashboard/items/{{ $auction->item->slug }}/edit" class="btn btn-dark">Edit</a>  
                        @endcannot
                      @endauth
                  </div>
                </div>
              </div>
            @endforeach

        </div>

    </div>

  @elseif ($count < 3)
          {{-- Items list --}}
    <div class="container mt-3"> 
      
      <h3 class="mb-3">Title</h3>
        <div class="row">

            {{-- Item Card --}}
            @foreach ($auctions as $auction)
              <div class="col-md-3">
                <div class="card shadow mb-5">
                  <img src="https://source.unsplash.com/400x400?furniture" class="card-img-top">
                  <div class="card-body">
                      <h5 class="card-title">{{ $auction->item->name }}</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="/{{ $auction->item->slug }}" class="btn btn-dark">Item Detail</a>
                      @auth
                        @cannot('rakyat')
                          <a href="/dashboard/items/{{ $auction->item->slug }}/edit" class="btn btn-dark">Edit</a>  
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

