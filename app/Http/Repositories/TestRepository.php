<?php

namespace App\Http\Repositories;

use App\Models\Test;

class TestRepository {

    private $testModel;
    public function __construct(Test $testModel){
        $this->testModel = $testModel;
    }

    public function createTest(array $request){
        $data = (object) $request;
        $test = $this->testModel->create([
            'name' => $data->name,
            'description' => $data->description
        ]);

        if(!$test){
            return [
                'status_code' => 422,
                'message' => 'Invalid details'
            ];
        }
        return $test;

    }

    public function listTest(){
        return $this->testModel->orderBy('name', 'ASC')->paginate();
    }

    // public function updateTest($request, $id){
    //     $test = $this->testModel->findorFail($id);
    //     $test = $this->testModel->update([
    //         'name' => $data->name,
    //         'description' => $data->description
    //     ]);
        
    //     if(!$test){
    //         return [
    //             'status_code' => 422,
    //             'message' => 'Invalid details'
    //         ];
    //     }
    //     return $test;

    // }
}