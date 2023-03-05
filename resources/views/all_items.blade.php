@extends('partials.navbar')

@extends('layouts.main')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/blog" method="GET" class="d-flex mb-4">
                @if (request('category'))
                    <input type="hidden" name="category" value= "{{ request('category') }}">
                    @elseif(request('author'))
                    <input type="hidden" name="author" value= "{{ request('author') }}">
                @endif
                <input class="form-control me-2" type="search" placeholder="Search" name="search" value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="container">

        <div class="row">
        
            {{-- Item Card --}}
            <div class="col-md-3">
                <div class="card shadow">
                    <img src="https://source.unsplash.com/400x400?furniture" class="card-img-top">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/item-detail" class="btn btn-dark">Item Detail</a>
                    @auth
                        @cannot('rakyat')
                        <a href="/item-edit" class="btn btn-dark">Edit</a>  
                        @endcannot
                    @endauth
                    </div>
                </div>
            </div>

        </div>
    </div>

    

@endsection

