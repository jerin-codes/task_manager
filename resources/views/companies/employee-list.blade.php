<x-company-layout>

@if(count($users) == 0)
    <div class="zero-employees">
        <h2>No employees found</h2>
        <button id="addEmployeeBtn">Add new employee</button>
    </div>
@else
    <div class="employee-section">
        <div class="header-row">
            <h2>List of Employees</h2>
            <button id="addEmployeeBtn">Add new employee</button>
        </div>

        <table class="employee-table">
            <thead>
                <tr>
                    <th>SI. No</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }} </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at}}</td>
                        <td><button > View</button><button  style="background-color: bluephp">Edit</button><button  style="background-color: red">Delete</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<!-- Employee Add Modal -->
<div id="employeeModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add New Employee</h2>

        <form action="{{ route('comapny.employee.register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name"> Name:</label>
                <input type="text" name="first_name" id="first_name" required>
            </div>


            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                @error("email") <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Employee Login Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="submit-btn">Save Employee</button>
        </form>
    </div>
</div>

</x-company-layout>

<style>
.zero-employees {
    display: flex;
    flex-direction: column;
    gap: 20px;
    justify-content: center;
    align-items: center;
    height: 80vh;
}

.zero-employees button {
    background-color: green;
    border-radius: 7px;
    cursor: pointer;
    text-decoration: none;
    height: 40px;
    width: 166px;
    font-size: 17px;
    color: white;
    border: none;
}

.employee-section {
    padding: 30px;
}

.header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.employee-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

.employee-table th, 
.employee-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.employee-table th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.employee-table tr:hover {
    background-color: #f9f9f9;
}

.employee-table tr:nth-child(even) {
    background-color: #fafafa;
}

.employee-section button {
    background-color: green;
    color: white;
    border: none;
    border-radius: 7px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 15px;
}

.employee-section button:hover {
    background-color: darkgreen;
}

/* Modal Styles */
.modal {
    display: none; 
    position: fixed; 
    z-index: 999; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%;
    overflow: auto; 
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fff;
    margin: 10% auto; 
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.modal-content h2 {
    text-align: center;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.submit-btn {
    background-color: green;
    color: white;
    padding: 10px;
    border-radius: 7px;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.submit-btn:hover {
    background-color: darkgreen;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: black;
}

.error {
    color: red;
    font-size: 14px;
}
</style>

<script>
    const modal = document.getElementById('employeeModal');
    const btn = document.getElementById('addEmployeeBtn');
    const span = document.getElementsByClassName('close')[0];

    // Open modal
    btn.onclick = function() {
        modal.style.display = 'block';
    }

    // Close modal on X click
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
