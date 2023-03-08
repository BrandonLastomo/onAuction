@extends('layouts.main')
    
@section('contents')

    <div class="container mb-5">

        <h4 class="mb-4">Select a Category</h4>
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