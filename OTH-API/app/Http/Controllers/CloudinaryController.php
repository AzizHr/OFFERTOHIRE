<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary\Api\ApiUtils;
use Cloudinary\Configuration\CloudConfig;

class CloudinaryController extends Controller
{
    public static function getsignature(){
        $cloudinaryConfig = new CloudConfig([
            "cloud_name" => env('cloud_name'),
            "api_key" => env('api_key'),
            "api_secret" => env('api_secret')
        ]);
        $timestamp=time();
        $params =
            [
                "timestamp" => time(),
                "folder" => 'incub'
            ];
        $data = ['signature' => ApiUtils::signParameters($params, $cloudinaryConfig->apiSecret), 'timestamp' => $timestamp];
        return response()->json($data, 200);

    }
}
