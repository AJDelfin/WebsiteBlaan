<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - GLPBL: Teacher's Portal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="dashboard-body">
    <header>
        <div class="logo">
            <canvas id="logo" width="40" height="40"></canvas>
            <span>GLPBL: Teacher's Portal</span>
        </div>

        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search...">
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
                        <a href="#" id="logoutBtn">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <aside class="sidebar">
        <ul class="sidebar-nav">
            <li><a href="home.html" class="active"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="modules.html"><i class="fas fa-cube"></i>Modules</a></li>
            <li><a href="subjects.html"><i class="fas fa-book"></i>Subjects</a></li>
            <li><a href="#activities"><i class="fas fa-tasks"></i>Activities</a></li>
            <li><a href="#grades"><i class="fas fa-chart-bar"></i>Grades/Score</a></li>
        </ul>
    </aside>

    <main class="dashboard-content">
        <div class="hero-section">
            <h1>Let's Learn Blaan!</h1>
            <p class="subheadline">Learn Blaan effortlessly with interactive lessons, expert guidance, and personalized learning paths.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-clipboard-list feature-icon"></i>
                <h3>View Submissions</h3>
                <p>Review and manage student submissions for assignments and activities.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-bullhorn feature-icon"></i>
                <h3>Send Announcements</h3>
                <p>Keep your students informed with important updates and announcements.</p>
            </div>
        </div>
    </main>

    <script src="script.js"></script>
</body>

</html>