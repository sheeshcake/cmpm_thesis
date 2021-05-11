<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APILoginController;
use App\Http\Controllers\APIForemanController;
use App\Http\Controllers\APIClientController;
use App\Http\Controllers\APIProjectmanagerController;
use App\Http\Controllers\APIChatController;

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


Route::post("/login", [APILoginController::class, 'dologin']);

Route::prefix("/foreman")->group(function(){
    Route::get('/', "APIForemanController@index");
    Route::get('/projects', [APIForemanController::class, 'showprojects']);
    Route::get('/project/{id}', [APIForemanController::class, 'showproject']);
    Route::get("/plan/{id}", [APIForemanController::class, 'showtasks']); 
    Route::post("/task/report", [APIForemanController::class, 'reporttask']);   
});

Route::prefix("user")->group(function(){
    Route::get('/', "APIForemanController@index");
    Route::get('/projects/{id}', [APIClientController::class, 'showprojects']);
    Route::get('/project/{id}', [APIClientController::class, 'showproject']);
    Route::post('/project/update', "APIForemanController@updateproject");
});
Route::prefix("projectmanager")->group(function(){
    Route::get('/', "APIForemanController@index");
    Route::get('/projects', [APIForemanController::class, 'showprojects']);
    Route::get('/project/{id}', [APIForemanController::class, 'showproject']);
    Route::get("/plan/{id}", [APIForemanController::class, 'showtasks']);
    Route::get("/task/{id}", [APIForemanController::class, 'showtask']); 
    Route::post("/task/report", [APIForemanController::class, 'reporttask']); 
});

Route::prefix('/chat')->group(function(){
    Route::get("/project/{id}", "APIChatController@getchats");
    Route::post("/reply", "APIChatController@replychat");
});