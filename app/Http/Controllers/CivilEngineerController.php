<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CivilEngineerController extends Controller
{
    public function ShowDashboard(){
        return view("layout." . Auth::user()->role . ".dashboard")
                ->with("data", [
                    "role" => ucfirst(Auth::user()->role),
                    "page" => "Dashboard"
                    ]);
    }
}
