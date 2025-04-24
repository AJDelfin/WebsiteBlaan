<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules - GLPBL: Teacher's Portal</title>
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

        .modules-section {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .modules-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .modules-header h1 {
            font-size: 1.5rem;
            color: var(--text-color);
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-primary,
        .btn-secondary {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--main-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: #3a9465;
        }

        .btn-secondary {
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background-color: #ddd;
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .module-card {
            background-color: var(--card-bg);
            border: 1px solid var(--light-bg);
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .module-card h3 {
            font-size: 1.2rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .module-card p {
            font-size: 0.9rem;
            color: var(--light-color);
            margin-bottom: 1rem;
        }

        .module-card .module-subject {
            font-size: 0.8rem;
            color: var(--main-color);
            margin-bottom: 1rem;
        }

        .module-card .actions {
            display: flex;
            gap: 0.5rem;
        }

        .module-card .actions button {
            padding: 0.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .module-card .actions button.edit-btn {
            background-color: var(--main-color);
            color: var(--white);
        }

        .module-card .actions button.edit-btn:hover {
            background-color: #3a9465;
        }

        .module-card .actions button.archive-btn {
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        .module-card .actions button.archive-btn:hover {
            background-color: #ddd;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            color: var(--text-color);
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--light-color);
        }

        .close-btn:hover {
            color: var(--text-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--light-bg);
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            background-color: var(--white);
            color: var(--text-color);
        }

        .form-group textarea {
            resize: vertical;
        }

        .file-input {
            display: block;
            margin-top: 0.5rem;
        }

        .file-info {
            font-size: 0.8rem;
            color: var(--light-color);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            --bg-color: #2c3e50;
            --text-color: #ffffff;
            --sidebar-bg: #34495e;
            --card-bg: #34495e;
            --header-bg: #2c3e50;
            --light-bg: #1e1e1e;
            --light-color: #bdc3c7;
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
                <input type="text" id="searchInput" placeholder="Search modules...">
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
        <i class="fas fa-bars"></i>
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
        <div class="modules-section">
            <div class="modules-header">
                <h1>Modules</h1>
                <div class="header-actions">
                    <button class="btn-secondary" onclick="toggleArchivedModules()">
                        <i class="fas fa-archive"></i> View Archived
                    </button>
                    <button class="btn-primary" onclick="openAddModuleModal()">
                        <i class="fas fa-plus"></i> Add New Module
                    </button>
                </div>
            </div>
            <div class="modules-grid" id="modulesGrid">
                <!-- Modules will be dynamically added here -->
            </div>
        </div>
    </main>

    <!-- Add Module Modal -->
    <div class="modal" id="addModuleModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Module</h2>
                <button class="close-btn" onclick="closeAddModuleModal()">&times;</button>
            </div>
            <form id="addModuleForm" onsubmit="handleAddModule(event)">
                <div class="form-group">
                    <label for="moduleName">Module Name</label>
                    <input type="text" id="moduleName" name="moduleName" required>
                </div>
                <div class="form-group">
                    <label for="moduleDescription">Description</label>
                    <textarea id="moduleDescription" name="moduleDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="moduleSubject">Subject</label>
                    <select id="moduleSubject" name="moduleSubject" required>
                        <option value="" disabled selected>Select a subject</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Science">Science</option>
                        <option value="English">English</option>
                        <option value="History">History</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="moduleFile">Upload File</label>
                    <input type="file" id="moduleFile" name="moduleFile" class="file-input">
                    <small class="file-info">Supported formats: PDF, DOC, DOCX, PPT, PPTX (Max size: 200MB)</small>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Add Module</button>
                    <button type="button" class="btn-secondary" onclick="closeAddModuleModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Module Modal -->
    <div class="modal" id="editModuleModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Module</h2>
                <button class="close-btn" onclick="closeEditModuleModal()">&times;</button>
            </div>
            <form id="editModuleForm" onsubmit="handleEditModule(event)">
                <input type="hidden" id="editModuleId">
                <div class="form-group">
                    <label for="editModuleName">Module Name</label>
                    <input type="text" id="editModuleName" name="editModuleName" required>
                </div>
                <div class="form-group">
                    <label for="editModuleDescription">Description</label>
                    <textarea id="editModuleDescription" name="editModuleDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editModuleSubject">Subject</label>
                    <select id="editModuleSubject" name="editModuleSubject" required>
                        <option value="" disabled selected>Select a subject</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Science">Science</option>
                        <option value="English">English</option>
                        <option value="History">History</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editModuleFile">Upload File</label>
                    <input type="file" id="editModuleFile" name="editModuleFile" class="file-input">
                    <small class="file-info">Supported formats: PDF, DOC, DOCX, PPT, PPTX (Max size: 200MB)</small>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Save Changes</button>
                    <button type="button" class="btn-secondary" onclick="closeEditModuleModal()">Cancel</button>
                    <button type="button" class="btn-secondary" onclick="archiveModule()">
                        <i class="fas fa-archive"></i> Archive Module
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript for Dynamic Functionality
        const modulesGrid = document.getElementById('modulesGrid');
        const addModuleModal = document.getElementById('addModuleModal');
        const editModuleModal = document.getElementById('editModuleModal');
        const addModuleForm = document.getElementById('addModuleForm');
        const editModuleForm = document.getElementById('editModuleForm');
        const searchInput = document.getElementById('searchInput');

        let modules = [];

        // Sample Data
        modules = [{
                id: 1,
                name: 'Algebra Basics',
                description: 'Introduction to algebraic concepts.',
                subject: 'Mathematics',
                file: null,
                archived: false
            },
            {
                id: 2,
                name: 'Physics 101',
                description: 'Fundamentals of physics.',
                subject: 'Science',
                file: null,
                archived: false
            },
        ];

        // Render Modules
        function renderModules(filteredModules = modules) {
            modulesGrid.innerHTML = '';
            filteredModules.forEach(module => {
                if (!module.archived) {
                    const moduleCard = document.createElement('div');
                    moduleCard.className = 'module-card';
                    moduleCard.innerHTML = `
                        <h3>${module.name}</h3>
                        <p>${module.description}</p>
                        <div class="module-subject">Subject: ${module.subject}</div>
                        <div class="actions">
                            <button class="edit-btn" onclick="openEditModuleModal(${module.id})"><i class="fas fa-edit"></i> Edit</button>
                            <button class="archive-btn" onclick="archiveModule(${module.id})"><i class="fas fa-archive"></i> Archive</button>
                        </div>
                    `;
                    modulesGrid.appendChild(moduleCard);
                }
            });
        }

        // Open Add Module Modal
        function openAddModuleModal() {
            addModuleModal.style.display = 'flex';
        }

        // Close Add Module Modal
        function closeAddModuleModal() {
            addModuleModal.style.display = 'none';
            addModuleForm.reset();
        }

        // Handle Add Module Form Submission
        function handleAddModule(event) {
            event.preventDefault();
            const moduleName = document.getElementById('moduleName').value;
            const moduleDescription = document.getElementById('moduleDescription').value;
            const moduleSubject = document.getElementById('moduleSubject').value;
            const moduleFile = document.getElementById('moduleFile').files[0];

            const newModule = {
                id: modules.length + 1,
                name: moduleName,
                description: moduleDescription,
                subject: moduleSubject,
                file: moduleFile,
                archived: false,
            };

            modules.push(newModule);
            renderModules();
            closeAddModuleModal();
        }

        // Open Edit Module Modal
        function openEditModuleModal(id) {
            const module = modules.find(mod => mod.id === id);
            if (module) {
                document.getElementById('editModuleId').value = module.id;
                document.getElementById('editModuleName').value = module.name;
                document.getElementById('editModuleDescription').value = module.description;
                document.getElementById('editModuleSubject').value = module.subject;
                editModuleModal.style.display = 'flex';
            }
        }

        // Handle Edit Module Form Submission
        function handleEditModule(event) {
            event.preventDefault();
            const moduleId = document.getElementById('editModuleId').value;
            const moduleName = document.getElementById('editModuleName').value;
            const moduleDescription = document.getElementById('editModuleDescription').value;
            const moduleSubject = document.getElementById('editModuleSubject').value;
            const moduleFile = document.getElementById('editModuleFile').files[0];

            const module = modules.find(mod => mod.id === parseInt(moduleId));
            module.name = moduleName;
            module.description = moduleDescription;
            module.subject = moduleSubject;
            module.file = moduleFile;

            renderModules();
            closeEditModuleModal();
        }

        // Close Edit Module Modal
        function closeEditModuleModal() {
            editModuleModal.style.display = 'none';
            editModuleForm.reset();
        }

        // Archive Module
        function archiveModule(id) {
            const module = modules.find(mod => mod.id === id);
            module.archived = true;
            renderModules();
        }

        // Toggle Archived Modules
        function toggleArchivedModules() {
            const archivedModules = modules.filter(mod => mod.archived);
            renderModules(archivedModules);
        }

        // Search Modules
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const filteredModules = modules.filter(mod =>
                mod.name.toLowerCase().includes(searchTerm) ||
                mod.subject.toLowerCase().includes(searchTerm)
            );
            renderModules(filteredModules);
        });

        // Toggle Dark Mode
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');

            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-closed');
                sidebar.classList.toggle('sidebar-open');
            });
        });

        // Initial Render
        renderModules();
    </script>
</body>

</html>