<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplies;
use App\Models\Projects;
use Auth;

class SupplyController extends Controller
{
    public function ShowProject(Request $request){
        $project = Projects::where("id", "=", $request->id)->get()->toArray();
        $supplies = Supplies::where("project_id", "=", $request->id)->get()->toArray();
        return view("layout." . Auth::user()->role . ".project")->with("data", [
            "project" => $project,
            "supplies" => $supplies,
            "role" => Auth::user()->role,
            "page" => $project[0]["project_name"],
        ]);
    }
}
