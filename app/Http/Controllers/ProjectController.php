<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Plans;
use App\Models\Tasks;
use App\Models\User;
use App\Models\Clients;

use Auth;

class ProjectController extends Controller
{
    public function ShowAllProjects(){
        
    }

    public function ShowAddProject(){
        $users = User::where("role" , "=", "foreman")
                    ->orWhere("role", "=", "civilengineer")
                    ->get();
        $clients = Clients::all();
        return view("layout." . Auth::user()->role . ".add-project")
                ->with("data", [
                    "role" => ucfirst(Auth::user()->role),
                    "users" => $users,
                    "clients" => $clients,
                    "page" => "Add Project"
                    ]);
    }


    public function GetProjectData($id){
        $project_data = [];
        $project_details = Projects::where("id", "=", $id)->get()->toArray();
        $project_data = $project_details[0];
        $project_plans = Plans::where("project_id", "=", $id)->get()->toArray();
        $project_data["plans"] = $project_plans[0];
        foreach($project_plans as $key => $plans){
            $project_tasks = Tasks::where("plan_id", "=", $plans["id"])->get()->toArray();
            $project_data["plans"]["tasks"][$key] = $project_tasks[0];
        }
        echo json_encode($project_data);
    }

    public function ShowProject(Request $request){
        $project_data = [];
        $project_details = Projects::where("id", "=", $request->id)->get()->toArray();
        $project_data = $project_details[0];
        $project_plans = Plans::where("project_id", "=", $request->id)->get()->toArray();
        $project_data["plans"] = $project_plans[0];
        foreach($project_plans as $key => $plans){
            $project_tasks = Tasks::where("plan_id", "=", $plans["id"])->get()->toArray();
            $project_data["plans"]["tasks"][$key] = $project_tasks[0];
        }
        dd($project_data);
    }

    public function UpdateProject(Request $request){
        Project::where("id", "=", $request->project_id)
                ->update([
                    "project_name" => $request->data["project_name"],
                    "project_address" => $request->data["project_address"],
                    "client_id" => $request->data["client_id"]
                    ]);
        Plans::join("tasks", "tasks.plan_id", "=", "plans.plan_id")
            ->where("plans.project_id", "=", $request->project_id)->delete();
        foreach($request->data['plans'] as $data){
            $plans = new Plans();
            $plans->project_id = $project_id;
            $plans->plan_name = $data[0];
            $plans->plan_date_start = $data[1];
            $plans->plan_date_end = $data[2];
            $plans->plan_priority = $data[3];
            $plans->plan_dependency = $data[4];
            $plans->save();
        }
    }

    public function AddProject(Request $request){
        $project = new Projects();
        $project->project_name = $request->data["project_name"];
        $project->project_address = $request->data["project_address"];
        $project->client_id = $request->data["client_id"];
        $project->save();
        $project_id = $project->id;
        foreach($request->data['plans'] as $plans_data){
            $plans = new Plans();
            $plans->project_id = $project_id;
            $plans->plan_name = $plans_data["plan_name"];
            $plans->plan_date_start = $plans_data["plan_start"];
            $plans->plan_date_end = $plans_data["plan_end"];
            $plans->plan_priority = $plans_data["plan_priority"];
            $plans->plan_dependency = $plans_data["plan_dependency"];
            $plans->save();
            $plan_id = $plans->id;
            if(isset($plans_data["tasks"])){
                foreach($plans_data["tasks"] as $tasks_data){
                    $task = new Tasks();
                    $task->plan_id = $plan_id;
                    $task->task_name = $tasks_data["task_name"];
                    $task->task_priority = $tasks_data["task_priority"];
                    $task->task_date_start = $tasks_data["task_start"];
                    $task->task_date_end = $tasks_data["task_end"];
                    $task->user_id = $tasks_data["assigned_to"];
                    $task->task_status = "pending";
                    $task->save();
                }
            }
        }
        return $project->id;
    }

}
