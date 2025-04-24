<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - GLPBL: Teacher's Portal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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

        body.dashboard-body {
            font-family: 'Arial', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        header {
            background-color: var(--header-bg);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo canvas {
            background-color: var(--main-color);
            border-radius: 8px;
        }

        .search-container {
            flex: 1;
            margin: 0 2rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 0.5rem;
        }

        .search-box input {
            border: none;
            background: none;
            outline: none;
            flex: 1;
            padding: 0.5rem;
        }

        .search-box button {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--light-color);
        }

        .nav-menu ul {
            list-style: none;
            display: flex;
            gap: 1rem;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--white);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem;
            top: 100%;
            right: 0;
            min-width: 150px;
        }

        .profile-dropdown:hover .dropdown-content {
            display: block;
        }

        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            padding: 1rem;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav a {
            text-decoration: none;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .sidebar-nav a:hover {
            background-color: var(--light-bg);
        }

        .dashboard-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .profile-section {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-container {
            display: flex;
            gap: 2rem;
        }

        .profile-image-section {
            flex: 1;
            max-width: 200px;
        }

        .profile-image {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .profile-image:hover .image-overlay {
            opacity: 1;
        }

        .upload-btn {
            color: var(--white);
            cursor: pointer;
            text-align: center;
        }

        .profile-form {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group input,
        .form-group select {
            padding: 0.75rem;
            border: 1px solid var(--light-bg);
            border-radius: 8px;
            outline: none;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn-primary,
        .btn-secondary {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-primary {
            background-color: var(--main-color);
            color: var(--white);
        }

        .btn-secondary {
            background-color: var(--light-bg);
            color: var(--text-color);
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

    <aside class="sidebar">
        <ul class="sidebar-nav">
            <li><a href="home.html"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="#modules"><i class="fas fa-cube"></i>Modules</a></li>
            <li><a href="#subjects"><i class="fas fa-book"></i>Subjects</a></li>
            <li><a href="#activities"><i class="fas fa-tasks"></i>Activities</a></li>
            <li><a href="#grades"><i class="fas fa-chart-bar"></i>Grades/Score</a></li>
        </ul>
    </aside>

    <main class="dashboard-content">
        <div class="profile-section">
            <h1>My Profile</h1>

            <div class="profile-container">
                <div class="profile-image-section">
                    <div class="profile-image">
                        <img id="profileImage" src="https://via.placeholder.com/150" alt="Profile Picture">
                        <div class="image-overlay">
                            <label for="imageUpload" class="upload-btn">
                                <i class="fas fa-camera"></i>
                                Change Photo
                            </label>
                            <input type="file" id="imageUpload" accept="image/*" style="display: none;">
                        </div>
                    </div>
                </div>

                <form id="profileForm" class="profile-form">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="" required autocomplete="given-name">
                    </div>

                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="" required autocomplete="family-name">
                    </div>

                    <div class="form-group">
                        <label for="suffix">Suffix</label>
                        <select id="suffix" name="suffix">
                            <option value="">None</option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter current password" autocomplete="current-password">
                    </div>

                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" autocomplete="new-password">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Save Changes</button>
                        <button type="reset" class="btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Dark Mode Toggle
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkMode);
        }

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }

        // Profile Image Upload
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Form Validation
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                alert('New password and confirm password do not match.');
                return;
            }

            alert('Profile updated successfully!');
            // Add logic to submit form data to the server
        });

        // Logout Button
        document.getElementById('logoutBtn').addEventListener('click', function() {
            alert('Logged out successfully!');
            // Add logic to handle logout
        });
    </script>
</body>

</html>