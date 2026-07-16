@extends('layouts.app')

@include('employers.startup-profile._styles')

@section('content')
<section class="sp-wrap">
    <div class="container">
        <div class="sp-card">
            <div class="sp-header">
                <div>
                    <h1>Create Startup Profile</h1>
                    <p>Get listed on the Investor Portal alongside your job postings.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="sp-rejection" style="margin-bottom:18px;">
                    Please fix the errors below and try again.
                </div>
            @endif

            <form action="{{ route('employer.startup-profile.store') }}" method="POST" enctype="multipart/form-data">
                @include('employers.startup-profile._form')
            </form>
        </div>
    </div>
</section>
@endsection

@include('employers.startup-profile._scripts')