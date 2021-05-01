<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Plans;
use App\Models\Tasks;
use App\Models\User;
use App\Models\Clients;
use App\Models\Supplies;

use Auth;

class ProjectController extends Controller
{
    public function ShowAllProjects(){
        $projects = Projects::join("plans", "plans.project_id", "=", "projects.id")
                    ->groupBy("projects.id")
                    ->get();
        return view("layout." . Auth::user()->role . ".projects")->with("data", [
            "projects" => $projects,
            "role" => Auth::user()->role,
            "page" => "All Project"
        ]);
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

    public function UpdateTask(Request $request){
        Tasks::where("plan_id", "=", $request->plan_id)
                ->delete();
        foreach($request->tasks as $task){
            $newtask = new Tasks();
            $newtask->plan_id = $request->plan_id;
            $newtask->task_name = $task["task_name"];
            $newtask->task_priority = $task["task_priority"];
            $newtask->user_id = $task["assigned_to"];
            $newtask->task_date_start = $task["task_start"];
            $newtask->task_date_end = $task["task_end"];
            $newtask->task_status = "pending";
            $newtask->save();
        }
    }

    public function GetProjectData(Request $request){
        $project_data = [];
        $project_details = Projects::where("id", "=", $request->project_id)->get()->toArray();
        $project_data = $project_details[0];
        $project_plans = Plans::where("project_id", "=", $request->project_id)->get()->toArray();
        $project_data["plans"] = $project_plans;
        $project_supplies = Supplies::where("project_id", "=", $request->project_id)->get()->toArray();
        $project_data["supplies"] = $project_supplies;
        foreach($project_plans as $key => $plans){
            $project_tasks = Tasks::where("plan_id", "=", $plans["id"])->get()->toArray();
            // dd($project_tasks[0]);
            $project_data["plans"][$key]["tasks"] = $project_tasks;
        }
        echo json_encode($project_data);
    }

    public function ShowProject(Request $request){
        $users = User::where("role" , "=", "foreman")
                    ->orWhere("role", "=", "civilengineer")
                    ->get();
        $clients = Clients::all();
        $project = Projects::where("id", "=", $request->id)->get()->toArray();
        return view("layout." . Auth::user()->role . ".project")->with("data", [
            "project" => $project,
            "role" => Auth::user()->role,
            "users" => $users,
            "page" => $project[0]["project_name"],
            "clients" => $clients
        ]);
    }

    // public function UpdateProject(Request $request){
    //     //updating the project problem
    //     Project::where("id", "=", $request->project_id)
    //             ->update([
    //                 "project_name" => $request->data["project_name"],
    //                 "project_address" => $request->data["project_address"],
    //                 "client_id" => $request->data["client_id"]
    //                 ]);
    //     // Plans::join("tasks", "tasks.plan_id", "=", "plans.plan_id")
    //     //     ->where("plans.project_id", "=", $request->project_id)->delete();
    //     foreach($request->data['plans'] as $data){
    //         $plans = Plans::where("id", "=", $data->project_id)->get();
    //         if(!empty($plans)){
    //             Plans::where("id", "=", $plans->id)
    //                 ->update([
    //                     "project_id" => $request->project_id,
    //                     "plan_name" => ""
    //                 ]);
    //         }else{
    //             $plans = new Plans();
    //             $plans->project_id = $project_id;
    //             $plans->plan_name = $data[0];
    //             $plans->plan_date_start = $data[1];
    //             $plans->plan_date_end = $data[2];
    //             $plans->plan_priority = $data[3];
    //             $plans->plan_dependency = $data[4];
    //             $plans->save();
    //         }

    //     }
    //     Supplies::where("project_id", "=", $request->project_id)->delete();
    //     foreach($request->data['supplies'] as $supply_data){
    //         $supplies = new Supplies();
    //         $supplies->project_id = $project_id;
    //         $supplies->supply_name = $supply_data["supply_name"];
    //         $supplies->supply_description = $supply_data["supply_description"];
    //         $supplies->supply_count = $supply_data["supply_count"];
    //         $supplies->save();
    //     }
    // }

    public function AddProject(Request $request){
        $project = new Projects();
        $project->project_name = $request->data["project_name"];
        $project->project_address = $request->data["project_address"];
        $project->client_id = $request->data["client_id"];
        $project->save();
        $project_id = $project->id;
        foreach($request->data['plans'] as $plans_data){
            $dependency = $plans_data["plan_dependency"];
            if($dependency == null){
                $dependency = "null";
            }
            $plans = new Plans();
            $plans->project_id = $project_id;
            $plans->plan_name = $plans_data["plan_name"];
            $plans->plan_date_start = $plans_data["plan_start"];
            $plans->plan_date_end = $plans_data["plan_end"];
            $plans->plan_priority = $plans_data["plan_priority"];
            $plans->plan_dependency = $dependency;
            $plans->save();
            $plan_id = $plans->id;
            // if(isset($plans_data["tasks"])){
            //     if(count($plans_data["tasks"]) > 0){
            //         foreach($plans_data["tasks"] as $tasks_data){
            //             $task = new Tasks();
            //             $task->plan_id = $plan_id;
            //             $task->task_name = $tasks_data["task_name"];
            //             $task->task_priority = $tasks_data["task_priority"];
            //             $task->task_date_start = $tasks_data["task_start"];
            //             $task->task_date_end = $tasks_data["task_end"];
            //             $task->user_id = $tasks_data["assigned_to"];
            //             $task->task_status = "pending";
            //             $task->save();
            //         }
            //     }
            // }
        }
        foreach($request->data['supplies'] as $supply_data){
            $supplies = new Supplies();
            $supplies->project_id = $project_id;
            $supplies->supply_name = $supply_data["supply_name"];
            $supplies->supply_description = $supply_data["supply_description"];
            $supplies->supply_count = $supply_data["supply_count"];
            $supplies->save();
        }
        return $project->id;
    }

}
