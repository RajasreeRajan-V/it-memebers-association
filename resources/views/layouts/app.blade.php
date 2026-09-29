<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tech Leaders Network — One Platform, Endless Opportunities</title>

    {{-- Bootstrap CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet"
    >

    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Profile CSS --}}
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    {{-- Page-specific styles --}}
    @stack('styles')
</head>

<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('partials.footer')


    {{-- =====================================================
         JAVASCRIPT
    ====================================================== --}}

    {{-- Navbar JS --}}
    <script src="{{ asset('js/navbar.js') }}"></script>

    {{-- Profile JS --}}
    <script src="{{ asset('js/profile.js') }}"></script>

    {{-- Bootstrap JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
    </script>

    {{-- Page-specific JavaScript --}}
    @stack('scripts')

</body>

</html>