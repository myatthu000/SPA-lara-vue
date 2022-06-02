<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ mix("/css/app.css") }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <title>Laravel SPA</title>

    </head>

    <body>
{{--        <h1>Laravel + Vue (SPA)</h1>--}}

    <div id="app">

        <product-component></product-component>
        <vue-progress-bar></vue-progress-bar>

    </div>

    </body>

    <script src="{{ mix("/js/app.js")}}"></script>

</html>
