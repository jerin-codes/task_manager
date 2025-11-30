@php
    // @dd($data);
   $count=[ "to_do_count"=>0,
    "in_progress_count"=>0,
    "ready_for_qa_count"=>0,
    "qa_passed_count"=>0,];
    foreach($data["tasks"] as $task){
        switch ($task->status) {
            case 'to_do':$count["to_do_count"]++;
                            break;
            

            case "in_progress":$count["in_progress_count"]++;
                                break;
            case "ready_for_qa":$count["ready_for_qa_count"]++;    
                                break;
            case "qa_passed":$count["qa_passed_count"]++;
                                break;                
            default:break;
                
        }
    }
   
    
@endphp

<x-layouts.employee_layouts.employee-layout>
    <div style="display:flex;justify-content:center;padding:30px 0px;">
    <h4>{{ $data["project_details"][0]->project_name }}</h4>
    </div>
@if(count($data["tasks"])==0)
<div class="empty-tasks">
    <div style="display:flex;flex-direction:column;gap:10px">
        @if($filter)
        <h3>Oops.. no projects tasks based on the above filter</h3>
        <button class="project-view-button" onclick="window.location.href='{{ route('project.view', $data['project_details'][0]->id) }}'">Clear Filter</button>        
        @else
        <h3>Oops.. project is not yet started</h3>
        <button class="project-view-button" onclick="showModal()">Create first task</button>
        @endif
    </div>
</div>
@else
<div style="display:flex;flex-direction:row;gap:50px;justify-content:space-between">
    <div class="tasks-status-count-card">
        <h4>To do:{{ $count["to_do_count"] }}</h4>
    </div>
    <div class="tasks-status-count-card">
        <h4>In Progress:{{ $count["in_progress_count"] }}</h4>
    </div>
    <div class="tasks-status-count-card">
        <h4>Ready for QA:{{ $count["ready_for_qa_count"] }}</h4>
    </div>
    <div class="tasks-status-count-card">
        <h4>QA passed:{{ $count["qa_passed_count"] }}</h4>
    </div>
</div>
<div style="display:flex;justify-content:flex-end;gap:7px;">
<div style="display:flex;justify-content:flex-end;padding:20px 0px;">
    @if($filter)
     <button class="project-view-button" onclick="window.location.href='{{ route('project.view', $data['project_details'][0]->id) }}'">Clear Filter</button>        
    @else
     <button class="project-view-button" onclick="showFilterModal()" >Apply Filter</button>
 @endif
</div>
<div style="display:flex;justify-content:flex-end;padding:20px 0px;">
 <button class="project-view-button" onclick="showModal()">Create new task</button>
