<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($data){
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function error($data, $code = null){
        if (!$code || is_string($code)){
            $code = 422;
        }

        return response()->json([
            'status' => 'error',
            'message' => $data
        ], $code);
    }
}
