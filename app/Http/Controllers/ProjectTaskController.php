<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;
use function Symfony\Component\Clock\now;

class ProjectTaskController extends Controller
{
    public function get_project_view($id){
        $result=[];
        $project=DB::table("company_projects")->where("id","=",$id)->get();
        $result["project_details"]=$project;


        $tasks=DB::table("project_tasks")->where("project_id","=",$id)->get()->toArray();
        $result["tasks"]=$tasks;
      

        return view("employee.project-overview",["data"=>$result]);
    }

    public function create_new_task(Request $request){
        
        $fields=[
        "name"=>$request->name,
        "description"=>$request->description,
        "project_id"=>$request->project_id,
        "assigned_employee_id"=>$request->assigned_employee,
        "created_at"=>now(),
        "updated_at"=>now()
        ];

        $last = DB::table("project_tasks")->max('task_number');
        $fields["task_number"]=$last ? $last+1 : 1;
        // dd($fields);
        $result=DB::table("project_tasks")->insert($fields);
        return redirect()->back();
    }
}
