@extends('layouts.main')
    
@section('contents')

    <div class="container">

        <h4 class="mb-4">Select a Category</h4>
        <div class="row">
            @foreach ($categories as $category)   
                <div class="col-md-4 mb-3">
                    <a href="/categories/{{ $category->slug }}">
                    <div class="card text-bg-dark">
                        <img src="https://source.unsplash.com/1200x400?{{ $category->name }}" class="card-img">
                        <div class="card-img-overlay p-0 d-flex justify-content-center bg-dark bg-opacity-50">  
                            <h5 class="card-title px-5 py-5">{{ $category->name }}</h5>
                        </div>
                    </div>
                    </a>
                </div>   
            @endforeach
        </div>
    </div>

    {{-- @foreach ($categories as $category)
        <ul>
            <li>
                <a href="/categories/{{ $category->slug }}">{{ $category->name}}</a>
            </li>        
        </ul>
    @endforeach --}}

@endsection