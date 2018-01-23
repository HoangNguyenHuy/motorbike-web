<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 23/01/2018
 * Time: 11:21
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
    <link rel="shortcut icon" href="{{ asset('/images/vk.jpg') }}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/fonts/awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/admin-login.js') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin-login.css') }}">
</head>
<body>
    <!-- Login Form -->
    <div class="text-center" style="padding:50px 0">
        {{--@if(isset($error))--}}
            {{--<div>{{ $error }} ahihi </div>--}}
            {{--@foreach($error as $error)--}}
                {{--<div class="alert alert-danger">{{$error}}</div>--}}
            {{--@endforeach--}}
        {{--@endif--}}

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                Thông tin đăng ký không đầy đủ, bạn cần chỉnh sửa như sau:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (isset($message))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <div class="logo">login</div>
        <!-- Main Form -->
        <div class="login-form-1">
            <form id="login-form" class="text-left">
                {{ csrf_field ()}}
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group">
                            <label for="lg_username" class="sr-only">Username</label>
                            <input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
                        </div>
                        <div class="form-group">
                            <label for="lg_password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
                        </div>
                        <div class="form-group login-group-checkbox">
                            <input type="checkbox" id="lg_remember" name="lg_remember">
                            <label for="lg_remember">remember</label>
                        </div>
                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
                {{--<div class="etc-login-form">--}}
                    {{--<p>forgot your password? <a href="#">click here</a></p>--}}
                    {{--<p>new user? <a href="#">create new account</a></p>--}}
                {{--</div>--}}
            </form>
        </div>
        <!-- end:Main Form -->
    </div>
    <!-- End Login Form -->
</body>
