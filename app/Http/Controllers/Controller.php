<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // protected function success($data, $status_code){
    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $data,
    //     ], $status_code);
    // }

    // public function error($data, $status_code){
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => $data
    //     ], $status_code);
    // }

    public function message($data){
        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
        ], $data['status_code']);
    }

    
}
