<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="stylesheet" href="css/app.css">
        <style>
            #carousel {
                -ms-overflow-style: none; /* for Internet Explorer, Edge */
                scrollbar-width: none; /* for Firefox */
                overflow-y: scroll;
            }

            #carousel::-webkit-scrollbar {
                display: none; /* for Chrome, Safari, and Opera */
            }
        </style>
    </head>
    <body class="bg-body">

        <div id="app">
            @yield('content')
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
