<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/pngwing.com(1).png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('vendor/smart-ads/js/smart-banner.min.js') }}"></script>

    <style>

        #carousel {
            -ms-overflow-style: none; /* for Internet Explorer, Edge */
            scrollbar-width: none; /* for Firefox */
            overflow-y: scroll;
        }

        #carousel::-webkit-scrollbar {
            display: none; /* for Chrome, Safari, and Opera */
        }

        .description ul {
            list-style-position: inside !important;

            padding-left: 20px;

        }

        .description li {
            list-style: disc !important;
            list-style-position: inside;
        }

        .description table tbody tr td {
            border: 2px solid black;
            padding: 10px;

        }

        .smart-banner img {
            /* min-width: 100%; */
            margin: 0 auto;
            /* padding: 0px 50px; */
        }
    </style>


</head>
<body class="bg-body">

<div id="app">
    {{-- main container --}}
    @yield('content')
</div>

{{-- javascript --}}
<script src="{{ mix('js/app.js') }}"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8663128251843654"
        crossorigin="anonymous"></script>
{{--other javascript --}}
@yield('scripts')
</body>
</html>
