<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excellent Team</title>

    <!-- Meta Tags -->
    <meta name="description"
        content="Excellent Team - Platform pembelajaran terbaik untuk bootcamp, e-course, webinar, dan pelatihan in-house. Tingkatkan skill Anda bersama instruktur berpengalaman.">
    <meta name="keywords"
        content="bootcamp, e-course, webinar, pelatihan, in-house training, pembelajaran online, skill development, excellent team, kursus online, sertifikasi">
    <meta name="author" content="Excellent Team">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Excellent Team - Platform Pembelajaran Terbaik">
    <meta property="og:description"
        content="Platform pembelajaran terbaik untuk bootcamp, e-course, webinar, dan pelatihan in-house. Tingkatkan skill Anda bersama instruktur berpengalaman.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('img/general/webinar.webp') }}">
    <meta property="og:site_name" content="Excellent Team">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Excellent Team - Platform Pembelajaran Terbaik">
    <meta name="twitter:description"
        content="Platform pembelajaran terbaik untuk bootcamp, e-course, webinar, dan pelatihan in-house. Tingkatkan skill Anda bersama instruktur berpengalaman.">
    <meta name="twitter:image" content="{{ asset('img/general/webinar.webp') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('kepala')
</head>

<body>
    <header class="relative">
        @include('layouts.navbar')
        @yield('banner')
    </header>
    @yield('konten')
    @include('layouts.footer')

    @stack('scripts')
</body>

</html>
