<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 14/04/2018
 * Time: 21:59
 */

namespace App\Serializes;

use App\Models\motorbike_type;
use Illuminate\Validation\Rule;

class MotorTypeSerialize extends BasicSerialize
{
    public static function serialize($instance=null)
    {
        self::$model = new motorbike_type();
        self::setSerializeClass(new MotorTypeSerialize($instance));
        return parent::serialize();
    }

    protected function setRules(){
        $this->rules = [
            'name' => 'required|max:255',
            'mft_id' => 'required|integer',
        ];
    }
}