<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Propay') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    <div id="app">
        <main class="py-4">
            @include('inc.nav')
            <hr>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

{{--        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>--}}
{{--        <script src="/ckeditor/ckeditor.js"></script>--}}
{{--        <script>--}}
{{--            $(document).ready(function () {--}}
{{--                function loadInterests(user_id, user_name) {--}}
{{--                    alert(user_name);--}}
{{--                }--}}
{{--            });--}}
{{--        </script>--}}


</body>
</html>
