<?php

namespace App\Models;


class UserProfile extends BaseModel
{
    protected $fillable = [
        'user_id', 'name', 'email', 'phone_number', 'sex', 'address', 'avatar',
    ];
}
