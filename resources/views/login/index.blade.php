<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>{{ $title }}</title>
</head>
<body>

    
    <div class="row justify-content-start">
        <div class="col-sm-5 mt-4 ms-5">
            
            <img src="{{ asset("img/def.jpg") }}" class="rounded float-start" style="width: 500px; height: 500px">
        </div>
        <div class="col-md-4" style="margin-top: 120px; margin-left: 100px">
            
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                </div>
            @elseif (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                </div>
            @endif

                <main class="form-signin">
                    <h1 class="h3 mb-5 fw-normal text-center"><b>onAuction</b></h1>

                    <form action="/login" method="POST">
                        @csrf
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control border border-dark @error('email') is-invalid @enderror"
                        id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        <label for="email" class="text-secondary">Email address</label>
                        @error('email')
                        {{-- jika email (('email')) error (@error), maka jalankan: --}}
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror    
                    </div>

                    <div class="form-floating">
                        <input type="password" name="password" class="form-control border border-dark" id="password" placeholder="Password" required>
                        <label for="password" class="text-secondary">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-dark mb-1" type="submit">Login</button>
                    </form> 
                    <small class="d-block text-center mt-3">
                        Not registered? <a href="/register" class="text-decoration-none text-brown">Register</a>
                    </small>
                </main>
            </div>
        </div>
        

<script type="text/javascript" src="/js/bootstrap.js"></script>

</body>
</html>