@extends('dashboard.layouts.main')

@section('container')

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

  <div class="mt-4">
    <h3 class="mb-3">Staff List</h3>
    <hr class="border-2 border-top border-secondary mb-4">
    
    @can('admin')
      <a href="/dashboard/staff/create" class="btn btn-dark mb-3">Add Staff</a>
    @endcan
    
        <div class="table-responsive col-lg-12">
        <table class="table table-striped table-sm">
          <thead class="table-dark">
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Role</th>
              @can('admin')
                <th scope="col">Action</th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @foreach ($staffs as $staff)

            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- variabel loop bisa dipake klo pake foreach, iteration berarti loop angka mulai dari angka 1, klo index berarti dari 0  (->index) --}}
                <td>{{ $staff->name }}</td>
                <td>{{ $staff->email }}</td>
                <td>{{ $staff->phone_number }}</td>
                <td>{{ $staff->role }}</td>
                @can('admin')
                  <td>
                      <a href="/dashboard/staff/{{ $staff->username }}/edit" class="btn btn-warning">Edit</a>
                      <form action="/dashboard/staff/{{ $staff->username }}" method="post" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                      </form>
                  </td>
                @endcan
            </tr>

            @endforeach
          </tbody>
        </table>

  </div>
@endsection