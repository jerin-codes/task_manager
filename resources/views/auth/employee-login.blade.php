<x-layouts.login-layout>

    <div style="
        max-width: 400px;
        margin: 60px auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    ">
        <h2 style="text-align:center; margin-bottom:20px; color:#1e3a8a;">Employee Login</h2>
        @error("login_failed")
            <p style="color:red;text-align:center">{{$message}}</p>
        @enderror

        <form action="{{ route("employee.login") }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Email</label>
                <input 
                    type="email" 
                    name="email" 
                    
                    style="
                        width: 100%;
                        padding: 10px;
                        border-radius: 8px;
                        border: 1px solid #ccc;
                        margin-top: 5px;
                    "
                >
                @error("email")<p style="color:red"> {{ $message }}</p>  @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Password</label>
                <input 
                    type="password" 
                    name="password" 
                    
                    style="
                        width: 100%;
                        padding: 10px;
                        border-radius: 8px;
                        border: 1px solid #ccc;
                        margin-top: 5px;
                    "
                >
                @error("password")<p style="color:red">{{ $message }} </p>@enderror
            </div>

            <button
                type="submit"
                style="
                    width: 100%;
                    padding: 12px;
                    background: #1e3a8a;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    font-size: 16px;
                    cursor: pointer;
                "
            >
                Login
            </button>

            <div style="margin-top:15px; text-align:center;">
                <a href="#" style="color:#1e3a8a; text-decoration:none;">Forgot Password?</a>
            </div>
        </form>
    </div>


</x-layouts.login-layout>
