<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APILoginController;
use App\Http\Controllers\APIForemanController;
use App\Http\Controllers\APIClientController;
use App\Http\Controllers\APIProjectmanagerController;
use App\Http\Controllers\APICivilengineerController;
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

Route::prefix("/projectmanager")->group(function(){
    Route::get('/projects', [APIProjectmanagerController::class, 'showprojects']);
    Route::get('/project/{id}', [APIProjectmanagerController::class, 'showproject']);
    Route::get("/plan/{id}", [APIProjectmanagerController::class, 'get_tasks']);
    Route::get("/report/{id}", [APIProjectmanagerController::class, 'get_report']);
    Route::post("/report/approve", [APIProjectmanagerController::class, 'approve_report']); 
});

Route::prefix("/civilengineer")->group(function(){
    Route::get('/projects', [APICivilengineerController::class, 'showprojects']);
    Route::get('/project/{id}', [APICivilengineerController::class, 'showproject']);
    Route::get("/plan/{id}", [APICivilengineerController::class, 'get_tasks']);
    Route::get("/report/{id}", [APICivilengineerController::class, 'get_report']);
    Route::post("/report/approve", [APICivilengineerController::class, 'approve_report']); 
});

Route::prefix("user")->group(function(){
    Route::get('/projects/{id}', [APIClientController::class, 'showprojects']);
    Route::get('/project/{id}', [APIClientController::class, 'showproject']);
});
Route::prefix("foreman")->group(function(){
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