<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetails;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use View;

class EmployeeController extends Controller
{
    public function ShowAllEmployees(){
        $employees = User::join("user_details", "user_details.user_id", "=", "users.id")
                            ->orderBy("users.id")
                            ->get(["users.id as user_id", "users.*", "user_details.*"]);
        return view("layout." . Auth::user()->role . ".all-employee")
                ->with("data", [
                    "role" => ucfirst(Auth::user()->role),
                    "page" => "Employees",
                    "employees" => $employees
                ]);
    }

    public function ShowAddEmployee(Request $request){
        return view("layout." . Auth::user()->role . ".add-employee")
                ->with("data", [
                    "role" => ucfirst(Auth::user()->role),
                    "page" => "Add Employee"
                    ]);
    }

    public function ShowEmployee(Request $request){
        $user_data = User::join("user_details", "user_details.user_id", "=", "users.id")
                            ->where("users.id", "=", $request->id)
                            ->orderBy("users.id")
                            ->get(["users.id as user_id", "users.*", "user_details.*"]);
        return view("layout." . Auth::user()->role . ".employee")
                ->with("data", [
                    "role" => ucfirst(Auth::user()->role),
                    "page" => "Add Employee",
                    "user_data" => $user_data
                    ]);
    }

    public function AddEmployee(Request $request){
        $user = new User();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;
        $user->role = $request->user_position;
        $user->username = $request->f_name . $request->l_name;
        $user->password = Hash::make($request->l_name . $request->user_birthday);
        $user->save();
        $request->merge(["user_id" => $user->id]);
        $id = UserDetails::create($request->except(["f_name", "l_name", "email"]))->id;
        return redirect(Auth::user()->role . '/employees/allemployees')
                ->with("msg", "User Saved!");
    }

    public function UpdateEmployee(Request $request){
        User::where('id', '=', $request->id)
            ->update([
                "f_name" => $request->f_name,
                "l_name" => $request->l_name,
                "email" => $request->email
            ]);
        UserDetails::where('user_id', '=', $request->id)
                ->update($request->except(["f_name", "l_name", "email", "_token", "submit"]));
        return redirect(Auth::user()->role  . '/employee/' . $request->id)
                ->with("msg", "User Updated!");
    }

    public function RemoveEmployee(Request $request){
        User::where("id", $request->id)->delete();
        UserDetails::where("user_id", $request->id)->delete();
        return redirect(Auth::user()->role . '/employees/allemployees')
                    ->with("msg", "User Removed!");
    }
}
