<x-layouts.employee_layouts.employee-layout>
@php
$committed_projects=get_employee_projects(auth()->user()->id);

foreach($committed_projects as $index=>$project){
    
    $project_head=get_project_head_data($project->project_head_id);
    $committed_projects[$index]->project_head_name=$project_head;
}   

$ongoing_tasks=get_employee_ongoing_tasks(auth()->user()->id);;
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
           
        </div>
        <div style="margin-top:30px">
            @foreach ($ongoing_tasks as $task )
            <div class="ongoing-task-card">
                <div style="display:flex;justify-content:flex-end">
                    <div style="background-color:#00ff00;">
                    <h6>{{ $task->status }}</h6>
                    </div> 
                </div>
                <h4>Task #{{ $task->task_number }}</h4>
                <h4>Project :{{ get_project_name($task->project_id)->project_name }}</h4>
                <h5>{{ $task->description }}</h5>
                <h5>Craeted at:{{ $task->created_at  }} </h5>
            </div>
                @endforeach
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


.ongoing-task-card{
    padding:10px 20px;
    background-color:#c2adc9;
    margin-top:10px;


}

</style>