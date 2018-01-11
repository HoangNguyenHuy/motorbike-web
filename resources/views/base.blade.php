<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 10/01/2018
 * Time: 12:50
 */
?>
<!DOCTYPE html>
<html class='v2' dir='ltr'
      xmlns='http://www.w3.org/1999/xhtml'
      xmlns:b='http://www.google.com/2005/gml/b'
      xmlns:data='http://www.google.com/2005/gml/data'
      xmlns:expr='http://www.google.com/2005/gml/expr'>
<head>
    <meta charset='utf-8'/>
    <title>Motorbike @yield('title')</title>
    <link rel="shortcut icon"  href="https://i.ytimg.com/vi/fUWrhetZh9M/maxresdefault.jpg">

    {{--CSS Boostrap--}}
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/fonts/awesome/css/font-awesome.min.css') }}">


    {{--CSS self-definition--}}
    @yield('css-uncompress')
    {{--End CSS--}}

    {{--JS Boostrap--}}
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap4.min.js') }}"></script>

    {{--JS self-definition--}}
    @yield('styles')
    {{--End JS--}}

</head>
<body>
    <div class='page'>
        <!-- Header -->
        @include('header')
        <!-- End Header -->
        <!-- Container -->
        @yield('container')
        <!-- End Container -->
        <!-- Footer -->
        @include('footer')
        <!-- End Footer -->
    </div>
</body>
</html>