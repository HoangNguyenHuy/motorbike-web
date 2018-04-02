<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 02/04/2018
 * Time: 09:51
 */

namespace App\Http\Controllers;


class Core
{
    public static function parseURL($url){
        $debug = true;
        if ($debug){
            return 'images/avatars/'.$url;
        }
        return public_path('images/avatars/'.$url);

    }
}