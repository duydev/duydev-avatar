<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{{ config('app.locale') }}"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="{{ config('app.locale') }}"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="{{ config('app.locale') }}"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="{{ config('app.locale') }}"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">
    @stack('css')
    <script src="{{ asset('assets/frontend/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
@include('frontend.partials.navbar')
<div class="container">
    @yield('content')
    @include('frontend.partials.footer')
</div> <!-- /container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ asset('assets/frontend/js/vendor/jquery-1.11.2.min.js') }}"><\/script>')</script>
<script src="{{ asset('assets/frontend/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>
@stack('js')
</body>
</html>
