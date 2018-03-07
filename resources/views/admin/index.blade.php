<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 05/03/2018
 * Time: 15:58
 */
?>
@extends('base', ['is_show_slide'=> false])
@section('container')
    <div class='row'>
        @include('admin/left-menu')
        <div class='col-md-9 col-xs-12'>
            {!! $form !!}
        </div>
    </div>
@stop()
