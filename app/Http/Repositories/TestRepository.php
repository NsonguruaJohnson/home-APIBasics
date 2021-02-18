<?php

namespace App\Http\Repositories;

use App\Models\Test;

class TestRepository {

    private $testModel;
    public function __construct(Test $testModel){
        $this->testModel = $testModel;
    }

    public function createTest($request){
        // dd($request);
        // $data = (object) $request;
        $test = $this->testModel->create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);

        if(!$test){
            return [
                    'status' => 'Error', 
                    'status_code' => 422, 
                    'message' => 'Invalid details'
                ];
            
        } else {
            return [
                'status' => 'Success',
                'status_code' => 201, 
                'message' => 'Record Created'
            ];
        }
        

    }

    public function listTest(){
        return $this->testModel->orderBy('name', 'ASC')->paginate();
    }

    public function updateTest($request, $id){
        $test = $this->testModel->findorFail($id);
        $test = $test->update([
            'name' => $request['name'],
            'description' => $request['description']
        ]);
        
        if(!$test){
            return [
                'status' => 'Error',
                'status_code' => 404, 
                'message' => 'Record Not Found'
            ];
        } else {
            return [
                'status' => 'Updated',
                'status_code' => 200, 
                'message' => 'Record Updated'
            ];
        }

    }

    public function listOneTest($id){
        if ($this->testModel->where('id', $id)->exists()){
            return [
                'status' => 'Success',
                'status_code' => 200,
                'message' => $this->testModel->where('id', $id)->get()
            ];
        } else {
            return [
                'status' => 'Error',
                'status_code' => 404,
                'message' => 'Record not found'
            ];
        }       
    }

    public function deleteTest($id){
        if ($this->testModel->where('id', $id)->exists()){
            $this->testModel->find($id)->delete();
            return [
                'status' => 'Success',
                'status_code' => 200,
                'message' => 'Record deleted'    
            ];
        } else {
            return [
                'status' => 'Error',
                'status_code' => 404,
                'message' => 'Record not found'
            ];
        }
    }
}