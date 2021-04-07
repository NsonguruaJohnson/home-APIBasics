<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CourseController;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api){
    // $groupOptions = [
    //     'namespace' => 'App\Http\Controllers',
    //     'prefix' => '',
    // ];

    // $api->group($groupOptions, function() use ($api){

        $api->get('/courses/list', [CourseController::class, 'list']);
        $api->post('/courses/create', [CourseController::class, 'create']);
        $api->post('/courses/update/{id}', [CourseController::class, 'update']);
        $api->get('/courses/get-course/{id}', [CourseController::class, 'getOneCourse']);
        $api->delete('/courses/delete/{id}', [CourseController::class, 'deleteCourse']);

    });
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

# To be continued on Friday 28/01/2021
Route::post('api/login', [TestController::class, 'apiLogin']);

Route::group(['middleware'  => ['auth:api', 'admin']], function (){

});

Route::get('list-test', [TestController::class, 'listTest']);
Route::post('create-test', [TestController::class, 'createTest']);
Route::post('update-test/{id}', [TestController::class, 'updateTest']);
Route::get('list-one-test/{id}', [TestController::class, 'listOneTest']);
Route::delete('delete-test/{id}', [TestController::class, 'deleteTest']);


