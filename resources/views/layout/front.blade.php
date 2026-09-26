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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('styles')
    
</script>

</head>

<body>
    @include('partials.front.header')
    @yield('content')
    @include('partials.front.footer')
    
    <!-- Template custom -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    
    @yield('scripts')
     
</body>

</html>
