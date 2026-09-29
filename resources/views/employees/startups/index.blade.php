@extends('layouts.app')

@section('title', 'Startups')

@section('content')

<style>
    .employee-startups {
        max-width: 1180px;
        margin: 0 auto;
        padding: 45px 24px 70px;
    }

    .startup-page-header {
        margin-bottom: 30px;
    }

    .startup-page-header h1 {
        margin: 0;
        font-size: 32px;
        color: #0f172a;
    }

    .startup-page-header p {
        margin-top: 8px;
        color: #64748b;
    }

    .startup-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .startup-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 18px;
        overflow: hidden;
        transition: .2s ease;
    }

    .startup-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(15, 23, 42, .08);
    }

    .startup-card-cover {
        height: 145px;
        background: #eef4ff;
        overflow: hidden;
    }

    .startup-card-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .startup-card-body {
        padding: 20px;
    }

    .startup-card-logo {
        width: 58px;
        height: 58px;
        margin-top: -45px;
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        border: 4px solid #fff;
    }

    .startup-card-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .startup-card-logo-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2563eb;
        font-weight: 700;
        background: #eef4ff;
    }

    .startup-card h2 {
        margin: 14px 0 6px;
        font-size: 19px;
        color: #0f172a;
    }

    .startup-card-tagline {
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
        min-height: 42px;
    }

    .startup-card-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin: 15px 0;
    }

    .startup-card-meta span {
        background: #f1f5f9;
        padding: 6px 9px;
        border-radius: 7px;
        color: #475569;
        font-size: 12px;
    }

    .startup-view-btn {
        display: block;
        text-align: center;
        background: #2563eb;
        color: #fff;
        padding: 10px 14px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .empty-startups {
        padding: 50px 20px;
        background: #f8fafc;
        border-radius: 16px;
        text-align: center;
        color: #64748b;
    }

    @media(max-width: 950px) {
        .startup-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 600px) {
        .startup-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="employee-startups">

    <div class="startup-page-header">

        <h1>Discover Startups</h1>

        <p>
            Explore startups and companies looking for talented professionals.
        </p>

    </div>


    @if($profiles->count())

        <div class="startup-grid">

            @foreach($profiles as $profile)

                <div class="startup-card">

                    <div class="startup-card-cover">

                        @if($profile->cover_image)

                            <img
                                src="{{ asset('storage/' . $profile->cover_image) }}"
                                alt="{{ $profile->startup_name }}"
                            >

                        @endif

                    </div>


                    <div class="startup-card-body">

                        <div class="startup-card-logo">

                            @if($profile->logo)

                                <img
                                    src="{{ asset('storage/' . $profile->logo) }}"
                                    alt="{{ $profile->startup_name }}"
                                >

                            @else

                                <div class="startup-card-logo-placeholder">
                                    {{ strtoupper(substr($profile->startup_name, 0, 1)) }}
                                </div>

                            @endif

                        </div>


                        <h2>
                            {{ $profile->startup_name }}
                        </h2>


                        @if($profile->tagline)

                            <div class="startup-card-tagline">
                                {{ $profile->tagline }}
                            </div>

                        @else

                            <div class="startup-card-tagline">
                                {{ $profile->short_description }}
                            </div>

                        @endif


                        <div class="startup-card-meta">

                            @if($profile->industry)
                                <span>{{ $profile->industry }}</span>
                            @endif

                            @if($profile->location)
                                <span>{{ $profile->location }}</span>
                            @endif

                            @if($profile->startup_stage)
                                <span>{{ $profile->startup_stage }}</span>
                            @endif

                        </div>


                        <a
                            href="{{ route('employee.startups.show', $profile->slug) }}"
                            class="startup-view-btn"
                        >
                            View Startup
                        </a>

                    </div>

                </div>

            @endforeach

        </div>


        <div style="margin-top:30px;">
            {{ $profiles->links() }}
        </div>

    @else

        <div class="empty-startups">
            No startups are currently available for employees.
        </div>

    @endif

</div>

@endsection