<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProjectWorkers;
use App\Models\CompanyProjects;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    public function index(){
        if(session("company_id")){
            $company_id=session("company_id");
        }else{
            $company_id=null;
        }

    $projects=DB::table("company_projects")->where("company_id","=",$company_id)->get();
    $employees=DB::table("users")->where("company_id","=",$company_id)->get();
    
    return view("companies.projects-list",["projects"=>$projects,"employees"=>$employees]);

    }

    public function create_project(Request $request){
    //   dd($request);
      if($request->project_head_id=="Select"){
        return back()->withErrors([
            "project_head_error"=>" Project creation failed,please select a valid project head while creating projects"
        ]);
      }
      
        $fields=$request->validate([
            "project_name"=>["required","unique:company_projects"],
            "description"=>["required"],
            "project_head_id"=>["required"]
        ]);

        $fields["company_id"]=session("company_id");

       $result=CompanyProjects::create($fields);
       ProjectWorkers::create([
        "project_id"=>$result->id,
        "employee_id"=>$request->project_head_id
       ]);
       


       return redirect()->route("company.projects");
    }


    public function update_project($id){
        $not_in_project_employees=[];
          $project=CompanyProjects::where("id","=",$id)->first();
        //   dd($project);
          $working_employees = DB::table("project_workers")->where("project_id", $id)->pluck("employee_id"); // Only get the employee IDs as a collection

         $project_workers = User::whereIn("id", $working_employees)->get();
         $company_employees=DB::table("users")->where("company_id","=",session("company_id"))->get();
         foreach($company_employees as $employee){
            $flag=true;
            foreach($project_workers as $worker){
                if($employee->id==$worker->id){
                    $flag=false;    
                    break;
                }     
            }
        
            if($flag){
                $not_in_project_employees[]=$employee;
            }
           
         }
       
         

       return view("companies.update-project",["not_in_project_employees"=>$not_in_project_employees,"project_employees"=>$project_workers,"project"=>$project]);
    }


   public function update_project_data(Request $request){
            
      $project=CompanyProjects::find($request->id);
      $update_data=[
        "project_name"=>$request->project_name,
        "description"=>$request->description,
        "project_head_id"=>$request->project_head_id
      ];
      if($project){
        $project->update($update_data);
      }
       
      return redirect()->back()->with(["project_update_success"=>"Project updated successfully"]);

   }

    public function delete_project(Request $request,$project_id){
        // dd($project_id);

        $result=DB::table("company_projects")->where("id","=",$project_id)->delete();
        
        return redirect()->route("company.projects");
    }

    public function add_new_worker(Request $request){

        $project_workers_update_data=[
            "project_id"=>$request->project_id,
            "employee_id"=>$request->employee_id
        ];

        $result=ProjectWorkers::create($project_workers_update_data);
        return redirect()->back();
    }

    public function remove_employee(Request $request){
        
        if($request->project_head_id==$request->employee_id){
           
            $project=CompanyProjects::find($request->project_id);
            $project->project_head_id=null;
            $project->save();
        }
        $result=DB::table("project_workers")->where("employee_id","=",$request->employee_id)->delete();
        return redirect()->back();
    }


      

}
