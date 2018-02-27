<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 11/01/2018
 * Time: 16:23
 */
?>

<!-- Main Slider -->
<div class='main-slider'>
    <div>
        <div id="slide-show" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#slide-show" data-slide-to="0" class="active"></li>
                <li data-target="#slide-show" data-slide-to="1"></li>
                <li data-target="#slide-show" data-slide-to="2"></li>
                <li data-target="#slide-show" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{asset('/images/1.jpg')}}" alt="1">
                </div>
                <div class="item">
                    <img src="{{asset('/images/2.jpg')}}" alt="2">
                </div>
                <div class="item">
                    <img src="{{asset('/images/3.jpg')}}" alt="3">
                </div>
                <div class="item">
                    <img src="{{asset('/images/4.jpeg')}}" alt="4">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#slide-show" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#slide-show" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<script>
    $('#slide-show').carousel({
        interval: 3000
    });
</script>
<!-- End Main Slider -->
