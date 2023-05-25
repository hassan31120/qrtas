<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('dash/assets/qrtas.png') }}">

    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('dash/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('dash/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('dash/css/app-dark.css') }}" id="darkTheme" disabled>
    @vite('resources/css/app.css')

</head>

<body class="vertical light rtl">
    <div id="app"></div>
    @vite('resources/js/app.js')
    <script src="{{ asset('dash/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dash/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dash/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('dash/js/apps.js') }}"></script>
</body>

</html>
