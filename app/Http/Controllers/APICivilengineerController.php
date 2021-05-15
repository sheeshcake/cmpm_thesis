<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskReport;
use App\Models\Tasks;
use App\Models\Plans;
use App\Models\Projects;
use App\Models\User;


class APICivilengineerController extends Controller
{

    public function showprojects(){
        $projects = Projects::where("project_status", "=", "approved")->get()->toArray();
        return json_encode($projects);
    }

    public function showproject($id){
        $project = Projects::where("id", "=", $id)->get()->toArray();
        $plans = Plans::where("project_id", "=", $id)->get()->toArray();
        foreach($plans as $index => $plan){
            $tasks = Tasks::where("plan_id", "=", $id)->get()->toArray();
            $plans[$index]["tasks"] = $tasks;
        }
        $project[0]["plans"] = $plans;
        return json_encode($project);
    }

    public function get_tasks($id){
        $plan_details = Plans::where("id", "=", $id)->get()->toArray();
        $task_details = Tasks::where("plan_id", "=", $id)->get()->toArray();
        foreach($task_details as $index => $task){
            $report = TaskReport::where("task_id", "=", $task["id"])->get()->toArray();
            if($report){
                $task_details[$index]["reports"] = $report[0];
            }
        }
        return json_encode([
            "task_details" => $task_details,
            "plan_details" => $plan_details[0]
        ]);
    }

    public function get_report($id){
        $report = TaskReport::where("task_id", "=", $id)->get()->toArray();
        $user = User::where("id", "=", $report[0]["user_id"])->get()->toArray();
        return json_encode([
            "report" => $report,
            "user" => $user
        ]);
    }

    public function approve_report(Request $request){
        $report_id = TaskReport::where("id", "=", $request->id)->update([
            "is_ce_approved" => "true"
        ]);
        return json_encode([
            "msg" => "Task Approved!"
        ]);
    }
}
