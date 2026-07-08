{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layout.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="card">
        <h2>Welcome back!</h2>
        <p>This is your admin dashboard overview.</p>
        <a href="#" class="btn btn-primary">View Reports</a>
    </div>

    <div class="card">
        <h2>Quick Stats</h2>
        <p>Add your widgets, charts, or tables here.</p>
    </div>
@endsection