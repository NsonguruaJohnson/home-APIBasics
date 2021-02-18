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
        # Every request is an array
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $data = $this->testRepository->createTest($request->only('name', 'description'));
        // dd($request);
        return $this->message($data);

    }

    public function listOneTest($id){
        $data = $this->testRepository->listOneTest($id);
        return $this->message($data);
        
    }

    public function updateTest(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $data = $this->testRepository->updateTest($request->only('name', 'description'), $id);

        return $this->message($data);
    }

    public function deleteTest($id){
        $data = $this->testRepository->deleteTest($id);
        return $this->message($data);
        // return Test::find($id)->delete();
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
