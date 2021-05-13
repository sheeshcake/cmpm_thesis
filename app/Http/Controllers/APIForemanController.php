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
        $task_details = "All Good! :)";
        if($request->task_details != null){
            $task_details = $request->task_details;
        }
        $task_id = TaskReport::create([
            "task_id" => $request->task_id,
            "task_details" => $task_details,
            "user_id" => $request->user_id,
            "task_picture" => "task_" . $request->task_id . ".jpg"
        ])->id;
        $data1 = explode(',', $request->base64image);
        $bin = base64_decode($data1[1]);
        $im = imageCreateFromString($bin);
        imagejpeg($im, "task_" . $request->task_id . ".jpg");
        imagedestroy($im);
        $report = TaskReport::where("id", "=", $task_id)->get()->toArray();
        return json_encode($report[0]);
    }


    public function showtask($id){
        $task = Tasks::where("id", "=", $id)->get()->toArray();
        $report = TaskReport::where("task_id", "=", $id)->get()->toArray();
        if($task){
            if(isset($report[0])){
                return json_encode([
                    "task" => $task[0],
                    "reports" => $report[0]
                ]);
            }else{
                return json_encode([
                    "task" => $task[0]]
                );
            }

        }else{
            return json_encode([
                "msg" => "No Data",
                "id" => $id
            ]);
        }
    }

    public function showtasks($id){
        $tasks = Tasks::where("plan_id", "=", $id)->get()->toArray();
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
