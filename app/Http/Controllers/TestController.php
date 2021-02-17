<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\TestRepository;

class TestController extends Controller
{
    private $testRepository;

    public function __construct(TestRepository $testRepository){
        $this->testRepository = $testRepository;
    }

    public function listTest(){
        // return Test::orderBy('created_at', 'asc')->get();
        return $this->testRepository->listTest();
    }

    public function createTest(Request $request){ #Passing an object into a function is dependency injection or type inting
        # Method 1(Bad method)
        # Every request is an array
        // return Test::create($request->all());
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $data = $this->testRepository->createTest($request->all());
        if (!isset($data['status_code'])){
            return $this->success($data);
        }
        return $this->error($data, 422);

        # Method 2
        // $data = (object) $request;
        // $test = Test::create([
        //     'name' => $data->name,
        //     'description' => $data->description,
        // ]);
        // if (!$test) {
        //     return [
        //         'status' => 442,
        //         'message' => 'Invalid inputs'
        //     ];
        // }

        # Method 3
        // $test = new Test();
        // $test->name = $request->name;
        // $test->description = $request->description;
        // $test->save();
        // return $test;
    }

    public function updateTest(Request $request, $id){
        # Start
        // $this->validate($request, [
        //     'name' => 'required',
        //     'description' => 'required'
        // ]);
        // $data = $this->testRepository->updateTest($id);
        #End
        $test = Test::findOrFail($id);
        $test->update($request->all());
        return $test;
    }

    public function deleteTest($id){
        return Test::find($id)->delete();
    }

    public function apiLogin(Request $request){
        $credentials = collect($request)->only('email', 'password');

        # The code below logs in a user
        $auth = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ]);
        if (!$auth){
            return [
                'status' => 422,
                'message' => 'Invalid login details'
            ];
        }

        return 'User login successful';
    }

}
