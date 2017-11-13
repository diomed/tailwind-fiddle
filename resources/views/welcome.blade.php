<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TailwindCSS Fiddle</title>

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@mkarnicki">
        <meta name="twitter:title" content="Tailwind Fiddle">
        <meta name="twitter:description" content="Fiddle with HTML and CSS Tailwind-style with instant visual feedback. Your editor and browser in one.">
        <meta name="twitter:image" content="https://tailwind.unravel.eu/storage/tailwind-fiddle.png">

        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/preflight.min.css" rel="stylesheet">
        <style>
            html, body {
                height: 100vh;
                margin: 0;
            }
            #editor {
                background-color: transparent !important;
                z-index: 10;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/utilities.min.css" rel="stylesheet">

        {{-- Code editor - ACE --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ace.js"></script>
        {{-- App JS, mostly Vue. --}}
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        {{-- Global site tag (gtag.js) - Google Analytics --}}
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('analytics.tracking_id') }}"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '{{ config('analytics.tracking_id') }}');
        </script>

    </head>

    <body class="overflow-hidden">
        <div id="app" class="w-screen h-screen">
            @include('twfiddle')
        </div>

        <svg class="absolute h-0 w-0 invisible">
            <defs>
                <linearGradient x1="0%" y1="0%" y2="100%" id="logoGradient">
                    <stop stop-color="#2383AE" offset="0%"></stop>
                    <stop stop-color="#6DD7B9" offset="100%"></stop>
                </linearGradient>
            </defs>
        </svg>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ace.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ext-language_tools.js"></script> --}}
        <script src="{{ mix('js/emmet.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ext-emmet.js"></script>

        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
