<?php

namespace App\Http\Controllers;

use App\Models\Tasks;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function AddTask(Request $request){
        $data = Tasks::create($request->except(["_token"]))->id;
        if($data){
            echo json_encode([
                "alert" => "Task Added!",
                "id" => $data
            ]);
        }else{
            echo "Error on Adding task";
        }

    }

    public function RemoveTask(Request $request){

        $data = Tasks::where("id", "=", $request->id)
                    ->delete();
        if($data){
            echo json_encode([
                "alert" => "Task Deleted!"
            ]);
        }else{
            echo "Error on Deleting task";
        }

    }

    public function UpdateTask(Request $request){

        $data = Tasks::where("id", "=", $request->id)
                ->update([
                    "task_name" => $request->task_name,
                    "task_status" => $request->task_status,
                    "task_priority" => $request->task_priority,
                    "user_id" => $request->user_id,
                    "task_date_start" => $request->task_date_start,
                    "task_date_end" => $request->task_date_end,
                ]);
        if($data){
            echo "Task Updated!";
        }else{
            echo "Error on Updating task";
        }
        
    }

    public function GetTasks(Request $request){
        $data = Tasks::join("users", "users.id", "=", "tasks.user_id")
                    ->where("tasks.plan_id", "=", $request->plan_id)
                    ->get(["users.*", "tasks.id as task_id", "tasks.*"])
                    ->toArray();
        echo json_encode($data);
    }

}
