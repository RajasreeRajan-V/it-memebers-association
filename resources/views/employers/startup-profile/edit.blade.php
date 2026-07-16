@extends('layouts.app')

@include('employers.startup-profile._styles')

@section('content')
<section class="sp-wrap">
    <div class="container">
        <div class="sp-card">
            <div class="sp-header">
                <div>
                    <h1>Edit Startup Profile</h1>
                    <p>Any changes will send your profile back for admin re-approval.</p>
                </div>
                <span class="sp-status sp-status-{{ $profile->status }}">{{ $profile->status }}</span>
            </div>

            @if ($errors->any())
                <div class="sp-rejection" style="margin-bottom:18px;">
                    Please fix the errors below and try again.
                </div>
            @endif

            <form action="{{ route('employer.startup-profile.update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('employers.startup-profile._form')
            </form>
        </div>
    </div>
</section>
@endsection

@include('employers.startup-profile._scripts')