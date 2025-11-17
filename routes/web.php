<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyDashBoardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectTaskController;
use Illuminate\Support\Facades\Route;


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
Route::post("/update-employee",[EmployeeController::class,"update"])->name("comapny.employee.update");

Route::post("/add-employee",[EmployeeController::class,"register_employee"])->name("comapny.employee.register");
Route::delete("/remove-employee",[EmployeeController::class,"remove_employee"])->name("company.remove.employee");
Route::get("/company-projects",[ProjectsController::class,"index"])->name("company.projects");
Route::post("/create-company-project",[ProjectsController::class,"create_project"])->name("company.create.project");
Route::delete("/delete-company-project/{project_id}",[ProjectsController::class,"delete_project"])->name("company.delete.project");
Route::get("/update-project/{id}",[ProjectsController::class,"update_project"])->name("company.update.project");
Route::post("/update-project-details",[ProjectsController::class,"update_project_data"])->name("company.update.project.details");
Route::post("/add-project-worker",[ProjectsController::class,"add_new_worker"])->name("company.project.add.worker");
Route::delete("/remove-emp",[ProjectsController::class,"remove_employee"])->name("remove_from_project");
Route::post("/company-logout",[AuthController::class,"company_logout"])->name("company.logout");


//Employee login and employee related routes

Route::middleware("auth")->group(function(){
    
   
    Route::get("/employee-dahboard",function(){
        return view("employee.dashboard");
    })->name("employee.dashboard");
    Route::post("/employee-logout",[AuthController::class,"employee_logout"])->name("employee.logout");
    Route::get("/project-view/{id}",[ProjectTaskController::class,"get_project_view"])->name("project.view");
    Route::post("/project-create-task",[ProjectTaskController::class, "create_new_task"])->name("project.create.task");
});



Route::middleware("guest")->group(function(){
     Route::post("/employee-login",[AuthController::class,"employee_login"])->name("employee.login");
    Route::get("/employee-login",function(){
        return view("auth.employee-login");
    });
});