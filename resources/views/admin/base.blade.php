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
        @include('admin/left-menu')
        @yield('detail')
    </div>
@stop