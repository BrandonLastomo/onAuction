@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $staff->name }}'s Data</h1>
</div>

<form action="/dashboard/staff/{{ $staff->username }}" method="POST" class="row g-3">
  @csrf
  @method('put')

  <div class="col-md-6">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $staff->name }}" autofocus>
    @error('name')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>  

  <div class="col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ $staff->username }}" >
    @error('username')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-md-6">
    <label for="email" class="form-label">Email</label>
    <div class="input-group">
      <span class="input-group-text text-light bg-dark border-dark">@</span>
      <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $staff->email }}" autofocus>
    </div>
    @error('email')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
    @error('password')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-12">
    <label for="phone_number" class="form-label">Phone Number</label>
    <input type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" value="{{ $staff->phone_number }}">
    @error('phone_number')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-12">
    <label for="role" class="form-label">Role</label>
    <select id="role" class="form-select @error('role') is-invalid @enderror" name="role">
      {{-- @foreach ($staff as $staff) --}}
        {{-- @if (old('role', $staff->role) == $staff->role) --}}
            <option value="admin" selected>admin</option>
        {{-- @else --}}
            <option value="petugas">petugas</option>
        {{-- @endif --}}
      {{-- @endforeach --}}
    </select>
    @error('role')
      <div class="invalid-feedback">
          {{ $message }}
      </div>
    @enderror
  </div>

  <div class="col-12 mb-3">
    <button type="submit" class="btn btn-dark float-end">Update</button>
  </div>
</form>

@endsection