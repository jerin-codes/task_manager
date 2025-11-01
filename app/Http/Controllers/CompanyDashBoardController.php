<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompanyDashBoardController extends Controller
{
    public function index(){
      
        return view("companies.dashboard");
    }
}
