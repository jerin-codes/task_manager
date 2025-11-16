<x-layouts.company-layout>



<div style="display: flex;gap:20px;justyfy-content:center">
    <div class="employee-list">
        
        <button><a href="{{route("company.employees")}}">View Employees</a></button> <button><a href="{{route("company.projects")}}">View Projects</a></button>
    </div>
</div>
</x-layouts.company-layout>

<style>
.employee-list button {
    background-color: green;
    border-radius: 7px;
    cursor: pointer;
    text-decoration: none;
    height: 40px;
    width: 166px;
    font-size: 17px;
}

.employee-list button a{
     text-decoration: none;
     color: #000000;
}

</style>