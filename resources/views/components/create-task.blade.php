
@props(["data"])
@php
  $company_employees=get_company_employees(auth()->user()->id);  


@endphp
{{-- Create Task Modal --}}
<div id="create-task-modal" class="modal-overlay">
    <div class="modal-content">
        
        <div class="modal-header">
            <h2>Create New Task</h2>
            <button class="close-btn" onclick="closeModal()">×</button>
        </div>

        <div class="modal-body">
        

            {{-- Your form can go here --}}
            <form action="{{ route("project.create.task") }}" method="POST">
                @csrf

                <input type="hidden" name="project_id" value="{{ $data["project_details"][0]->id }}">
                <label>Task Title</label>
                <input type="text"  name="name" placeholder="Enter task title" required>

                <label>Description</label>
                <textarea name="description" placeholder="Task description..." required></textarea>
                <br>
                <label>Select employee</select>
                <select name="assigned_employee" required>
                    <option value="">Assign to</option>
                    @foreach ($company_employees as $employee)
                    <option value={{ $employee->id }}>{{ $employee->name }}</option>
                    @endforeach
                </select><br><br><br>

                <label>Attachment</label>
                <input type="file" name="attachment">

                <button class="submit-btn" type="submit">Create Task</button>
            </form>

        </div>

    </div>
</div>