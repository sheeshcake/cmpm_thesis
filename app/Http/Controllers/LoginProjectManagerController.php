<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectManager;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginProjectManagerController extends Controller
{
    public function ShowLogin(){
        if(Auth::check()){
            return redirect(Auth::user()->role . '/dashboard');
        }else{
            if(ProjectManager::all()->isEmpty()){
                return redirect("register")->with("page", "CMPM | Register");
            }else{
                return view('layout.auth.login-projectmanager')->with("page", "CMPM | Login");  
            }
        }
    }

    public function DoLogin(Request $request){
        $rules = array(
            'username' => 'required|alphaNum|min:3',
            'password' => 'required|alpha_dash|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return Redirect::back()->withInput($request->input())->with([
                'msg' => 'Username or Password Error.',
                'status' => 'danger'
            ]);
        }else{
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect(Auth::user()->role . '/dashboard');
            }else{
                return Redirect::back()->withInput($request->input())->with([
                    'msg' => 'Username or Password is incorrect.',
                    'status' => 'danger'
                ]);
            }
        }
    }
}
