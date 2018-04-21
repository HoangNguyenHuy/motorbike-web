<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 03/04/2018
 * Time: 22:36
 */

namespace App\Serializes;

use App\Models\manufacturer;
use Illuminate\Validation\Rule;

class ManufacturerSerialize extends BasicSerialize
{
    public static function serialize($instance=null)
    {
        self::$model = new manufacturer();
        self::setSerializeClass(new ManufacturerSerialize($instance));
        return parent::serialize();
    }

    protected function setRules(){
        $instance = $this->instance;
        $this->rules = [
            'name' => [
                'required',
                Rule::unique($this->getModelName())->ignore($instance?$instance->id:0),
                'max:255',
            ],
        ];
    }
}