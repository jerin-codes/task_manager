<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>Employee Panel</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        body {
            background: #f3f4f6;
            color: #333;
        }

        /* NAVBAR */
        header {
            background: #0f172a;
            color: white;
            padding: 0.9rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        header img {
            height: 48px;
        }

        /* Left Menu */
        nav ul {
            list-style: none;
            display: flex;
            gap: 1.8rem;
        }

        nav a {
            text-decoration: none;
            color: #cbd5e1;
            font-weight: 500;
            transition: 0.25s;
        }

        nav a:hover {
            color: #60a5fa;
        }

        /* Right Profile Dropdown */
        .profile-menu {
            position: relative;
        }

        .profile-btn {
            background: none;
            border: none;
            color: #cbd5e1;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-btn:hover {
            color: #60a5fa;
        }

        .dropdown-box {
            position: absolute;
            right: 0;
            top: 45px;
            width: 180px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            overflow: hidden;
           
        }

        .dropdown-box a,
        .dropdown-box button {
            display: block;
            width: 100%;
            padding: 12px 15px;
            border: none;
            background: white;
            text-align: left;
            font-size: 0.95rem;
            color: #333;
            cursor: pointer;
            transition: background 0.25s;
        }

        .dropdown-box a:hover,
        .dropdown-box button:hover {
            background: #f1f5f9;
        }

        main {
            padding: 40px 0px;
            max-width: 1100px;
            margin: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav ul {
                display: none;
            }
        }
    </style>
</head>

<body>

<header>

    <!-- LOGO -->
    <a href="{{ route("employee.dashboard") }}">
        <img src="#" alt="Logo">
    </a>

    <!-- NAV MENU -->
    <nav>
        <ul>
          
          
            <li><a href="#">Attendance</a></li>
            <li><a href="#">Activity</a></li>
        </ul>
    </nav>

    <!-- PROFILE DROPDOWN -->
    <div x-data="{ open: false }" class="profile-menu">
        <button class="profile-btn" @click="open = !open">
            {{ session('employee_name') }}
            ▾
        </button>

        <div class="dropdown-box" x-show="open" @click.outside="open = false">
            <a href="#">My Profile</a>
            <a href="#">Settings</a>

            <form action="{{ route("employee.logout") }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

</header>

<main>
    <div>
        {{ $slot }}
    </div>
</main>

</body>
</html>
    