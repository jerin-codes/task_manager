<?php

use App\Models\User;

    function get_project_head_data($employee_id=null){
    
        $employee=User::where("id","=",$employee_id)->first();
    
        if(empty($employee)){
            return "Employee removed from company";
        }
       return $employee["name"];
    }


?>