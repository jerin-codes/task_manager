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
            background: #f4f6f9;
            color: #333;
        }

        /* NAVBAR */
        header {
            background: #1e293b;
            color: white;
            padding: 0.8rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header img {
            height: 50px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        nav a {
            text-decoration: none;
            color: #e2e8f0;
            font-weight: 500;
            font-size: 1rem;
            transition: 0.3s;
        }

        nav a:hover {
            color: #60a5fa;
        }

        /* Profile Dropdown */
        .profile-menu {
            position: relative;
        }

        .profile-btn {
            cursor: pointer;
            background: none;
            border: none;
            color: #e2e8f0;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-dropdown {
            position: absolute;
            right: 0;
            top: 45px;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
            border-radius: 10px;
            overflow: hidden;
            display: none;
            width: 180px;
        }

        .profile-dropdown a,
        .profile-dropdown button {
            display: block;
            padding: 12px 15px;
            border: none;
            text-align: left;
            width: 100%;
            background: white;
            color: #333;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background 0.2s;
        }

        .profile-dropdown a:hover,
        .profile-dropdown button:hover {
            background: #f3f4f6;
        }

        main {
            padding: 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .content-wrapper {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
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

        <!-- Logo -->
        <a href="#">
            <img src="#" alt="Logo">
        </a>

        <!-- Navbar -->
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">My Tasks</a></li>
                <li><a href="#">Attendance</a></li>
                <li><a href="#">Notifications</a></li>
            </ul>
        </nav>

        <!-- Profile Dropdown -->
        <div x-data="{ open: false }" class="profile-menu">
            <button class="profile-btn" @click="open = !open">
                {{ session('employee_name') }}
                ⬇
            </button>

            <div class="profile-dropdown" x-show="open" @click.outside="open=false">
                <a href="#">My Profile</a>
                <a href="#">Settings</a>

                <form action="#" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>

    </header>

    <main>
        <div >
            {{ $slot }}
        </div>
    </main>

</body>
</html>
