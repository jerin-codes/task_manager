<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
 


class AuthController extends Controller
{
    public function company_login(Request $request){
        
        $fields=$request->validate([
            "company_id"=>["required"],
            "password"=>["required"]
        ]);

        $company=DB::table("companies")->where("company_id","=",$request->company_id)->get();
        // dd($company);
        if(empty($company[0])){
            return back()->withErrors(["failed"=>"No records for the given company id"]);
        }else{
           
            if($request->password==$company[0]->password){
                   
                    session(['company_id' => $company[0]->company_id,"company_name"=>$company[0]->company_name]);
                   
                    // dd($value);
                    return redirect()->route("company.dashboard");
            }else{
                return back()->withErrors([
                    "failed"=>"Password is wrong",
                ]);
            }

        }
    }

    public function company_register(Request $request){
      
       $fields= $request->validate([
            "company_name"=>["required"],
            "company_id"=>["required","unique:companies"],
            "password"=>["required","min:3","confirmed"]
        ]);

        $company=Company::create($fields);
        session(['company_id' => $company->company_id,"company_name"=>$company->company_name]);


        return redirect()->route("company.dashboard");  
        
    }

    public function company_logout(Request $request){

        $request->session()->invalidate();
        return redirect("/");

    }


//Employee Authentication other functionalities

    function employee_login(Request $request){
                
       $fields= $request->validate([
            "email"=>["required","email"],
            "password"=>["required"]
        ]);

        if(Auth::attempt($fields,$request->remember)){
                return redirect()->route("employee.dashboard");
        }else{
            return back()->withErrors([
                "login_failed"=>"Login failed invalid credinitials"
            ]);
        }
        


    }











}

