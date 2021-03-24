<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class ProjectManagerController extends Controller
{
    public function ShowDashboard(){
        return view("layout." . Auth::user()->role . ".dashboard")
                ->with("data", [
                    "role" => ucfirst(Auth::user()->role),
                    "page" => "Dashboard"
                    ]);
    }
}
