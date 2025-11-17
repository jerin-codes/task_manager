<x-layouts.employee_layouts.employee-layout>
@php
$committed_projects=get_employee_projects(auth()->user()->id);

foreach($committed_projects as $index=>$project){
    
    $project_head=get_project_head_data($project->project_head_id);
    $committed_projects[$index]->project_head_name=$project_head;
}   
@endphp

<div style="display:flex;gap:278px;justify-content:center">
    <div class="committed-projects">
        <h3>Committed projects</h3>
        <div style="padding:30px 0px">
        @foreach ($committed_projects as $project)
        
        <div class="project-card">
            
            <h3>Project: {{ $project->project_name }}</h3>
            <span>Created at :{{ \Carbon\Carbon::parse($project->created_at)->format('d-m-Y') }} </span>
            <p>Description :{{ Str::limit($project->description, 60, ' ...') }}</p>
            <p>Project head:{{ $project->project_head_name }}</p>
            <div class="project-card-nav">
                <button class="project-view-button" onclick="window.location.href='/project-view/{{ $project->id }}'">View</button>

            </div>
            
        </div>
        @endforeach
        </div>
    </div>


    <div>
    <div class="tasks">
            <div style="display:flex;gap:10px">
            <h3>Your ongoing tasks</h3>
            <select name="task_status">
                <option>To do</option>
                <option>In progress</option>
                <option>Ready for QA</option>
                <option>Cancelled tasks</option>
            </select>
        </div>
        </div>  

     <div>

</x-layouts.employee_layouts.employee-layout>
<style>
.project-card{
    margin-top:10px;
    padding:20px 20px;
    border:1px solid;
    border-color:#000000;
    border-radius:10px;
    width:368px;
    display:flex;
    flex-direction:column;
    gap:10px;
}
.project-card-nav{
    display:flex;
    justify-content:flex-end;
    align-items:flex-end;
}


.project-view-button {
    padding: 10px 10px;
    background-color: #46b5aa;
    border-radius: 10px;
    width: 100%;
    cursor:pointer;
}


</style>