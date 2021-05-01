<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplies;
use App\Models\Projects;
use Auth;

class SupplyController extends Controller
{
    public function ShowProject(Request $request){
        $project = Projects::where("id", "=", $request->id)->get()->toArray();
        $supplies = Supplies::where("project_id", "=", $request->id)->get()->toArray();
        return view("layout." . Auth::user()->role . ".project")->with("data", [
            "project" => $project,
            "supplies" => $supplies,
            "role" => Auth::user()->role,
            "page" => $project[0]["project_name"],
        ]);
    }


    public function AddSupply(Request $request){
        $data = Supplies::create($request->except(["_token"]))->id;
        if($data){
            echo json_encode([
                "alert" => "Supply Added!",
                "id" => $data
            ]);
        }else{
            echo "Error on Adding supply";
        }

    }

    public function RemoveSupply(Request $request){

        $data = Supplies::where("id", "=", $request->id)
                    ->delete();
        if($data){
            echo json_encode([
                "alert" => "Supply Deleted!"
            ]);
        }else{
            echo "Error on Deleting supply";
        }

    }

    public function UpdateSupply(Request $request){

        $data = Supplies::where("id", "=", $request->id)
                ->update([
                    "supply_name" => $request->supply_name,
                    "supply_description" => $request->supply_description,
                    "supply_count" => $request->supply_count,
                    "supply_price" => $request->supply_price
                ]);
        if($data){
            echo "Supply Updated!";
        }else{
            echo "Error on Updating supply";
        }
        
    }
}
