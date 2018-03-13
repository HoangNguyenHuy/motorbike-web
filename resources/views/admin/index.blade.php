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
                    <div class="col-md-12">
                        <div class="profile large">
                            {{--<div class="cover">--}}
                                {{--<img src="https://source.unsplash.com/random/700x300"/>--}}
                                {{--<div class="layer">--}}
                                    {{--<div class="loader"></div>--}}
                                {{--</div>--}}
                                {{--<a class="image-wrapper" href="#">--}}
                                    {{--<form id="coverForm" action="#">--}}
                                        {{--<input class="hidden-input" id="changeCover" type="file"/>--}}
                                        {{--<label class="edit glyphicon glyphicon-pencil" for="changeCover" title="Change cover"></label>--}}
                                    {{--</form>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                            <div class="user-info">
                                <div class="profile-pic">
                                    <img src="https://source.unsplash.com/random/300x300"/>
                                    <div class="layer">
                                        <div class="loader"></div>
                                    </div>
                                    <a class="image-wrapper" href="#">
                                        <input class="hidden-input" id="changePicture" type="file"/>
                                        <label class="edit glyphicon glyphicon-pencil" for="changePicture" type="file" title="Change picture"></label>
                                    </a>
                                </div>
                                <div class="username">
                                    <div class="name"><span class="verified"></span>@John Doe</div>
                                    <div class="about">Frontend developer and coffee lover</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><hr class="margin-top-0"></div>
                </div>
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
    <link rel="stylesheet" type=text/css href="{{ asset('/css/user-info.css') }}">
@stop()
@section('styles')
    <script src="{{ asset('/js/user-info.js') }}"></script>
@stop()
