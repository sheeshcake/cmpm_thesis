<?php

namespace App\Http\Controllers;

use App\Models\Tasks;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function AddTask(Request $request){
        $data = Tasks::create($request->except(["_token"]));
        if($data){
            echo "Task Added!";
        }else{
            echo "Error on Adding task";
        }

    }

    public function RemoveTask(Request $request){

        $data = Tasks::where("id", "=", $request->id)
                    ->delete();
        if($data){
            echo "Task Deleted!";
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
                    "task_date_end" => $request->task_date_end
                ]);
        if($data){
            echo "Task Updated!";
        }else{
            echo "Error on Updating task";
        }
        
    }
}
