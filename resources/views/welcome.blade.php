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
    </head>

    <body id="app" class="flex flex-col">
        <div class="fiddle w-full h-auto overflow-hidden overflow-y-scroll">
        </div>

        <div class="w-full flex flex-col items-center" style="height: 40rem;">
            <textarea class="w-full flex-1" name="name" rows="8" cols="80"></textarea>
            <div class="h-8 flex items-center">
                <span class="text-xs">Made with 🎵 by <a class="antialiased no-underline text-blue" href="https://twitter.com/mkarnicki"><strong>@mkarnicki</strong></a></span>
            </div>
        </div>
    </body>
</html>
