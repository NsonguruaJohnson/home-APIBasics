<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

# To be continued on Friday 28/01/2021
Route::post('api/login', [TestController::class, 'apiLogin']);

Route::group(['middleware'  => ['auth:api', 'admin']], function (){
    Route::post('update-test/{id}', [TestController::class, 'updateTest']);
    Route::delete('delete-test/{id}', [TestController::class, 'deleteTest']);

});

Route::get('list-test', [TestController::class, 'listTest']);
Route::post('create-test', [TestController::class, 'createTest']);



