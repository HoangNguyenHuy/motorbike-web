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
    {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading">Image Upluad</div>--}}
        {{--<div class="panel-body">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-4 text-center">--}}
                    {{--<div id="upload-demo" style="width:350px"></div>--}}
                {{--</div>--}}
                {{--<div class="col-md-4" style="padding-top:30px;">--}}
                    {{--<strong>Select Image:</strong>--}}
                    {{--<br/>--}}
                    {{--<input type="file" id="upload">--}}
                    {{--<br/>--}}
                    {{--<button class="btn btn-success upload-result">Upload Image</button>--}}
                {{--</div>--}}
                {{--<div class="col-md-4" style="">--}}
                    {{--<div id="upload-demo-i" style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class='row'>
        {{--@include('admin/left-menu')--}}
        <div class='col-md-9 col-xs-12'>
            <div class="card card-content clearfix">
                {!! $form !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile large">
                            <div class="user-info">
                                <div class="profile-pic">
                                    <img src="{{ $avatar_url }}"/>
                                    <div class="layer">
                                        <div class="loader"></div>
                                    </div>
                                    <div class="form-group">
                                        <a class="image-wrapper">
                                            {!! $avatar !!}
                                            <label class="edit glyphicon glyphicon-pencil" for="changePicture" type="file" title="Change picture"></label>
                                        </a>
                                    </div>
                                </div>
                                <div class="username">
                                    <div class="name"><span class="verified"></span>{{ $user_name }}</div>
                                    <div class="about">{{ $email_login }}</div>
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
    <div class="modal fade" id="cropModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    {{--crop image --}}
                    <div class="container">
                    <div id="upload-demo"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop()
@section('css-uncompress')
    <link rel="stylesheet" type=text/css href="{{ asset('/css/form.css') }}">
    <link rel="stylesheet" type=text/css href="{{ asset('/css/user-info.css') }}">
    <link rel="stylesheet" type=text/css href="{{ asset('/plugin/css/croppie.css') }}" />
@stop()
@section('styles')
    <script src="{{ asset('/js/user-info.js') }}"></script>
    <script src="{{ asset('/plugin/js/croppie.js') }}"></script>
    {{-- TODO move it to product page, because it is plugin support zoom image--}}
    {{--http://www.elevateweb.co.uk/image-zoom/examples--}}
    {{--<script src="{{ asset('/plugin/js/jquery.elevatezoom.js') }}"></script>--}}
@stop()
