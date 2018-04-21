<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 06/04/2018
 * Time: 16:39
 */
?>
<div class="title-text">
    Chỉnh sửa thông tin nhà sản xuất. Xóa nhà sản xuất không loại bỏ thông tin sản phẩm được liên kết với nó.
</div>
{{ Form::open(array('autocomplete'=>'off','class'=>'font-small', 'url' => route( 'edit-manufacturer',['id' => $manu->id]), 'id'=>'form_edit_manufacturer'))}}
    <input type="hidden" name="id" value="{{ $manu->id }}"/>
    <div class="form-group">
        <label>Tên hãng</label>
        <input type="text" class="form-control ai-input" name="name" value="{{ $manu->name }}"
               placeholder="Manufacturer name" />
    </div>
    <div class="row">
        <div class="col-md-12"><hr class="margin-top-0"></div>
    </div>
    <div class="form-group" id="motor-type">
        <label>Loại xe</label>
        <div class="row">
            <div class="col-md-8">
                <input type="text" class="form-control ai-input" id="type" placeholder="Motorbike type" />
            </div>
            <div class="col-xs-3 col-md-3">
                <button class="btn btn-primary btn-add" type="button">Thêm</button>
            </div>
        </div>
        <ul>
            <li id="new-type">
                <div class="name-type allow-edit"></div>
                <div class="tools">
                    <span class="glyphicon glyphicon-edit edit" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Edit"></span>
                    <span class="glyphicon glyphicon-floppy-save save" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Save"></span>
                    <span class="glyphicon glyphicon-trash delete" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Delete"></span>
                </div>
            </li>
        </ul>
        <div class="_results">
            <ul class="_items">
                @forelse ($motor_type as $type)
                    <li id="{{ $type->id }}">
                        <div class="name-type allow-edit">{{ $type->name }}</div>
                        <div class="tools">
                            <span class="glyphicon glyphicon-edit edit" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Edit"></span>
                            <span class="glyphicon glyphicon-floppy-save save" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Save"></span>
                            <span class="glyphicon glyphicon-trash delete" aria-hidden="true" data-toggle="tooltip" title="" data-original-title="Delete"></span>
                        </div>
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
    </div>
    <div class="group-btn">
        <div class="row">
            <div class="col-xs-3 col-md-3">
                <button class="btn btn-red btn-remove" type="button">Remove</button>
            </div>
            <div class="col-xs-3 col-md-3 pull-right">
                <button class="btn btn-primary btn-save hide" type="submit">Save</button>
            </div>
        </div>
    </div>
{{ Form::close() }}