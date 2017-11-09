<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TailwindCSS fiddle</title>

        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/preflight.min.css" rel="stylesheet">
        <style>
            html, body {
                height: 100vh;
                margin: 0;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/utilities.min.css" rel="stylesheet">

        <script async src="{{ mix('js/app.js') }}"></script>
    </head>

    <body>
        <div id="app" class="w-screen h-screen">
            @include('twfiddle')
        </div>

        <svg style="height: 0; width: 0; position: absolute; visibility: hidden;">
            <defs>
                <linearGradient x1="0%" y1="0%" y2="100%" id="logoGradient">
                    <stop stop-color="#2383AE" offset="0%"></stop>
                    <stop stop-color="#6DD7B9" offset="100%"></stop>
                </linearGradient>
            </defs>
        </svg>
    </body>
</html>
