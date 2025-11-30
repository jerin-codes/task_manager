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
      

        return view("employee.project-overview",["data"=>$result,"filter"=>false]);
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

    public function update_project_status(Request $request){
        // dd($request);
      DB::table('project_tasks')->where('id', $request->task_id)->update(['status' => $request->task_status]);
      return redirect()->back();

    }

    public function apply_filter(Request $request){
        // dd($request);
        $filter=true; 
        $result=[];
        $project=DB::table("company_projects")->where("id","=",$request->project_id)->get();
        $result["project_details"]=$project;

        if($request->filter_date_from !=null && $request->filter_date_to!=null){
             $tasks = DB::table("project_tasks")
                    ->where("project_id", $request->project_id)
                    ->whereBetween("created_at", [
                        $request->filter_date_from,
                        $request->filter_date_to
                        ])
                    ->get()->toArray();
                    
        }else{

            $tasks=DB::table("project_tasks")->where("project_id","=",$request->project_id)->get()->toArray();
        }

        // dd($tasks);
        if($request->assigned_employee!=null){

            foreach($tasks as $index=>$task){
                if($task->assigned_employee_id !=$request->assigned_employee){
                    unset($tasks[$index]);
                }
            }
        }
        
        if($request->filter_status !=null){
            foreach($tasks as $index=>$task){
                if($task->status != $request->filter_status){
                    unset($tasks[$index]);
                }
            }
        }
        $result["tasks"]=$tasks;
        

        return view("employee.project-overview",["data"=>$result,"filter"=>$filter]);
    }
}
