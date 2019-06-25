<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts & Styles -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet"> -->
        <link href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <noscript>
            <strong>We're sorry but vue-cli doesn't work properly without JavaScript enabled. 
            Please enable it to continue.</strong>
        </noscript>
        
        <div id="app"></div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>