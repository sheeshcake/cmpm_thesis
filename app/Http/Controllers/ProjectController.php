<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Plans;
use App\Models\Tasks;
use Auth;

class ProjectController extends Controller
{
    public function ShowAllProjects(){
        
    }

    public function ShowAddProject(){
        return view("layout." . Auth::user()->role . ".add-project")
                ->with("data", [
                    "role" => ucfirst(Auth::user()->role),
                    "page" => "Add Project"
                    ]);
    }

    public function AddProject(Request $request){
        $project = new Projects();
        $project->project_name = $request->data["project_name"];
        $project->project_address = $request->data["project_address"];
        $project->client_id = $request->data["client_id"];
        $project->save();
        return $request->data;

    }
}
