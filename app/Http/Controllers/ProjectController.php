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

    public function ShowProject(Request $request){
        $project_data = [];
        $project_details = Projects::where("id", "=", $request->id)->get()->toArray();
        dd($project_details);
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
        foreach($request->data['plans'] as $plans){
            $plans = new Plans();
            $plans->project_id = $project_id;
            $plans->plan_name = $plans[0];
            $plans->plan_date_start = $plans[1];
            $plans->plan_date_end = $plans[2];
            $plans->plan_priority = $plans[3];
            $plans->plan_dependency = $plans[4];
            $plans->save();
            $plan_id = $plans->id;
            foreach($request->data["tasks"] as $tasks){
                $tasks = new Tasks();
                $tasks->plan_id = $plan_id;
                $tasks->task_name = $tasks[0];
                $tasks->task_priority = $tasks[1];
                $tasks->task_date_start = $tasks[2];
                $tasks->task_date_end = $tasks[3];
                $tasks->user_id = $tasks[4];
                $tasks->save();
            }
        }
        return redirect('projectmanager/project' + $project_id)->with("success", "Project Saved!");
    }

}
