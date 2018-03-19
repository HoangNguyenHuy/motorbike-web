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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Motorbike @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/images/vk.jpg') }}">

    {{--CSS Boostrap--}}
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/fonts/awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type=text/css href="{{ asset('/css/base-style.css') }}">
    <link rel="stylesheet" type=text/css href="{{ asset('/css/button.css') }}">


    {{--CSS self-definition--}}
    @yield('css-uncompress')
    {{--End CSS--}}

    {{--JS Boostrap--}}
    <script src="{{ asset('/bootstrap/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('/js/base.js') }}"></script>

    {{--JS self-definition--}}
    @yield('styles')
    {{--End JS--}}

</head>
<body>
    <div class='page'>
        <!-- Header -->
        @include('header', ['is_show_slide' => $is_show_slide])
        <!-- End Header -->
        <!-- Container -->
        <div class='container'>
            @yield('container')
        </div>
        <!-- End Container -->
        <!-- Footer -->
        @include('footer')
        <!-- End Footer -->
    </div>
</body>
</html>