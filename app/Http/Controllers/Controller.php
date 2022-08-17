<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function responseData(bool $success, bool $error, $data, int $code) {
        return response()->json([
            'success' => $success,
            ($error === true) ? 'message' : 'data' => $data,
            'code' => $code
        ]);
    }
}
