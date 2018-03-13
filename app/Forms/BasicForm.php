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
    static function init_form($route, $method='post', $is_file=false){
        return FormFacade::open(array('route' => $route, 'method' => $method, 'files' => $is_file));
    }

    static function render_button($name, $attrs=array(), $is_submit=true){
        $attrs['class']  = 'btn'.' '.((array_key_exists("class", $attrs))?$attrs['class']:'');
        $button = ($is_submit)?'submit':'button';
        return FormFacade::$button($name, $attrs);
    }

    static function render_label($name , $label='', $attrs=array(), $is_space=false){
        $attrs['class']  = 'control-label'.' '.((array_key_exists("class", $attrs))?$attrs['class']:'');
        $html = (
            FormFacade::label($name, $label, $attrs).(($is_space)?' : ':'')
        );
        return $html;
    }

    static function render_text_input($name , $label='', $default_value='', $placeholder='', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $attrs['class']  = 'ai-input form-control'.' '.((array_key_exists("class", $attrs))?$attrs['class']:'');
        $html = (
            '<div class="form-group">'.
            self::render_label($name, $label).
            '<div class="controls">'.
            FormFacade::text($name, $default_value, $attrs).
            '</div></div>'
        );
        return $html;
    }

    static function render_file_input($name, $label='', $attrs=array()){
        $html = (
            '<div class="form-group">'.
            self::render_label($name, $label).
            FormFacade::file($name, $attrs).
            '</div>'
        );
        return $html;
    }

    static function render_email_input($default_value='', $placeholder='Email Address', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $attrs['class']  = 'ai-input form-control'.' '.((array_key_exists("class", $attrs))?$attrs['class']:'');
        $html = (
            '<div class="form-group">'.
            self::render_label('Email').
            '<div class="controls">'.
            FormFacade::email('Email', $default_value, $attrs).
            '</div></div>'
        );
        return $html;
    }

    static function render_password_input($name='', $label='', $placeholder='', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $attrs['class']  = 'ai-input form-control'.' '.((array_key_exists("class", $attrs))?$attrs['class']:'');
        $name = (empty($name)) ? 'password' : $name;
        $html = (
            '<div class="form-group">'.
                self::render_label($name, $label).
            '<div class="controls">'.
                FormFacade::password($name, $attrs).
            '</div></div>'
        );
        return $html;
    }

    static function render_select($label='', array $choices, $add_label=true){
        $html = '<div class="form-group">';
        foreach ($choices as $choice){
            $checked = (array_key_exists("checked", $choice));
            $attrs = (array_key_exists("attrs", $choice));
            $html= $html.FormFacade::radio($label, $choice['value'],$checked?$choice['checked']:false, $attrs?$choice['attrs']:'');
            if($add_label){
                $html = $html.self::render_label($choice['label']);
            }
        }
        return $html.'</div>';
    }

    static function user_info_form(){
        $choices[] = array('label'=>'Nam', 'value'=>1, 'checked'=>true, 'attrs'=>['data-icon'=>'']);
        $choices[] = array('label'=>'Nữ', 'value'=>0, 'checked'=>false, 'attrs'=>['data-icon'=>'']);
        $fields['name'] = self::render_text_input('Họ và tên', '', '', 'Full name');
        $fields['phone_number'] = self::render_text_input('Liên hệ','','', 'Phone number');
        $fields['password'] = self::render_password_input('mật khẩu', '','Password');
        $fields['email'] = self::render_email_input();
        $fields['sex'] = self::render_select('sex',$choices,false);
        $fields['address'] = self::render_text_input('Địa chỉ');
        $fields['avatar'] = self::render_file_input('Ảnh đại diện');
        return $fields;
    }
}