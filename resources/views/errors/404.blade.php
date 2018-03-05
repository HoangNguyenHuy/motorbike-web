<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 28/02/2018
 * Time: 11:37
 */
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Error 404 Page</title>
    <link rel="shortcut icon" href="{{ asset('/images/vk.jpg') }}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/404.css') }}">
</head>
<body>
<!-- Error Page -->
<div class="error">
    <div class="container-floud">
        <div class="col-xs-12 ground-color text-center">
            <div class="container-error-404">
                <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                <div class="msg">OH!<span class="triangle"></span></div>
            </div>
            <h2 class="h1">Sorry! Page not found</h2>
        </div>
    </div>
</div>
<!-- Error Page -->
</body>
<script src="{{ asset('/js/404.js') }}"></script>
</html>