</div>
</div>
 <div style="display:flex;margin-top:3px">
   
    <div class="project-status-table">
        <div style="border:1px solid;background-color:#b58bc7;display:flex;justify-content:center">
            <h3>To do</h3>
            
        </div>
        @foreach ($data["tasks"] as $task)
            @if($task->status=="to_do")
        <div class="project-status-innner-card">
            <div style="display:flex;flex-direction:column;justify-content:center;align-items:center">
                <h3>#{{ $task->task_number }}</h3>
                <h3 >{{ $task->name }}</h3>
            </div> <br>
                <h5>Assigned to : {{get_employee_data($task->assigned_employee_id)->name  }}</h5>
                <h5>Created at :{{ $task->created_at }}</h5>
                <h5>Last updation:{{ $task->updated_at }}</h5>
                <br>
                <div style="display:flex;">
                <h4>Change Status </h4><form action="{{ route("project.update.task.status") }}" method="post">
                    @csrf
                    <input type="hidden" name="task_id" value={{$task->id  }}>
                    <select name="task_status" onchange="this.form.submit()" required>
                        <option value="">Change task status</option>
                    <option value="to_do">To do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="ready_for_qa">Ready For  QA</option>
                        <option value="qa_passed">QA Passes</option>
                    </select>
                </form>
            </div>
                
            </div>
            @endif
        @endforeach
    </div>
    <div class="project-status-table">
        <div style="border:1px solid;background-color:#b58bc7;display:flex;justify-content:center">
            <h3>In progress</h3>
        </div>
        @foreach ($data["tasks"] as $task)
            @if($task->status=="in_progress")
        <div class="project-status-innner-card">
            <div style="display:flex;flex-direction:column;justify-content:center;align-items:center">
                <h3>#{{ $task->task_number }}</h3>
                <h3 >{{ $task->name }}</h3>
            </div> <br>
                <h5>Assigned to : {{get_employee_data($task->assigned_employee_id)->name  }}</h5>
                <h5>Created at :{{ $task->created_at }}</h5>
                <h5>Last updation:{{ $task->updated_at }}</h5>
                <br>
                <div style="display:flex;">
                <h4>Change Status </h4><form action="{{ route("project.update.task.status") }}" method="post">
                    @csrf
                    <input type="hidden" name="task_id" value={{$task->id  }}>
                    <select name="task_status" onchange="this.form.submit()" required>
                          <option value="">Change task status</option>

                    <option value="to_do">To do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="ready_for_qa">Ready For  QA</option>
                        <option value="qa_passed">QA Passes</option>
                    </select>
                </form>
            </div>
                
            </div>
            @endif
        @endforeach
    </div >

    <div class="project-status-table">
        <div style="border:1px solid;background-color:#b58bc7;display:flex;justify-content:center">
            <h3>Ready for QA</h3>
        </div>
        @foreach ($data["tasks"] as $task)
            @if($task->status=="ready_for_qa")
        <div class="project-status-innner-card">
            <div style="display:flex;flex-direction:column;justify-content:center;align-items:center">
                <h3>#{{ $task->task_number }}</h3>
                <h3 >{{ $task->name }}</h3>
            </div> <br>
                <h5>Assigned to : {{get_employee_data($task->assigned_employee_id)->name  }}</h5>
                <h5>Created at :{{ $task->created_at }}</h5>
                <h5>Last updation:{{ $task->updated_at }}</h5>
                <br>
                <div style="display:flex;">
                <h4>Change Status </h4><form action="{{ route("project.update.task.status") }}" method="post">
                    @csrf
                    <input type="hidden" name="task_id" value={{$task->id  }}>
                    <select name="task_status" onchange="this.form.submit()" required>
                          <option value="">Change task status</option>
                    <option value="to_do">To do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="ready_for_qa">Ready For  QA</option>
                        <option value="qa_passed">QA Passes</option>
                    </select>
                </form>
            </div>
                
            </div>
            @endif
        @endforeach
    </div >

    <div class="project-status-table">
            <div style="border:1px solid;background-color:#b58bc7;display:flex;justify-content:center">
            <h3>QA passed</h3>
        </div>
        @foreach ($data["tasks"] as $task)
            @if($task->status=="qa_passed")
        <div class="project-status-innner-card">
            <div style="display:flex;flex-direction:column;justify-content:center;align-items:center">
                <h3>#{{ $task->task_number }}</h3>
                <h3 >{{ $task->name }}</h3>
            </div> <br>
                <h5>Assigned to : {{get_employee_data($task->assigned_employee_id)->name  }}</h5>
                <h5>Created at :{{ $task->created_at }}</h5>
                <h5>Last updation:{{ $task->updated_at }}</h5>
                <br>
                <div style="display:flex;">
                <h4>Change Status </h4><form action="{{ route("project.update.task.status") }}" method="post">
                    @csrf
                    <input type="hidden" name="task_id" value={{$task->id  }}>
                    <select name="task_status" onchange="this.form.submit()" required>
                          <option value="">Change task status</option>
                    <option value="to_do">To do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="ready_for_qa">Ready For  QA</option>
                        <option value="qa_passed">QA Passes</option>
                    </select>
                </form>
            </div>
                
            </div>
            @endif
        @endforeach
    </div >
</div>
@endif
{{-- Create new task model --}}
<x-employee-modals.create-task :data="$data"/>
<x-employee-modals.filter :data="$data"/>


</x-layouts.employee_layouts.employee-layout>


<style>
/* Empty task section */
.empty-tasks {
    display: flex;
    height: 87vh;
    justify-content: center;
    align-items: center;
}

.project-view-button {
    padding: 10px 15px;
    background-color: #46b5aa;
    color: white;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    font-size: 15px;
    transition: 0.3s;
}

.project-view-button:hover {
    background-color: #3a9c93;
}

/* Modal Overlay */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(3px);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Modal Box */
.modal-content {
    background: white;
    width: 450px;
    padding: 0;
    border-radius: 12px;
    overflow: hidden;
    animation: fadeIn 0.25s ease-in-out;
    box-shadow: 0px 10px 25px rgba(0,0,0,0.15);
}

/* Modal header */
.modal-header {
    background: #1e293b;
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    font-size: 20px;
}

.close-btn {
    background: none;
    border: none;
    font-size: 25px;
    color: white;
    cursor: pointer;
}

/* Modal body */
.modal-body {
    padding: 20px;
}

.modal-body form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.modal-body input,
.modal-body textarea {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
}

textarea {
    min-height: 100px;
    resize: vertical;
}

.submit-btn {
    background: #2563eb;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: .3s;
}

.submit-btn:hover {
    background: #1d4ed8;
}

.tasks-status-count-card {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 204px;
    height: 81px;
    border: 1px solid;
    border-color: #00fff0;
    border-radius: 8px;
    background-color: #00fff0;
}

.project-status-table{
    height:100vh;
    border:1px solid;
    width:600px;

}

.project-status-innner-card{
       padding: 10px 10px;
    border: 1px solid;
    background-color: #d6d9ed;
    min-height: 158px;
}


/* Modal animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>

<script>
function showModal() {
    document.getElementById("create-task-modal").style.display = "flex";
}

function closeModal() {
    document.getElementById("create-task-modal").style.display = "none";
    document.getElementById("apply-filter-modal").style.display="none";
}

function showFilterModal(){
    document.getElementById("apply-filter-modal").style.display="flex";
}


</script>
