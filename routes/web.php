<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\CompanyDashBoardController;

Route::get('/', function () {
    return view('index');
});



//company login/registration routes
Route::get("/company-login",function(){
    return view("auth.company-login-page");
});
Route::post("/company-login",[AuthController::class,"company_login"])->name("company.login");
Route::get("/company-register",function(){
    return view("auth.company-register");
})->name("company.register");

Route::post("/company-register",[AuthController::class,"company_register"])->name("company.register");

//company dashboard and other functionalities related routes.
Route::get("/company-dashboard",[CompanyDashBoardController::class,"index"])->name("company.dashboard");
Route::get("/company-employees",[EmployeeController::class,"index"])->name("company.employees");
Route::post("/add-employee",[EmployeeController::class,"register_employee"])->name("comapny.employee.register");
Route::get("/company-projects",[ProjectsController::class,"index"])->name("company.projects");
Route::post("/create-company-project",[ProjectsController::class,"create_project"])->name("company.create.project");
Route::delete("/delete-company-project/{project_id}",[ProjectsController::class,"delete_project"])->name("company.delete.project");

