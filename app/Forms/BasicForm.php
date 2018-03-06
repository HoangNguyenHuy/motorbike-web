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
    function init(){
        FormFacade::open(array('url' => 'foo/bar'));
        FormFacade::close();
    }

    static function render_text_input($name , $label='', $default_value='', $placeholder='', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $html = (
            FormFacade::label($name, $label).' : '.
            FormFacade::text($name, $default_value, $attrs)
        );
        return $html;
    }

    static function render_file_input($name, $label='', $attrs=array()){
        $html = (
            FormFacade::label($name, $label).' : '.
            FormFacade::file($name, $attrs)
        );
        return $html;
    }

    static function render_email_field($default_value='', $placeholder='Email Address', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $html = (
            FormFacade::label('Email').' : '.
            FormFacade::email('Email', $default_value, $attrs)
        );
        return $html;
    }

}