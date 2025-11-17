<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;


    function get_employee_data($id){
        $employee=DB::table("users")->where("id","=",$id)->first();
        // dd($employee);
        return $employee;
    }

    function get_project_head_data($employee_id=null){
    
        $employee=User::where("id","=",$employee_id)->first();
    
        if(empty($employee)){
            return "Employee removed from company";
        }
       return $employee["name"];
    }

    function get_employee_projects($id){
        $project_ids=DB::table("project_workers")->where("employee_id","=",$id)->pluck("project_id")->toArray();
        
        $projects=DB::table("company_projects")->whereIn("id",$project_ids)->get();
        return $projects;
    }  

    function get_company_employees($emp_id){
        $user=DB::table("users")->where("id","=",$emp_id)->first();
        
        $company_id=$user->company_id;
        $company_employees=DB::table("users")->where("company_id","=",$company_id)->get()->toArray();
        // dd($company_employees);
        return $company_employees;
    }    
    

?>