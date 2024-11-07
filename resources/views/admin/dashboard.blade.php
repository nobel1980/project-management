@extends('layouts.sidebar')

@section('title', 'Admin Dashboard')

@section('content')
    <p>Welcome to the Admin Dashboard!</p>
    <!-- Add admin-specific content here -->
    <div class="container my-5">
  <div class="row g-4">
    <!-- Overdue Issues Card -->
    <div class="col-md-3">
      <div class="card border-danger text-center">
        <div class="card-header bg-danger text-white">
          Overdue Issues
        </div>
        <div class="card-body">
          <h5 class="card-title">25</h5>
          <p class="card-text">Total Overdue Issues</p>
        </div>
      </div>
    </div>

    <!-- Total Complete Issues Card -->
    <div class="col-md-3">
      <div class="card border-success text-center">
        <div class="card-header bg-success text-white">
          Completed Issues
        </div>
        <div class="card-body">
          <h5 class="card-title">150</h5>
          <p class="card-text">Total Completed Issues</p>
        </div>
      </div>
    </div>

    <!-- Pending Issues Card -->
    <div class="col-md-3">
      <div class="card border-warning text-center">
        <div class="card-header bg-warning text-dark">
          Pending Issues
        </div>
        <div class="card-body">
          <h5 class="card-title">40</h5>
          <p class="card-text">Total Pending Issues</p>
        </div>
      </div>
    </div>

    <!-- New Issues Card -->
    <div class="col-md-3">
      <div class="card border-info text-center">
        <div class="card-header bg-info text-white">
          New Issues
        </div>
        <div class="card-body">
          <h5 class="card-title">10</h5>
          <p class="card-text">New Issues This Week</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
