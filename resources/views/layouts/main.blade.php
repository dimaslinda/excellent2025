<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excellent Team</title>

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
