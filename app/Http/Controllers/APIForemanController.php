<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Projects;
use App\Models\Plans;
use App\Models\Tasks;

class APIForemanController extends Controller
{
    public function index(){
        return "Index!";
    }

    public function showprojects(){
        $projects = Projects::all()->toArray();
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
}
