<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 26/03/2018
 * Time: 23:33
 */

namespace App\Serializes;

use App\_const\strings;

use Exception;

class BasicSerialize
{
    public static $model = null;
    private static $obj = null;
    public $instance = null;
    private $validate_data = null;
    public $rules = null;
    private $message = [
        'required' => ':attribute is required.',
        'max' => ':attribute is max 255 character.',
        'unique' => ':attribute does exist.'
    ];

    public function __construct($instance)
    {
        if ($instance) $this->instance = $instance;
    }

    public function _validate(){
        if (!$this->rules){
            throw new Exception(strings::undefined_rules);
        }
        $validate_data = request()->validate($this->rules, $this->message);
        $this->validate_data = $validate_data;
    }

    protected static function serialize()
    {
        if (!isset(self::$obj)) {
            throw new Exception(strings::undefined_serialize);
        }
        self::$obj->setRules();
        self::$obj->_validate();
        return self::$obj->validate_data;
    }

    protected function setRules(){}

    public static function setSerializeClass($new_obj)
    {
        self::$obj = $new_obj;
    }

    public function getModelName(){
        if (!isset(self::$model)) {
            throw new Exception(strings::undefined_serialize);
        }
        return self::$model->getTable();
    }
}