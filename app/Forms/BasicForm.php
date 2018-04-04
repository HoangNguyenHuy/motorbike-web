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
    static function init_form($route, $form_id, $method='post', $is_file=false){
        return FormFacade::open(array('route' => $route, 'method' => $method, 'files' => $is_file, 'id'=>$form_id));
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

    static function render_file_input($name, $label='', $attrs_label=array(), $attrs_file=array(), $add_label=true){
        $html = '';
        if($add_label){
            $html = $html.self::render_label($name, $label, $attrs_label);
        }
        $html = $html.FormFacade::file($name, $attrs_file);
        return $html;
    }

    static function render_email_input($default_value='', $placeholder='Email Address', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $attrs['class']  = 'ai-input form-control'.' '.((array_key_exists("class", $attrs))?$attrs['class']:'');
        $html = (
            '<div class="form-group">'.
            self::render_label('email').
            '<div class="controls">'.
            FormFacade::email('email', $default_value, $attrs).
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

    static function user_info_form($profile){
        $choices[] = array('label'=>'Nam', 'value'=>1, 'checked'=>$profile['sex']==1?true:false, 'attrs'=>['data-icon'=>'']);
        $choices[] = array('label'=>'Nữ', 'value'=>0, 'checked'=>$profile['sex']==0?true:false, 'attrs'=>['data-icon'=>'']);
        $attrs_label = ['class'=>'edit glyphicon glyphicon-pencil', 'type'=>'file', 'title'=>'Change picture'];
        $attrs_file = ['class'=>'hidden-input', 'id'=>'changePicture'];
        $fields['name'] = self::render_text_input('name', 'Họ và tên', $profile['name'], 'Full name');
        $fields['phone_number'] = self::render_text_input('phone_number','Liên hệ',$profile['phone_number'], 'Phone number');
        $fields['password'] = self::render_password_input('password', 'mật khẩu','Password');
        $fields['email'] = self::render_email_input($profile['email']);
        $fields['sex'] = self::render_select('sex',$choices,false);
        $fields['address'] = self::render_text_input('address','Địa chỉ',$profile['address']);
        $fields['avatar'] = self::render_file_input('changePicture', '',$attrs_label,$attrs_file,false);
        return $fields;
    }

    static function manufacturer_add_form(){
        $fields['name'] = self::render_text_input('name', 'Thêm nhà sản xuất', '','Manufacturer name');
        $fields['submit'] = BasicForm::render_button('Lưu',['class'=>'btn-primary btn-save', 'style'=>'margin-top: 22px']);
        return $fields;
    }

}