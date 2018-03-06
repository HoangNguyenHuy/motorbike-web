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

    function render_text_input($name ,$label='', $default_value='', $placeholder='', $attrs=array()){
        $attrs['placeholder']  = $placeholder;
        $html = (
            FormFacade::label($name, $label).
            FormFacade::text($name, $default_value, $attrs)
        );
        return $html;
    }


}