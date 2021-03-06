<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>{{__('Laravel Vue JS CRUD Blog - Compasslist')}}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugin/loader/css/main.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet"/>


    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet"/>
</head>
<body>

<div id="app">
</div>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/customFunction.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>