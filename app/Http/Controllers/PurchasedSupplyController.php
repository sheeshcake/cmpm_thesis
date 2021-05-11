<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SupplyPurchased;

class PurchasedSupplyController extends Controller
{
    public function GetData(Request $request){
        $p_supply = SupplyPurchased::where("supply_id", "=", $request->id)
                    ->get()->toArray();
        return json_encode($p_supply);
    }

    public function AddSupply(Request $request){
        $data = SupplyPurchased::create($request->except(["_token"]))->id;
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

        $data = SupplyPurchased::where("id", "=", $request->id)
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
                    "supply_price" => $request->supply_price
                ]);
        $table = SupplyPurchased::create([
            "supply_id" => $request->id,
            "store_purchased" => $request->store_purchased,
            "supply_count_purchased" => $request->supply_count_purchased,
            "supply_price" => $request->supply_price
        ]);
        if($data){
            echo "Supply Updated!";
        }else{
            echo "Error on Updating supply";
        }
        
    }
}
