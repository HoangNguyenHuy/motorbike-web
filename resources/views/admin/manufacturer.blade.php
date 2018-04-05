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
                    @if(count($manu_list))
                    <div class="row">
                        <div class="col-xs-6 col-md-5">
                            <label>Thương hiệu</label>
                        </div>
                        <div class="col-xs-6 col-md-7">
                            <label>Loại xe</label>
                        </div>
                    </div>
                    @endif
                    <div class="group-items">
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
    @parent
    <script src="{{ asset('/js/admin/manufacturer.js') }}"></script>
    <script>
        Manufacturer.init($("#manufacturer"), {!! json_encode($manu_list) !!});
    </script>
@stop()
