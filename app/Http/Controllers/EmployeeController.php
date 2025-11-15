<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(){
       if(session("company_id")){
        $comapany_id=session("company_id");
       }else{
        $comapany_id=null;
       }

       $users=DB::table("users")->where("company_id","=",$comapany_id)->get();

       return view("companies.employee-list",["users"=>$users]);
    }


    public function register_employee(Request $request){
        // dd($request);
        $request->validate([
            "email"=>["required","unique:users"]
        ]);
        User::create([
            "name"=>$request->first_name,
            "designation"=>$request->designation,
            "email"=>$request->email,
            "password"=>$request->password,
            "company_id"=>session("company_id"),
        ]);

        return redirect()->route("company.employees");
    }


    //removing the employee
    public function update(Request $request){
        $user=User::find($request->id);
       
        if(!empty($request->edit_password)){
            // dd("yes executing");
            $user->password=$request->edit_password;

        }
        
        
        $user->name=$request->edit_first_name;
        $user->email=$request->edit_email;
        $user->designation=$request->edit_designation;
        
        
        $user->save();
        return redirect()->back();
    
    }

    public function remove_employee(Request $request){
        
        $result=User::where("id","=",$request->employee_id)->delete();
        return redirect()->back();
    }
}
