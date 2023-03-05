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
                <div class="col-md-4" style="margin-top: 40px; margin-left: 100px">
                    <main class="form-registration">
                        <h1 class="h3 mb-4 fw-normal text-center"><b>onAuction</b></h1>
            
                        <form action="/register" method="post">
                            @csrf
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control border border-dark rounded-top @error('name') is-invalid @enderror" 
                                id="name" placeholder="Name" required value="{{ old('name') }}">
                                <label for="name" class="text-secondary">Name</label>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input type="text" name="username" class="form-control border border-dark @error('username') is-invalid @enderror" 
                                id="username" placeholder="Username" required value="{{ old('username') }}">
                                <label for="username" class="text-secondary">Username</label>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input type="text" name="phone_number" class="form-control border border-dark @error('phone_number') is-invalid @enderror" 
                                id="phone_number" placeholder="phone_number" required value="{{ old('phone_number') }}">
                                <label for="phone_number" class="text-secondary">Phone Number</label>
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control border border-dark @error('email') is-invalid @enderror" 
                                id="email" placeholder="email@example.com" required value="{{ old('email') }}">
                                <label for="email" class="text-secondary">Email Address</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" name="password" class="form-control border border-dark rounded-bottom @error('password') is-invalid @enderror" 
                                id="password" placeholder="Password" required value="{{ old('password') }}">
                                <label for="password" class="text-secondary">Password</label>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            {{-- <label for="role">Select the role:</label> --}}
                            <input type="hidden" name="role" value="rakyat">
                                {{-- <select class="form-select border border-dark" id="role" name="role">
                                    <option selected>Select a role</option>
                                    <option value="admin">petugas</option>
                                    <option value="rakyat">rakyat</option>
                                </select> --}}

                            <button name="register" class="w-100 btn btn-lg btn-dark mt-3" type="submit">Register</button>
                        </form>
                        <small class="d-block text-center mt-3">
                            Already registered? <a href="/login">Login</a>
                        </small>
                    </main>
                </div>
            </div>
            
    
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    
    </body>
    </html>