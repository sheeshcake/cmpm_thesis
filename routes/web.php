<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Controllers\LoginController;
use Illuminate\Http\Controllers\LogoutController;
use Illuminate\Http\Controllers\RegisterController;
use Illuminate\Http\Controllers\AdminController;
use Illuminate\Http\Controllers\ProjectManagerController;
use Illuminate\Http\Controllers\CivilEngineerController;
use Illuminate\Http\Controllers\EmployeeController;
use Illuminate\Http\Controllers\ProjectsController;

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
    Route::group(['middleware' => ['auth'], 'guard' => ['admin']],function(){
        Route::get("/employee/{id}", "EmployeeController@ShowEmployee")->name("employee");
        Route::prefix("/employees")->group(function(){
            Route::get("/", "EmployeeController@ShowAllEmployees")->name("employees");
            Route::get("/addemployee", "EmployeeController@ShowAddEmployee")->name("addemployee");
            Route::post("/addemployee", "EmployeeController@AddEmployee")->name("addemployee");
            Route::post("/removeemployee", "EmployeeController@RemoveEmployee")->name("removeemployee");
            Route::post("/updateemployee", "EmployeeController@UpdateEmployee")->name("updateemployee");
        });
    });
    Route::group(['middleware' => ['auth'], 'guard'=>['projectmanager', 'admin', 'civilengineer']], function(){
        Route::get("/dashboard", "DashboardController@ShowDashboard")->name("dashboard");
        Route::prefix("/projects")->group(function(){
            Route::get("/", "ProjectController@ShowAllProjects")->name("projects");
            Route::post("/getdata", "ProjectController@GetProjectData")->name("getdata");
            Route::get("/project/{id}", "ProjectController@ShowProject")->name("showproject");
            Route::get("/newproject", "ProjectController@ShowAddProject")->name("newproject");
            Route::post("/addproject", "ProjectController@AddProject")->name("addproject");
            Route::post("/removeproject", "ProjectController@RemoveProject")->name("removeproject");
            Route::post("/updateproject", "ProjectController@UpdateProject")->name("updateproject");
        });
    });

    Route::group(['middleware' => ['auth'], 'guard' => ['projectmanager']], function(){
        Route::prefix('/clients')->group(function(){
            Route::get("/newclient", function(){})->name("newclient");
            Route::get("/", function(){})->name("clients");
        });
    });


    Route::prefix('/login')->group(function(){
        Route::get("/", "LoginController@ShowLogin");
        Route::post("/", "LoginController@DoLogin")->name('login');
    });
    Route::prefix('/loginprojectmanager')->group(function(){
        Route::get("/", "LoginProjectManagerController@ShowLogin");
        Route::post("/", "LoginProjectManagerController@DoLogin")->name('loginprojectmanager');
    });
    Route::prefix('/logincivilengineer')->group(function(){
        Route::get("/", "LoginCivilEngineerController@ShowLogin");
        Route::post("/", "LoginCivilEngineerController@DoLogin")->name('logincivilengineer');
    });

    Route::prefix('/register')->group(function(){
        Route::get('/', "RegisterController@ShowRegister");
        Route::post('/', "RegisterController@DoRegister")->name("register");
    });


    Route::post('/logout', "LogoutController@logout")->name('logout');

    Route::get('/', function () {
        return view('layout.main')->with('page', "CMPM");
    });
