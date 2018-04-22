<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 03/04/2018
 * Time: 14:35
 */
?>
@extends('base', ['is_show_slide'=> false])
@section('container')
    <div class='row'>
        <div class='col-md-3 col-xs-12'>
            @include('admin/left-menu')
        </div>
        <div class='col-md-9 col-xs-12'>
            @yield('detail')
        </div>
    </div>
@stop
@section('styles')
    <script src="{{ asset('/plugin/js/jsrender.js') }}"></script>
@stop