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
        <label>Group</label>
        <input type="text" class="form-control ai-input" name="name" value="{{ $manu->name }}"
               placeholder="i.e.Sales" />
    </div>
    <div class="group-btn">
        <div class="row">
            <div class="col-xs-3 col-md-3">
                <button class="btn btn-red btn-remove" type="button">Remove</button>
            </div>
            <div class="col-xs-3 col-md-3 pull-right">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
{{ Form::close() }}