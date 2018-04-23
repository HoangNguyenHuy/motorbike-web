<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 22/04/2018
 * Time: 15:26
 */
?>
@extends('/admin/base')
@section('detail')
    <div class="card card-content clearfix">
        <div id="toolbar">
            <div class="pull-left header-text">
                <span>
                    All
                    <span class="counter">
                        <span id="_hcounter" style="" class="badge badge-inbox">2</span>
                    </span>
                </span>
            </div>
            <div class="pull-right">
                <div class="toolbar-icons">
                    <ul>
                        <li>
                            <span class="fa fa-plus menu cursor-pt"></span>
                            <span class="fa fa-list-ul menu cursor-pt"></span>
                            <span class="fa fa-filter menu cursor-pt"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="motor-list">
            <div class="row motor-row">
                <div class="col-xs-4">
                    <div class="img-thumbnail">
                        <img src="{{ asset('images/products/20170819_124457.jpg') }}">
                    </div>
                    <div class="sub-img">
                        <img class="img-thumbnail" src="{{ asset('images/products/20170819_124457.jpg') }}">
                        <img class="img-thumbnail" src="{{ asset('images/products/20170819_124457.jpg') }}">
                        <img class="img-thumbnail" src="{{ asset('images/products/20170819_124457.jpg') }}">
                        <div class="img-more img-thumbnail">+6</div>
                    </div>
                </div>
                <div class="col-xs-7 details">
                    <div class="name-wrap">
                        <label class="name">name motor <span>(Full)</span></label>
                    </div>
                    <label>bien so: 43f1-32213</label>
                    <label>mau: xanh</label>
                    <label>price: 46.000.000 VND</label>
                    <label>ngay dang: today</label>
                </div>
                <div class="row-info">
                    <i class="fa fa-chevron-right"></i>
                    {{--<a style="display: block">chi tiet</a>--}}
                </div>
            </div>
            <div class="row motor-row">
                <div class="col-xs-4">
                    <div class="img-thumbnail">
                        <img src="{{ asset('images/products/20170819_124457.jpg') }}">
                    </div>
                    <div class="sub-img">
                        <img class="img-thumbnail" src="{{ asset('images/products/20170819_124457.jpg') }}">
                        <img class="img-thumbnail" src="{{ asset('images/products/20170819_124457.jpg') }}">
                        <img class="img-thumbnail" src="{{ asset('images/products/20170819_124457.jpg') }}">
                        <div class="img-more img-thumbnail">+6</div>
                    </div>
                </div>
                <div class="col-xs-7 details">
                    <div class="name-wrap">
                        <label class="name">name motor <span>(Full)</span></label>
                    </div>
                    <label>bien so: 43f1-32213</label>
                    <label>mau: xanh</label>
                    <label>price: 46.000.000 VND</label>
                    <label>ngay dang: today</label>
                </div>
                <div class="row-info">
                    <i class="fa fa-chevron-right"></i>
                    {{--<a style="display: block">chi tiet</a>--}}
                </div>
            </div>
        </div>
    </div>
@stop
@section('css-uncompress')
    <link rel="stylesheet" type=text/css href="{{ asset('/css/sale.css') }}">
@stop()
@section('styles')
    @parent
@stop()