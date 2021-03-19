<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Models\UserDetails;
use Illuminate\Models\User;
use Auth;

class EmployeeController extends Controller
{
    public function ShowAllEmployees(){

    }

    public function ShowAddEmployee(Request $request){
        return view("layout." . Auth::user()->role . ".add-employee")
                ->with("data", [
                    "role" => ucfirst(Auth::user()->role),
                    "page" => "Add Employee"
                    ]);
    }

    public function AddEmployee(Request $request){
        $user = new User();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;
        $user->username = $request->f_name . $request->l_name;
        $user->password = $request->l_name . $request->user_birthday;
        $user->save();
        $id = UserDetails::create($request->except(["f_name", "l_name", "email"]))->id;

    }

    public function UpdateEmployee(Request $request){


    }

    public function RemoveEmployee(Request $request){

        
    }
}
