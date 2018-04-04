<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 03/04/2018
 * Time: 14:33
 */
?>
@extends('/admin/base')
@section('detail')
    <div class='col-md-9 col-xs-12'>
        <div class="card card-content clearfix">
            <div id="manufacturer">
                <div class="lead">
                    {!! \App\_const\strings::title_manufacturer !!}
                </div>
                {!! $form !!}
                <div class="row">
                    <div class="col-xs-8 col-md-9">
                        {!! $name !!}
                    </div>
                    <div class="col-xs-4 col-md-3">
                        {!! $submit !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="manufacturer-list">
                    <div class="row">
                        <div class="col-xs-6 col-md-5">
                            <label>Hãng sản xuất</label>
                        </div>
                        <div class="col-xs-6 col-md-7">
                            <label>Nhãn hiệu</label>
                        </div>
                    </div>
                    <div class="group-items">
                        <div class="bdr-bottom group-row cursor-pt">
                            <div class="row">
                                <div class="col-xs-6 col-md-5 padding-right-10">
                                    Honda
                                </div>
                                <div class="col-xs-6 col-md-7 no-padding-left">
                                    (currently unused)
                                </div>
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </div>
                        <div class="bdr-bottom group-row cursor-pt">
                            <div class="row">
                                <div class="col-xs-6 col-md-5 padding-right-10">
                                    Yamaha
                                </div>
                                <div class="col-xs-6 col-md-7 no-padding-left">
                                    (currently unused)
                                </div>
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css-uncompress')
    <link rel="stylesheet" type=text/css href="{{ asset('/css/form.css') }}">
    <link rel="stylesheet" type=text/css href="{{ asset('/css/manufacturer.css') }}">
@stop()
@section('styles')
    <script src="{{ asset('/js/admin/manufacturer.js') }}"></script>
@stop()
