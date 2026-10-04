<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $seo?->meta_title ?? 'Cupstack - Home' }}</title>

    <meta
        name="description"
        content="{{ $seo?->meta_description ?? 'Welcome to Cupstack. Explore premium tech solutions crafted with care.' }}"
    >

    <meta
        name="keywords"
        content="{{ $seo?->meta_keywords ?? 'cupstack, services, tech, development' }}"
    >

    <link rel="canonical" href="{{ $seo?->canonical_url ?? url()->current() }}">

    @if($seo?->og_title)
        <meta property="og:title" content="{{ $seo->og_title }}">
    @endif

    @if($seo?->og_description)
        <meta property="og:description" content="{{ $seo->og_description }}">
    @endif

    @if($seo?->og_image)
        <meta property="og:image" content="{{ asset('/build/assets/' . $seo->og_image) }}">
    @endif

    @if($seo?->twitter_title)
        <meta name="twitter:title" content="{{ $seo->twitter_title }}">
    @endif

    @if($seo?->twitter_description)
        <meta name="twitter:description" content="{{ $seo->twitter_description }}">
    @endif

    @if($seo?->twitter_image)
        <meta name="twitter:image" content="{{ asset('/build/assets/' . $seo->twitter_image) }}">
    @endif

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600"
        rel="stylesheet"
    >

    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    >

    <script
        defer
        src="https://unpkg.com/alpinejs@3.13.5/dist/cdn.min.js"
    ></script>

    <script
        src="https://www.google.com/recaptcha/api.js"
        async
        defer
    ></script>

    <script src="https://www.noupe.com/embed/01a048eece0870008676a2fdc395ca289fca.js"></script>
</head>

<body class="relative min-h-screen bg-[#FDFDFC] text-[#1b1b18]">

    <header class="relative text-sm font-semibold uppercase">
        @include('client.pray-for-nepal')
        @include('client.navbar')
    </header>

    <main class="relative z-10">
        @yield('content')
    </main>
    @include('client.map')
    @include('client.footer')
</body>

</html>