<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            font-family: Arial, sans-serif;
        }

        .navbar{
            background:#0d1b2a;
        }

        .navbar a{
            color:white !important;
        }

        footer{
            background:#0d1b2a;
            color:white;
            padding:40px 0;
        }

        .hero{
            padding:120px 0;
            background:linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)),
            url('{{ asset("assets/img/cloud1.png") }}') center/cover;
            color:white;
            text-align:center;
        }
    </style>
</head>
<body>

@include('partials.navbar')

@yield('content')

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>