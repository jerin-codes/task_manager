<x-login-layout>
<div class="login">
<div class="card">
  
    <form action="{{route("company.register")}}" method="POST">
      @csrf
      
      <div class="form-data">
        <h3>Register your compnay</h3>
      <div>

        <label for="company_name">Company name</label>
        <input type="text" name="company_name" ><br>
      @error("company_name")<p style="color:red">{{$message}}</p>@enderror
    </div>
    <div>

      <label for="registration_id">Company id</label>
      <input type="text" name="company_id">
      @error("company_id")<p style="color:red">{{$message}}</p>@enderror
    </div>
      <div>

        <label for="password">Password</label>
        <input type="password" name="password">
        @error("password")<p style="color:red">{{$message}}</p>@enderror
      </div>

      <div>

        <label for="password">Confirm password</label>
        <input type="password" name="password_confirmation">
     
    </div>

    <button class="" type="submit">Register</button>
      <span>Alreagy have an a account ?<a href="{{route("company.login")}}">Login</a></span>
      </div>
    </form>
</div>
</div>
</x-login-layout>

<style>
    .login {
      display: flex;
      justify-content: center; /* Centers horizontally */
      align-items: center; /* Centers vertically */
      height: 100vh; /* Example: make parent span full viewport height */
    }

    .login .card {
    border: 1px solid #000000;
    width: 50%;
    height: 60vh;
    padding: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

    .form-data{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap:20px;
        align-items: center;
    }

   .form-data button {
    background-color: green;
    border-radius: 7px;
    cursor: pointer;
    text-decoration: none;
    height: 40px;
    width: 166px;
    font-size: 17px;
}
   

</style>
