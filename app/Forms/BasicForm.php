<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 06/03/2018
 * Time: 10:02
 */

namespace App\Forms;

use Collective\Html\FormFacade;
class BasicForm
{
    static function init_form($route, $form_fields, $method='post', $is_file='false'){
        $html = (
            FormFacade::open(array('route' => $route, 'method' => $method, 'files' => $is_file)).
            $form_fields.
            FormFacade::close()
        );
        return $html;
    }

    static function render_label($name , $label='', $attrs=array(), $is_space=true){
        $html = (
            FormFacade::label($name, $label, $attrs).(($is_space)?' : ':'')
        );
        return $html;
    }

    static function render_text_input($name , $label='', $default_value='', $placeholder='', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $html = (
            self::render_label($name, $label).
            FormFacade::text($name, $default_value, $attrs)
        );
        return $html;
    }

    static function render_file_input($name, $label='', $attrs=array()){
        $html = (
            self::render_label($name, $label).
            FormFacade::file($name, $attrs)
        );
        return $html;
    }

    static function render_email_input($default_value='', $placeholder='Email Address', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $html = (
            self::render_label('Email').
            FormFacade::email('Email', $default_value, $attrs)
        );
        return $html;
    }

    static function render_password_input($name='', $label='', $placeholder='', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $name = (empty($name)) ? 'password' : $name;
        $html = (
            FormFacade::password($name, $attrs).
            self::render_label($name, $label)
        );
        return $html;
    }

    static function render_select($label, array $choices){
        $html = '';
        foreach ($choices as $choice){
            $html= $html.(
                FormFacade::radio($label, $choice['value']).
                self::render_label($choice['label'],'','',false)
            );
        }
        return $html;
    }

    static function user_info_form(){
        $choices[] = array('label'=>'Nam', 'value'=>1);
        $choices[] = array('label'=>'Nữ', 'value'=>0);
        $fields = (
            self::render_text_input('Họ và tên').
            self::render_text_input('Liên hệ','','', 'Phone number').
            self::render_password_input('mật khẩu', '','Password').
            self::render_email_input().
            self::render_select('sex',$choices).
            self::render_text_input('Địa chỉ').
            self::render_file_input('Ảnh đại diện')
        );
        $html = self::init_form('user-info',$fields);
        return $html;
    }
}