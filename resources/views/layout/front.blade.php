<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>{{ $data['meta_title'] }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $data['meta_description'] }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
    <meta property="og:title" content="{{ $data['meta_title'] }}">
    <meta property="og:description" content="{{ $data['meta_description'] }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ route('home') }}/assets/images/logo.png">
    <meta property="og:image:secure_url" content="{{ route('home') }}/assets/images/logo.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Nagaldham Farm">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nagaldham Farm">
    <!-- Favicon-->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('styles')
</head>

<body>
    @include('partials.front.header')
    @yield('content')
    @include('partials.front.footer')
    
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    @yield('scripts')
     
</body>

</html>
