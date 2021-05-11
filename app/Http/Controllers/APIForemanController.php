<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Projects;
use App\Models\Plans;
use App\Models\Tasks;
use App\Models\TaskReport;

class APIForemanController extends Controller
{
    public function index(){
        return "Index!";
    }

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

    public function updateproject(Request $request){
        $file = $request->file("task_image");
        if($file){
            move_uploaded_file("/img/project_img", $file->getClientOriginalName());
            $request->image_name = $file->getClientOriginalName();
            $data = Tasks::where("id", "=", $request->id)
                ->update($request->except(["id", "task_image"]));
            return json_encode([
                "msg" => "Task Updated!",
                "id" => $request->id
            ]);
        }else{
            return json_encode([
                "msg" => "Some of Data is Missing",
                "id" => $request->id
            ]);
        }
    }


    public function reporttask(Request $request){
        $file = $request->file("task_image");
        if($file){
            $files->move('img/tasks/', $files->getClientOriginalName()); 
            $data = TaskReport::insert([
                "task_id" => $request->task_id,
                "user_id" => $request->user_id,
                "task_details" => $request->task_details,
                "task_picture" => $file->getClientOriginalName()
            ]);
        }
    }


    public function showtask($id){
        $task = Tasks::where("id", "=", $id)->get()->toArray();
        $task[0]["task_reports"] = TaskReport::where("task_id", "=", $id)->get()->toArray();
        if($task){
            return json_encode($task[0]);
        }else{
            return json_encode([
                "msg" => "No Data",
                "id" => $id
            ]);
        }
    }

    public function showtasks($id){
        $tasks = Tasks::join("task_report", "task_report.task_id", "=", "tasks.id")
                    ->where("tasks.plan_id", "=", $id)->get()->toArray();
        if($tasks){
            return json_encode($tasks);
        }else{
            return json_encode([
                "msg" => "No Data",
                "id" => $id
            ]);
        }
    }
}
