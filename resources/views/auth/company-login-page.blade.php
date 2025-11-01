<x-login-layout>
<div class="login">
<div class="card">
  
    <form action="{{route("company.login")}}" method="POST">
      @csrf
       @error("failed") {{$message}}@enderror
      <div class="form-data">
        <h3>Welcome back</h3>
     
    <div>

      <label for="registration_id">Company registration id</label>
      <input type="text" name="company_id">
    </div>
      <div>

        <label for="password">Password</label>
        <input type="password" name="password">
      </div>

      <div style="display: flex; gap:6px;">
      <label>Remeber me</label>
      <input type="checkbox" name="remember">
      </div>
    <button class="" type="submit">Login</button>
      <span>Dont have an a account <a href="{{route("company.register")}}">Register</a></span>
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
