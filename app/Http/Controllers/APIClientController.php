<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Plans;
use App\Models\Tasks;
use App\Models\TaskReport;

class APIClientController extends Controller
{
    public function showprojects($id){
        $projects = Projects::where("client_id", "=", $id)->get()->toArray();
        return json_encode($projects);
    }

    public function showproject($id){
        $project = Projects::where("id", "=", $id)->get()->toArray();
        $plans = Plans::where("project_id", "=", $project[0]["id"])->get()->toArray();
        foreach($plans as $index => $plan){
            $tasks = Tasks::where("plan_id", "=", $plan["id"])->get()->toArray();
            $plans[$index]["tasks"] = $tasks;
        }
        $project[0]["plans"] = $plans;
        return json_encode($project);
    }

}
