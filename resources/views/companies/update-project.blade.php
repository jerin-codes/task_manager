<x-layouts.company-layout>
@php
    $project_head_name = "";
    foreach ($project_employees as $index => $employee) {
        if ($project->project_head_id == $employee->id) {
            $project_head_name = $employee->name;
            break;
        }
    }
  
@endphp

<div class="project-container">
    <div class="project-details">
        @if(session("project_update_success"))
       
        <x-danger-message :msg="session('project_update_success')" color="#00ff00" />

        @endif
        <h3>Update Project Details</h3>
        <form action="{{ route('company.update.project.details') }}" method="post" class="project-form">
            @csrf
            <input type="hidden" name="id" value="{{$project->id}}">
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input name="project_name" value="{{ $project->project_name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input name="description" value="{{ $project->description }}" required>
            </div>

            <div class="form-group">
                <label for="project_head_id">Project Head</label>
                <select name="project_head_id">
                    <option value="{{ $project->project_head_id }}">{{ $project_head_name }}</option>
                    @foreach($project_employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-submit">Update</button>
        </form>
    </div>

    <div class="employee-details">
        <div style="display: flex; justify-content:space-between">
        <h3>Project Team</h3>
        <button class="btn-submit" id="add-new-worker"  style="background-color:#218838">Add New Worker</button>
        <div id="company_employees_dropdown" style="display: none">
           
        <form action="{{route("company.project.add.worker")}}" method="post">
            @csrf
            @method("POST")
        <input type="hidden" name="project_id" value="{{$project->id}}">
        <select name="employee_id" required>            
            <option>Choose your employee</option>
            @foreach($not_in_project_employees as $index=>$employee)
            <option value="{{$employee->id}}">{{$employee->name}}</option>
            @endforeach
        </select>
         <button type="submit" class="btn-submit" id="company_employees_dropdown"  style="background-color:#218838">Add</button>
                <button type="button" class="btn-submit" id="company_employees_dropdown-cancel"  style="background-color:#218838">Cancel</button>
        
            </form>
        </div>
        </div>
        <table class="employee-table">
            <thead>
                <tr>
                    <th>SI. No</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project_employees as $index => $employee)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><a href="#" class="employee-link">{{ $employee->name }}</a></td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->designation }}</td>
                        <td>
                          
                            <form action="{{route("remove_from_project")}}" method="post">
                                @csrf
                                @method("DELETE")
                                <input name="employee_id" type="hidden" value="{{$employee->id}}">
                                <input name="project_head_id" value="{{$project->project_head_id}}" type="hidden">
                                <input name="project_id" value="{{$project->id}}" type="hidden">  
                            <button type="submit" class="btn-delete">Remove from project</button>
                            </form>
                        </td>
                    </tr></butt
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-layouts.company-layout>

<style>
/* Overall Container */
.project-container {
    max-width: 1000px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

/* Section Headings */
.project-details h3,
.employee-details h3 {
    margin-bottom: 20px;
    color: #333;
    border-bottom: 2px solid #007BFF;
    padding-bottom: 5px;
}

/* Form Styling */
.project-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
}

.form-group input,
.form-group select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    font-size: 14px;
    transition: 0.3s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #007BFF;
    box-shadow: 0 0 4px rgba(0,123,255,0.3);
}

/* Submit Button */
.btn-submit {
    align-self: flex-start;
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-submit:hover {
    background-color: #0056b3;
}

/* Table Styling */
.employee-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 15px;
}

.employee-table th,
.employee-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.employee-table thead {
    background-color: #ffffff;
    color: #000000;
}

.employee-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.employee-table tr:hover {
    background-color: #f1f9ff;
}

/* Employee Name Link */
.employee-link {
    color: #000000;
    text-decoration: none;
    font-weight: 500;
}

.employee-link:hover {
    text-decoration: underline;
}

/* Action Buttons */
.btn-view,
.btn-edit,
.btn-delete {
    border: none;
    border-radius: 5px;
    padding: 6px 12px;
    margin-right: 5px;
    color: white;
    cursor: pointer;
    font-size: 13px;
    transition: 0.3s;
}

.btn-view { background-color: #28a745; }
.btn-edit { background-color: #ffc107; color: #333; }
.btn-delete { background-color: #dc3545; }

.btn-view:hover { background-color: #218838; }
.btn-edit:hover { background-color: #e0a800; }
.btn-delete:hover { background-color: #c82333; }

/* Responsive Design */
@media (max-width: 768px) {
    .employee-table, .employee-table thead, .employee-table tbody, .employee-table th, .employee-table td, .employee-table tr {
        display: block;
    }

    .employee-table tr {
        margin-bottom: 15px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        padding: 10px;
    }

    .employee-table td {
        border: none;
        padding: 8px 0;
        display: flex;
        justify-content: space-between;
    }

    .employee-table td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #555;
    }

    .employee-table thead { display: none; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('add-new-worker');
    const dropDown=document.getElementById('company_employees_dropdown')
    const addEmployeeCancelButton=document.getElementById("company_employees_dropdown-cancel");

    button.addEventListener('click', function () {
       button.style.display="none";
       dropDown.style.display="block";
       addEmployeeCancelButton.style.display="";
       
       
    });

    addEmployeeCancelButton.addEventListener("click",function(){
        dropDown.style.display="none";
        addEmployeeCancelButton.style.display="none";
        button.style.display="block";
    })

});

</script>