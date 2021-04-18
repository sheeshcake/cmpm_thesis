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

Route::group(['middleware' => ['auth']], function(){
    Route::group(['guard' => ['admin']],function(){
        Route::prefix('/admin')->group(function(){
            Route::get("/dashboard", "AdminController@ShowDashboard")->name("dashboard");
            Route::get("/projects", "AdminController@ShowDashboard")->name("projects");
            Route::get("/employee/{id}", "EmployeeController@ShowEmployee")->name("employee");
            Route::prefix("/employees")->group(function(){
                Route::get("/allemployees", "EmployeeController@ShowAllEmployees")->name("allemployees");
                Route::get("/addemployee", "EmployeeController@ShowAddEmployee")->name("addemployee");
                Route::post("/addemployee", "EmployeeController@AddEmployee")->name("addemployee");
                Route::post("/removeemployee", "EmployeeController@RemoveEmployee")->name("removeemployee");
                Route::post("/updateemployee", "EmployeeController@UpdateEmployee")->name("updateemployee");
            });
        });
    });
    Route::prefix("/civilengineer")->group(function(){
        Route::get("/dashboard", "CivilEngineerController@ShowDashboard")->name("dashboard");
        // Route::prefix("/employees")->group(function(){
        //     Route::get("/projects", "ProjectController@ShowAllProjects")->name("allprojects");
        //     Route::get("/addproject", "ProjectController@ShowAddProject")->name("addproject");
        //     Route::post("/addproject", "ProjectController@AddProject")->name("addproject");
        //     Route::post("/removeproject", "ProjectController@RemoveProject")->name("removeproject");
        //     Route::post("/updateproject", "ProjectController@UpdateProject")->name("updateproject");
        // });
    });
    Route::group(['guard' => ['projectmanager']], function(){
        Route::prefix("/projectmanager")->group(function(){
            Route::get("/dashboard", "ProjectManagerController@ShowDashboard")->name("dashboard");
            Route::prefix("/projects")->group(function(){
                Route::get("/", "ProjectController@ShowAllProjects")->name("allprojects");
                Route::get("/newproject", "ProjectController@ShowAddProject")->name("newproject");
                Route::post("/addproject", "ProjectController@AddProject")->name("addproject");
                Route::post("/removeproject", "ProjectController@RemoveProject")->name("removeproject");
                Route::post("/updateproject", "ProjectController@UpdateProject")->name("updateproject");
            });
            Route::prefix("/clients")->group(function(){
                Route::get("/", "ClientController@ShowAllClients")->name("allclients");
                Route::get("/newclient", "ClientController@ShowAddClient")->name("newclient");
                Route::post("/addclient", "ClientController@AddClient")->name("addclient");
            });
        });
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

Route::prefix('/register')->group(function(){
    Route::get('/', "RegisterController@ShowRegister");
    Route::post('/', "RegisterController@DoRegister")->name("register");
});


Route::post('/logout', "LogoutController@logout")->name('logout');

Route::get('/', function () {
    return view('layout.main')->with('page', "CMPM");
});
