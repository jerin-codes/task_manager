
@props(["data"])
@php
  $company_employees=get_company_employees(auth()->user()->id);  
@endphp
{{-- Create Task Modal --}}
<div id="apply-filter-modal" class="modal-overlay">
    <div class="modal-content">
        
        <div class="modal-header">
            <h2>Apply filter</h2>
            <button class="close-btn" onclick="closeModal()">×</button>
        </div>

        <div class="modal-body">
        

            {{-- Your form can go here --}}
            <form action="{{ route("projects.apply.filter") }}" method="POST">
                @csrf

                <input type="hidden" name="project_id" value="{{ $data["project_details"][0]->id }}">
                <label>Filter by date</label>
                <label>From</label>
                <input type="date"  name="filter_date_from" placeholder="Enter the from date" max="{{ date('Y-m-d') }}" >
                <label>To</label>
                <input type="date"  name="filter_date_to" placeholder="Enter the  end date" max="{{ date('Y-m-d') }}" >
                <br>
                <label>Filter by employees</select>
                <select name="assigned_employee" >
                    <option value="">Assigned to</option>
                    @foreach ($company_employees as $employee)
                    <option value={{ $employee->id }}>{{ $employee->name }}</option>
                    @endforeach
                </select><br><br><br>
                <label>Filter by status</filter>
                    <select name="filter_status">
                    <option value="">All status</option>
                <option value="to_do">To do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="ready_for_qa">Ready For  QA</option>
                        <option value="qa_passed">QA Passes</option>
                    </select>    
                <button class="submit-btn" type="submit">Apply Filter</button>
            </form>

        </div>

    </div>
</div>