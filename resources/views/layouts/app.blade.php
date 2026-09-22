<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .app-flash {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 18px 0;
            padding: 16px 18px;
        }

        .app-flash .btn-close {
            margin-left: auto;
        }
    </style>
    <!-- Isi title yang kita kirimkan dari views lain-->
    <title>@yield('title')</title>
    <!-- memanggil link bootstrap-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="container">
        @include('layouts.flash')
        <!-- Isi konten yang kita kirimkan dari views lain-->
        @yield('content')
    </div>

</body>
</html>