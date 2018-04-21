<?php
/**
 * Created by PhpStorm.
 * User: hoangnguyen
 * Date: 29/03/2018
 * Time: 23:52
 */

namespace App\Response;

use Illuminate\Http\Response;

class ResponseCustom
{
    public static function response($json_data, $statusCode=200)
    {
        $response = [];
        if ($statusCode=200){
            $response['success'] = true;
        }
        $response['data'] = $json_data?json_decode($json_data):[];
        if ($statusCode != 200){
            $statusText = Response::$statusTexts[$statusCode];
            $response->setStatusCode($statusCode,$statusText);
        }
        return $response;
    }
}