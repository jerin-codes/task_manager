<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
      
        $fields=$request->validate([
            "project_name"=>["required","unique:company_projects"],
            "description"=>["required"],
            "project_head"=>["required"]
        ]);

        $fields["company_id"]=session("company_id");

       $result=CompanyProjects::create($fields);
       


       return redirect()->route("company.projects");
    }


    public function delete_project(Request $request,$project_id){
        // dd($project_id);

        $result=DB::table("company_projects")->where("id","=",$project_id)->delete();
        
        return redirect()->route("company.projects");
    }
}
