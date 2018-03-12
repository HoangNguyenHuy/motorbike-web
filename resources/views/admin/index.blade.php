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
            <div class="card card-content clearfix">
                {!! $form !!}
                <div class="row">
                    <div class="col-md-6">{!! $name !!}</div>
                    <div class="col-md-6">{!! $sex !!}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">{!! $phone_number !!}</div>
                    <div class="col-md-6">{!! $email !!}</div>
                </div>
                <div class="row">
                    <div class="col-md-9">{!! $address !!}</div>
                </div>
                <div class="row">
                    <div class="col-md-12">{!! $password !!}</div>
                </div>
                <div class="row">
                    <div class="col-md-12">{!! $submit !!}</div>
                </div>
            </div>
        </div>
    </div>
@stop()
@section('css-uncompress')
    <link rel="stylesheet" type=text/css href="{{ asset('/css/form.css') }}">
@stop()
