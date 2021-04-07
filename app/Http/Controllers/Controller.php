<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Dingo\Api\Routing\Helpers;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use function fractal;
use function response;

class Controller extends BaseController
{
    use Helpers, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($data){
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function error($data, $status_code){
        return response()->json([
            'status' => 'error',
            'message' => $data
        ], $status_code);
    }

    public function message($data){
        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
        ], $data['status_code']);
    }

    public function handleErrorResponse(){

    }

    protected function successWithPages($paginator, $transformer, $resourceName = null){
        $collection = $paginator->getCollection();

        if (!$resourceName){
            $resourceName = 'items';
        }

        $data = fractal()
            ->collection($collection)
            ->transformWith($transformer)
            ->serializeWith(new ArraySerializer())
            ->withResourceName($resourceName)
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray();

        return response()->json([
            'status' => 'success',
            'message' => $data,
        ]);
    }

    protected function transform($model, $transformer){
        $data = fractal($model, $transformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
        return $this->success($data);
        
    }
    
}
