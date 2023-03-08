@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Staff</h1>
</div>

    <form action="/dashboard/staff" method="POST" class="row g-3" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label for="name" class="form-label @error('name') is-invalid @enderror">Name</label>
            <input type="text" name="name" class="form-control" id="name" autofocus>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="username" class="form-label @error('username') is-invalid @enderror">Username</label>
            <input type="text" name="username" class="form-control" id="username">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label @error('email') is-invalid @enderror">Email Address</label>
            <div class="input-group">
                <span class="input-group-text text-light bg-dark border-dark">@</span>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            @error('email')
                <div class="invalid-feedback">
                        {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label  @error('password') is-invalid @enderror">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-12">
            <label for="phone_number" class="form-label @error('phone_number') is-invalid @enderror">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" id="phone_number">
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <input type="hidden" name="role" value="petugas">
        <div class="col-12">
            <button type="submit" class="btn btn-dark float-end">Add</button>
        </div>
    </form>

@endsection