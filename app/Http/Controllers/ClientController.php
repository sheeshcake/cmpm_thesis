<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

use Auth;
use Hash;
class ClientController extends Controller
{
    public function AddClient(Request $request){
        $client = new Clients();
        $client->client_f_name = $request->f_name;
        $client->client_l_name = $request->l_name;
        $client->client_address = $request->address;
        $client->client_email = $request->email;
        $client->client_contact_number = $request->contact_number;
        $client->client_username = $request->contact_number;
        $client->client_password = Hash::make($request->contact_number);
        $client->save();
        return redirect("clients/showclient/$client->id");
    }

    public function ShowNewClient(){
        return view("layout." . Auth::user()->role . ".add-client")
            ->with("data", [
                "role" => ucfirst(Auth::user()->role),
                "page" => "Add Client"
                ]);
    }
    public function ShowClient($id){
        $client = Clients::where("id", "=", $id)->get();
        return view("layout." . Auth::user()->role . ".client")
            ->with("data", [
                "role" => ucfirst(Auth::user()->role),
                "page" => "Client",
                "client" => $client
                ]);

    }

    public function ShowAllClients(){
        $client = Clients::all();
        return view("layout." . Auth::user()->role . ".clients")
            ->with("data", [
                "role" => ucfirst(Auth::user()->role),
                "page" => "All Clients",
                "client" => $client
                ]);
    }

    public function UpdateClient(){

    } 

}
