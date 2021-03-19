<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Controllers\LoginController;
use Illuminate\Http\Controllers\LogoutController;
use Illuminate\Http\Controllers\RegisterController;
use Illuminate\Http\Controllers\AdminController;
use Illuminate\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function(){
    Route::prefix("/admin")->group(function(){
        Route::get("/dashboard", "AdminController@ShowDashboard")->name("dashboard");
        Route::get("/projects", "AdminController@ShowDashboard")->name("projects");
        Route::prefix("/employees")->group(function(){
            Route::get("/allemployees", "EmployeeController@ShowAllEmployees")->name("allemployees");
            Route::get("/addemployee", "EmployeeController@ShowAddEmployee")->name("addemployee");
            Route::post("/addemployee", "EmployeeController@AddEmployee")->name("addemployee");
        });
    });
});


Route::prefix('/login')->group(function(){
    Route::get("/", "LoginController@ShowLogin");
    Route::post("/", "LoginController@DoLogin")->name('login');
});

Route::prefix('/register')->group(function(){
    Route::get('/', "RegisterController@ShowRegister");
    Route::post('/', "RegisterController@DoRegister")->name("register");
});


Route::post('/logout', "LogoutController@logout")->name('logout');

Route::get('/', function () {
    return view('layout.main')->with('page', "CMPM");
});
