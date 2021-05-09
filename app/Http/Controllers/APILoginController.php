<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Auth;

class APILoginController extends Controller
{
    public function dologin(Request $request){
        $credentials = $request->only("username", "password");
        if(Auth::attempt($credentials)){
            return json_encode(Auth::user()->toArray());
        }else{
            return json_encode([
                "msg" => "Username or Password is invalid!"
            ]);
        }
    }
}
