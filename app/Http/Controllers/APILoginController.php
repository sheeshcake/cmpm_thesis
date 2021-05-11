<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Clients;

use Auth;
use Hash;

class APILoginController extends Controller
{
    public function dologin(Request $request){
        $credentials = $request->only("username", "password");
        if(Auth::attempt($credentials)){
            return json_encode(Auth::user()->toArray());
        }else{
            $user = Clients::where("client_username", "=", $request->username)->get();
            if(Hash::check($request->password, $user[0]["client_password"])){
                return json_encode($user[0]);
            }else{
                return json_encode([
                    "msg" => "Username or Password is invalid!"
                ]);
            }
        }
    }
}
