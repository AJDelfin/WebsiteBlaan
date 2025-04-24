<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - GLPBL: Teacher's Portal</title>
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

        .students-search-section {
            margin-bottom: 2rem;
        }

        .search-header h1 {
            font-size: 1.5rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .search-header p {
            font-size: 0.9rem;
            color: var(--light-color);
        }

        .main-search {
            display: flex;
            align-items: center;
            background-color: var(--light-bg);
            border-radius: 20px;
            padding: 0.5rem 1rem;
            margin-bottom: 1rem;
        }

        .main-search .search-icon {
            color: var(--light-color);
        }

        .main-search input {
            border: none;
            background: none;
            outline: none;
            flex: 1;
            font-size: 1rem;
            color: var(--text-color);
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
        }

        .filter-group {
            flex: 1;
        }

        .filter-group label {
            font-size: 0.9rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .filter-group select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--light-bg);
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            background-color: var(--white);
            color: var(--text-color);
        }

        .results-info {
            font-size: 0.9rem;
            color: var(--light-color);
            margin-bottom: 1rem;
        }

        .students-table {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .students-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .students-table th,
        .students-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--light-bg);
        }

        .students-table th {
            font-size: 0.9rem;
            color: var(--light-color);
        }

        .students-table td {
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--light-color);
            font-size: 1rem;
            margin-right: 0.5rem;
        }

        .btn-icon:hover {
            color: var(--main-color);
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
                        <a href="#" id="logoutBtn">Logout</a>
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
        <div class="students-search-section">
            <div class="search-header">
                <h1>Students List</h1>
                <p>Search and filter students by name, grade level, or subjects</p>
            </div>

            <div class="search-container">
                <div class="main-search">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="studentSearch" placeholder="Search students by name...">
                </div>

                <div class="filter-controls">
                    <div class="filter-group">
                        <label for="gradeFilter">Grade Level</label>
                        <select id="gradeFilter">
                            <option value="">All Grade Levels</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="subjectFilter">Subject</label>
                        <select id="subjectFilter">
                            <option value="">All Subjects</option>
                            <option value="math">Mathematics</option>
                            <option value="physics">Physics</option>
                            <option value="chemistry">Chemistry</option>
                            <option value="biology">Biology</option>
                        </select>
                    </div>
                </div>
                <button onclick="addStudent()" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Student</button>
            </div>
        </div>

        <div class="results-info">
            <p>Showing <span id="studentCount">3</span> students</p>
        </div>

        <div class="students-table">
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Gmail</th>
                        <th>Grade Level</th>
                        <th>Subjects</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentsTableBody">
                    <!-- Rows will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Sample Data (Replace with localStorage or API calls)
        let students = JSON.parse(localStorage.getItem('students')) || [{
                id: 1,
                studentId: '2024-001',
                name: 'John Smith',
                gmail: 'john.smith@example.com',
                grade: '7',
                subjects: 'Mathematics, Physics',
                isArchived: false
            },
            {
                id: 2,
                studentId: '2024-002',
                name: 'Emma Johnson',
                gmail: 'emma.johnson@example.com',
                grade: '8',
                subjects: 'Chemistry, Biology',
                isArchived: false
            },
            {
                id: 3,
                studentId: '2024-003',
                name: 'Michael Brown',
                gmail: 'michael.brown@example.com',
                grade: '7',
                subjects: 'Mathematics, Chemistry',
                isArchived: false
            }
        ];

        // Render Students Table
        function renderStudents() {
            const tbody = document.getElementById('studentsTableBody');
            tbody.innerHTML = '';

            students.forEach((student, index) => {
                if (!student.isArchived) {
                    const row = `
                        <tr>
                            <td>${student.studentId}</td>
                            <td>${student.name}</td>
                            <td>${student.gmail}</td>
                            <td>Grade ${student.grade}</td>
                            <td>${student.subjects}</td>
                            <td>
                                <button class="btn-icon edit-btn" title="Edit" onclick="editStudent(${student.id})"><i class="fas fa-edit"></i></button>
                                <button class="btn-icon archive-btn" title="Archive" onclick="archiveStudent(${student.id})"><i class="fas fa-archive"></i></button>
                                <button class="btn-icon delete-btn" title="Delete" onclick="deleteStudent(${student.id})"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                }
            });

            document.getElementById('studentCount').textContent = students.filter(s => !s.isArchived).length;
            localStorage.setItem('students', JSON.stringify(students));
        }

        // Add Student
        function addStudent() {
            const studentId = prompt("Enter Student ID:");
            const name = prompt("Enter Name:");
            const gmail = prompt("Enter Gmail:");
            const grade = prompt("Enter Grade Level:");
            const subjects = prompt("Enter Subjects:");

            if (studentId && name && gmail && grade && subjects) {
                const newStudent = {
                    id: students.length + 1,
                    studentId,
                    name,
                    gmail,
                    grade,
                    subjects,
                    isArchived: false
                };
                students.push(newStudent);
                renderStudents();
                alert('Student added successfully.');
            } else {
                alert('All fields are required.');
            }
        }

        // Edit Student
        function editStudent(id) {
            const student = students.find(s => s.id === id);
            const studentId = prompt("Enter Student ID:", student.studentId);
            const name = prompt("Enter Name:", student.name);
            const gmail = prompt("Enter Gmail:", student.gmail);
            const grade = prompt("Enter Grade Level:", student.grade);
            const subjects = prompt("Enter Subjects:", student.subjects);

            if (studentId && name && gmail && grade && subjects) {
                student.studentId = studentId;
                student.name = name;
                student.gmail = gmail;
                student.grade = grade;
                student.subjects = subjects;
                renderStudents();
                alert('Student updated successfully.');
            } else {
                alert('All fields are required.');
            }
        }

        // Archive Student (Soft Delete)
        function archiveStudent(id) {
            if (confirm('Are you sure you want to archive this student?')) {
                const student = students.find(s => s.id === id);
                student.isArchived = true;
                renderStudents();
                alert('Student archived successfully.');
            }
        }

        // Delete Student (Hard Delete)
        function deleteStudent(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                students = students.filter(s => s.id !== id);
                renderStudents();
                alert('Student deleted successfully.');
            }
        }

        // Initial Render
        renderStudents();
    </script>
</body>

</html>