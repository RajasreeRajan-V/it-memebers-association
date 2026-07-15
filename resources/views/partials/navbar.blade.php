{{-- @if(Auth::check())
    <div style="background:red;color:white;padding:10px">
        Logged In as: {{ Auth::user()->role }}
    </div>
@else
    <div style="background:green;color:white;padding:10px">
        Guest User
    </div>
@endif --}}
@guest

    @include('partials.navbars.guest')

@else

    @switch(auth()->user()->role)

        @case('student')

            @include('partials.navbars.student')

            @break

        @case('employee')

            @include('partials.navbars.employee')

            @break

        @case('employer')

            @include('partials.navbars.employer')

            @break

        @case('freelancer')

            @include('partials.navbars.freelancer')

            @break

        @case('mentor')

            @include('partials.navbars.mentor')

            @break

        @case('investor')

            @include('partials.navbars.investor')

            @break

        @case('admin')

            @include('partials.navbars.admin')

            @break

    @endswitch

@endguest
