<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes - GLPBL: Teacher's Portal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Your base colors */
        :root {
            --main-color: #44ad73;
            --red: #e74c3c;
            --orange: #f39c12;
            --light-color: #888;
            --light-bg: #eee;
            --black: #2c3e50;
            --white: #fff;
            --bg-color: #ffffff;
            --text-color: #2c3e50;
            --sidebar-bg: #ffffff;
            --card-bg: #ffffff;
            --header-bg: #ffffff;
        }

        /* Dark Mode Colors */
        body.dark-mode {
            --bg-color: #2c3e50;
            --text-color: #ffffff;
            --sidebar-bg: #34495e;
            --card-bg: #34495e;
            --header-bg: #2c3e50;
            --light-bg: #1e1e1e;
            --light-color: #bdc3c7;
        }

        body.dashboard-body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        header {
            background-color: var(--header-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--main-color);
        }

        .search-container {
            flex: 1;
            margin: 0 2rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: var(--light-bg);
            border-radius: 20px;
            padding: 0.5rem 1rem;
        }

        .search-box input {
            border: none;
            background: none;
            outline: none;
            flex: 1;
            font-size: 1rem;
            color: var(--text-color);
        }

        .search-box button {
            border: none;
            background: none;
            cursor: pointer;
            color: var(--light-color);
        }

        .nav-menu ul {
            list-style: none;
            display: flex;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-color);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-menu a:hover {
            color: var(--main-color);
        }

        .profile-dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--white);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 0.5rem;
            z-index: 1;
        }

        .profile-dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            display: block;
            padding: 0.5rem 1rem;
            color: var(--text-color);
        }

        .dropdown-content a:hover {
            background-color: var(--light-bg);
        }

        aside.sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 60px);
            position: fixed;
            top: 60px;
            left: 0;
            padding: 1rem;
            transition: transform 0.3s ease;
        }

        aside.sidebar-closed {
            transform: translateX(-100%);
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin-bottom: 1rem;
        }

        .sidebar-nav a {
            text-decoration: none;
            color: var(--text-color);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-nav a:hover {
            color: var(--main-color);
        }

        .sidebar-nav a.active {
            color: var(--main-color);
            font-weight: bold;
        }

        .sidebar-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background-color: var(--main-color);
            color: var(--white);
            border: none;
            border-radius: 5px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            z-index: 1000;
        }

        main.dashboard-content {
            margin-left: 250px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .content-header h1 {
            font-size: 1.5rem;
            color: var(--text-color);
        }

        .schedule-filter select {
            padding: 0.5rem;
            border: 1px solid var(--light-bg);
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            background-color: var(--white);
            color: var(--text-color);
        }

        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .class-card {
            background-color: var(--card-bg);
            border: 1px solid var(--light-bg);
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .class-header {
            margin-bottom: 1rem;
        }

        .class-header h3 {
            font-size: 1.2rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .class-header .schedule {
            font-size: 0.9rem;
            color: var(--light-color);
        }

        .class-details p {
            font-size: 0.9rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .class-actions {
            margin-top: 1rem;
        }

        .btn-primary {
            background-color: var(--main-color);
            color: var(--white);
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #3a9465;
        }
    </style>
</head>

<body class="dashboard-body">
    <header>
        <div class="logo">
            <canvas id="logo" width="40" height="40"></canvas>
            <span>GLPBL: Teacher's Portal</span>
        </div>

        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search subjects and modules...">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <nav class="nav-menu">
            <ul>
                <li><a href="{{ route('teacher.classes') }}">Classes</a></li>
                <li><a href="{{ route('teacher.students') }}">Students</a></li>
                <li><a href="#" onclick="toggleDarkMode()"><i class="fas fa-moon"></i> Dark Mode</a></li>
                <li class="profile-dropdown">
                    <a href="{{ route('teacher.profile.edit') }}"><i class="fas fa-user-circle"></i> Profile</a>
                    <div class="dropdown-content">
                        <a href="#settings">Settings</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Toggle Button -->
    <button id="sidebar-toggle" class="sidebar-toggle">
        <i class="fas fa-bars"></i> <!-- Hamburger icon -->
    </button>

    <!-- Sidebar -->
    <aside class="sidebar sidebar-closed" id="sidebar">
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('teacher.dashboard') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>Home
                </a>
            </li>
            <li>
                <a href="{{ route('teacher.modules') }}" class="{{ request()->routeIs('teacher.modules') ? 'active' : '' }}">
                    <i class="fas fa-cube"></i>Modules
                </a>
            </li>
            <li>
                <a href="{{ route('teacher.subjects') }}" class="{{ request()->routeIs('teacher.subjects') ? 'active' : '' }}">
                    <i class="fas fa-book"></i>Subjects
                </a>
            </li>
            <li>
                <a href="#activities" class="{{ request()->is('#activities') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i>Activities
                </a>
            </li>
            <li>
                <a href="#grades" class="{{ request()->is('#grades') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>Grades/Score
                </a>
            </li>
        </ul>
    </aside>

    <main class="dashboard-content">
        <div class="content-header">
            <h1>My Classes</h1>
            <div class="schedule-filter">
                <select id="dayFilter">
                    <option value="all">All Days</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                </select>
            </div>
        </div>

        <div class="classes-grid">
            <div class="class-card">
                <div class="class-header">
                    <h3>Basic Blaan Conversation</h3>
                    <span class="schedule">Monday, 9:00 AM - 10:30 AM</span>
                </div>
                <div class="class-details">
                    <p><i class="fas fa-users"></i> 20 Students</p>
                    <p><i class="fas fa-location-dot"></i> Language Lab 1</p>
                    <p><i class="fas fa-calendar"></i> Beginner Level</p>
                </div>
                <div class="class-actions">
                    <button class="btn-primary">View Class</button>
                </div>
            </div>

            <div class="class-card">
                <div class="class-header">
                    <h3>Intermediate Blaan Reading</h3>
                    <span class="schedule">Tuesday, 1:00 PM - 2:30 PM</span>
                </div>
                <div class="class-details">
                    <p><i class="fas fa-users"></i> 15 Students</p>
                    <p><i class="fas fa-location-dot"></i> Language Lab 2</p>
                    <p><i class="fas fa-calendar"></i> Intermediate Level</p>
                </div>
                <div class="class-actions">
                    <button class="btn-primary">View Class</button>
                </div>
            </div>

            <div class="class-card">
                <div class="class-header">
                    <h3>Advanced Blaan Writing</h3>
                    <span class="schedule">Wednesday, 10:30 AM - 12:00 PM</span>
                </div>
                <div class="class-details">
                    <p><i class="fas fa-users"></i> 12 Students</p>
                    <p><i class="fas fa-location-dot"></i> Language Lab 3</p>
                    <p><i class="fas fa-calendar"></i> Advanced Level</p>
                </div>
                <div class="class-actions">
                    <button class="btn-primary">View Class</button>
                </div>
            </div>

            <div class="class-card">
                <div class="class-header">
                    <h3>Blaan Cultural Studies</h3>
                    <span class="schedule">Thursday, 2:00 PM - 3:30 PM</span>
                </div>
                <div class="class-details">
                    <p><i class="fas fa-users"></i> 18 Students</p>
                    <p><i class="fas fa-location-dot"></i> Cultural Center</p>
                    <p><i class="fas fa-calendar"></i> All Levels</p>
                </div>
                <div class="class-actions">
                    <button class="btn-primary">View Class</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        // JavaScript for Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const dashboardContent = document.querySelector('.dashboard-content');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-closed');
            dashboardContent.classList.toggle('sidebar-closed');
        });

        // JavaScript for Dark Mode Toggle
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
        }

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }

        // JavaScript for Filtering Classes by Day
        const dayFilter = document.getElementById('dayFilter');
        const classCards = document.querySelectorAll('.class-card');

        dayFilter.addEventListener('change', () => {
            const selectedDay = dayFilter.value.toLowerCase();
            classCards.forEach(card => {
                const schedule = card.querySelector('.schedule').textContent.toLowerCase();
                if (selectedDay === 'all' || schedule.includes(selectedDay)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>