<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 25/03/2018
 * Time: 23:12
 */

namespace App\Serializes;

use App\Models\UserProfile;
use Illuminate\Validation\Rule;

class UserSerialize extends BasicSerialize
{
    public static function serialize($instance=null)
    {
        self::$model = new UserProfile();
        self::setSerializeClass(new UserSerialize($instance));
        return parent::serialize();
    }

    protected function setRules(){
        $instance = $this->instance;
        $this->rules = [
            'name' => 'required|max:255',
            'email' => [
                'required',
                Rule::unique($this->getModelName())->ignore($instance?$instance->id:0),
                'max:255',
            ],
            'phone_number' => [
                'required',
                Rule::unique($this->getModelName())->ignore($instance?$instance->id:0),
            ],
        ];
    }
}