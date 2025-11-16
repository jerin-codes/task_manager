<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
   
    <title>Task Manager</title>

    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        /* Header styling */
        header {
            background-color: #1e3a8a; /* Deep blue */
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        header h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Navigation styling */
        nav ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #93c5fd; /* Lighter blue hover */
        }

        /* Main content area */
        main {
            padding: 2rem;
         
        }

        /* Footer styling (optional) */
        footer {
            text-align: center;
            padding: 1rem;
            background-color: #1e3a8a;
            color: white;
            font-size: 0.9rem;
            margin-top: 2rem;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            nav ul {
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
                margin-top: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <header>
         <a href="{{route("company.dashboard")}}"><img  style="height:53px " src="{{asset("storage/logos/logo.png")}}"></a>
            <p>Welcome {{session("company_name")}}</p>
            
            <ul>
               <li ><form action="{{ route("company.logout") }}" method="post">@csrf<button>Logout</button></form></li> 
            </ul>
    </header>

    <main>
        {{$slot}}
    </main>

</body>
</html>
