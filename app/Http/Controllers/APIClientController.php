<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

class APIClientController extends Controller
{
    public function showprojects($id){
        $projects = Projects::where("client_id", "=", $id)->get()->toArray();
        return json_encode($projects);
    }

    public function showproject($id){
        $project = Projects::where("id", "=", $id)->get()->toArray();
        return json_encode($project);
    }

}
