<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects - GLPBL: Teacher's Portal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Modern Design Styles */
        body.dashboard-body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ffffff;
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
            color: #2c3e50;
        }

        .search-container {
            flex: 1;
            margin: 0 2rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: #f0f2f5;
            border-radius: 20px;
            padding: 0.5rem 1rem;
        }

        .search-box input {
            border: none;
            background: none;
            outline: none;
            flex: 1;
            font-size: 1rem;
        }

        .search-box button {
            border: none;
            background: none;
            cursor: pointer;
            color: #666;
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
            color: #2c3e50;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-menu a:hover {
            color: #3498db;
        }

        .profile-dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #ffffff;
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
            color: #2c3e50;
        }

        .dropdown-content a:hover {
            background-color: #f0f2f5;
        }

        aside.sidebar {
            width: 250px;
            background-color: #ffffff;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 60px);
            position: fixed;
            top: 60px;
            left: 0;
            padding: 1rem;
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
            color: #2c3e50;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-nav a:hover {
            color: #3498db;
        }

        .sidebar-nav a.active {
            color: #3498db;
            font-weight: bold;
        }

        main.dashboard-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .subjects-section {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .subjects-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .subjects-header h1 {
            font-size: 1.5rem;
            color: #2c3e50;
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
            background-color: #3498db;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #f0f2f5;
            color: #2c3e50;
        }

        .btn-secondary:hover {
            background-color: #e0e3e7;
        }

        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .subject-card {
            background-color: #ffffff;
            border: 1px solid #e0e3e7;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .subject-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .subject-card h3 {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .subject-card p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .subject-card .subject-code {
            font-size: 0.8rem;
            color: #3498db;
            margin-bottom: 1rem;
        }

        .subject-card .actions {
            display: flex;
            gap: 0.5rem;
        }

        .subject-card .actions button {
            padding: 0.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .subject-card .actions button.edit-btn {
            background-color: #3498db;
            color: #ffffff;
        }

        .subject-card .actions button.edit-btn:hover {
            background-color: #2980b9;
        }

        .subject-card .actions button.archive-btn {
            background-color: #f0f2f5;
            color: #2c3e50;
        }

        .subject-card .actions button.archive-btn:hover {
            background-color: #e0e3e7;
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
            background-color: #ffffff;
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
            color: #2c3e50;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .close-btn:hover {
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #e0e3e7;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
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
            color: #666;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .current-files {
            margin-top: 1rem;
        }

        .current-files ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .current-files li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e0e3e7;
        }

        .current-files li:last-child {
            border-bottom: none;
        }

        .current-files button {
            background: none;
            border: none;
            color: #e74c3c;
            cursor: pointer;
        }

        .current-files button:hover {
            color: #c0392b;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #1e1e1e;
            color: #ffffff;
        }

        body.dark-mode header {
            background-color: #2c3e50;
            color: #ffffff;
        }

        body.dark-mode .logo {
            color: #ffffff;
        }

        body.dark-mode .search-box {
            background-color: #34495e;
        }

        body.dark-mode .search-box input {
            color: #ffffff;
        }

        body.dark-mode .nav-menu a {
            color: #ffffff;
        }

        body.dark-mode .nav-menu a:hover {
            color: #3498db;
        }

        body.dark-mode aside.sidebar {
            background-color: #2c3e50;
        }

        body.dark-mode .sidebar-nav a {
            color: #ffffff;
        }

        body.dark-mode .sidebar-nav a:hover {
            color: #3498db;
        }

        body.dark-mode .subjects-section {
            background-color: #34495e;
            color: #ffffff;
        }

        body.dark-mode .subject-card {
            background-color: #2c3e50;
            border-color: #34495e;
            color: #ffffff;
        }

        body.dark-mode .subject-card h3 {
            color: #ffffff;
        }

        body.dark-mode .subject-card p {
            color: #bdc3c7;
        }

        body.dark-mode .btn-secondary {
            background-color: #34495e;
            color: #ffffff;
        }

        body.dark-mode .btn-secondary:hover {
            background-color: #2c3e50;
        }

        body.dark-mode .modal-content {
            background-color: #2c3e50;
            color: #ffffff;
        }

        body.dark-mode .form-group input,
        body.dark-mode .form-group textarea {
            background-color: #34495e;
            border-color: #34495e;
            color: #ffffff;
        }

        body.dark-mode .file-info {
            color: #bdc3c7;
        }

        body.dark-mode .current-files li {
            border-color: #34495e;
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
                <input type="text" id="searchInput" placeholder="Search subjects...">
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
        <div class="subjects-section">
            <div class="subjects-header">
                <h1>Subjects</h1>
                <div class="header-actions">
                    <button class="btn-secondary" onclick="toggleArchivedSubjects()">
                        <i class="fas fa-archive"></i> View Archived
                    </button>
                    <button class="btn-primary" onclick="openAddSubjectModal()">
                        <i class="fas fa-plus"></i> Add New Subject
                    </button>
                </div>
            </div>

            <div class="subjects-grid" id="subjectsGrid">
                <!-- Subjects will be dynamically added here -->
            </div>
        </div>
    </main>

    <!-- Add Subject Modal -->
    <div class="modal" id="addSubjectModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Subject</h2>
                <button class="close-btn" onclick="closeAddSubjectModal()">&times;</button>
            </div>
            <form id="addSubjectForm" onsubmit="handleAddSubject(event)">
                <div class="form-group">
                    <label for="subjectName">Subject Name</label>
                    <input type="text" id="subjectName" name="subjectName" required>
                </div>
                <div class="form-group">
                    <label for="subjectDescription">Description</label>
                    <textarea id="subjectDescription" name="subjectDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="subjectCode">Subject Code</label>
                    <input type="text" id="subjectCode" name="subjectCode" required>
                </div>
                <div class="form-group">
                    <label for="subjectFiles">Upload Files</label>
                    <input type="file" id="subjectFiles" name="subjectFiles" class="file-input" multiple>
                    <small class="file-info">Maximum file size: 200MB. You can select multiple files.</small>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Add Subject</button>
                    <button type="button" class="btn-secondary" onclick="closeAddSubjectModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Subject Modal -->
    <div class="modal" id="editSubjectModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Subject</h2>
                <button class="close-btn" onclick="closeEditSubjectModal()">&times;</button>
            </div>
            <form id="editSubjectForm" onsubmit="handleEditSubject(event)">
                <input type="hidden" id="editSubjectId">
                <div class="form-group">
                    <label for="editSubjectName">Subject Name</label>
                    <input type="text" id="editSubjectName" name="editSubjectName" required>
                </div>
                <div class="form-group">
                    <label for="editSubjectDescription">Description</label>
                    <textarea id="editSubjectDescription" name="editSubjectDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="editSubjectCode">Subject Code</label>
                    <input type="text" id="editSubjectCode" name="editSubjectCode" required>
                </div>
                <div class="form-group">
                    <label for="editSubjectFiles">Upload Files</label>
                    <input type="file" id="editSubjectFiles" name="editSubjectFiles" class="file-input" multiple>
                    <small class="file-info">Maximum file size: 200MB. You can select multiple files.</small>
                    <div id="currentFiles" class="current-files">
                        <!-- Existing files will be listed here -->
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Save Changes</button>
                    <button type="button" class="btn-secondary" onclick="closeEditSubjectModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');

            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-closed');
                sidebar.classList.toggle('sidebar-open');
            });
        });

        // JavaScript for Dynamic Functionality
        const subjectsGrid = document.getElementById('subjectsGrid');
        const addSubjectModal = document.getElementById('addSubjectModal');
        const editSubjectModal = document.getElementById('editSubjectModal');
        const addSubjectForm = document.getElementById('addSubjectForm');
        const editSubjectForm = document.getElementById('editSubjectForm');
        const searchInput = document.getElementById('searchInput');
        let subjects = [];

        // Sample Data
        subjects = [{
                id: 1,
                name: 'Mathematics',
                description: 'Learn about numbers and equations.',
                code: 'MATH101',
                files: [],
                archived: false
            },
            {
                id: 2,
                name: 'Science',
                description: 'Explore the natural world.',
                code: 'SCI101',
                files: [],
                archived: false
            },
        ];

        // Render Subjects
        function renderSubjects(filteredSubjects = subjects) {
            subjectsGrid.innerHTML = '';
            filteredSubjects.forEach(subject => {
                if (!subject.archived) {
                    const subjectCard = document.createElement('div');
                    subjectCard.className = 'subject-card';
                    subjectCard.innerHTML = `
                        <h3>${subject.name}</h3>
                        <p>${subject.description}</p>
                        <div class="subject-code">Code: ${subject.code}</div>
                        <div class="actions">
                            <button class="edit-btn" onclick="openEditSubjectModal(${subject.id})"><i class="fas fa-edit"></i> Edit</button>
                            <button class="archive-btn" onclick="archiveSubject(${subject.id})"><i class="fas fa-archive"></i> Archive</button>
                        </div>
                    `;
                    subjectsGrid.appendChild(subjectCard);
                }
            });
        }

        // Open Add Subject Modal
        function openAddSubjectModal() {
            addSubjectModal.style.display = 'flex';
        }

        // Close Add Subject Modal
        function closeAddSubjectModal() {
            addSubjectModal.style.display = 'none';
            addSubjectForm.reset();
        }

        // Handle Add Subject Form Submission
        function handleAddSubject(event) {
            event.preventDefault();
            const subjectName = document.getElementById('subjectName').value;
            const subjectDescription = document.getElementById('subjectDescription').value;
            const subjectCode = document.getElementById('subjectCode').value;
            const subjectFiles = document.getElementById('subjectFiles').files;

            const newSubject = {
                id: subjects.length + 1,
                name: subjectName,
                description: subjectDescription,
                code: subjectCode,
                files: Array.from(subjectFiles),
                archived: false,
            };

            subjects.push(newSubject);
            renderSubjects();
            closeAddSubjectModal();
        }

        // Open Edit Subject Modal
        function openEditSubjectModal(id) {
            const subject = subjects.find(sub => sub.id === id);
            if (subject) {
                document.getElementById('editSubjectId').value = subject.id;
                document.getElementById('editSubjectName').value = subject.name;
                document.getElementById('editSubjectDescription').value = subject.description;
                document.getElementById('editSubjectCode').value = subject.code;
                renderCurrentFiles(subject.files);
                editSubjectModal.style.display = 'flex';
            }
        }

        // Render Current Files in Edit Modal
        function renderCurrentFiles(files) {
            const currentFiles = document.getElementById('currentFiles');
            currentFiles.innerHTML = '';
            files.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.innerHTML = `
                    <span>${file.name}</span>
                    <button onclick="removeFile(${index})"><i class="fas fa-trash"></i></button>
                `;
                currentFiles.appendChild(fileItem);
            });
        }

        // Remove File in Edit Modal
        function removeFile(index) {
            const subjectId = document.getElementById('editSubjectId').value;
            const subject = subjects.find(sub => sub.id === parseInt(subjectId));
            subject.files.splice(index, 1);
            renderCurrentFiles(subject.files);
        }

        // Handle Edit Subject Form Submission
        function handleEditSubject(event) {
            event.preventDefault();
            const subjectId = document.getElementById('editSubjectId').value;
            const subjectName = document.getElementById('editSubjectName').value;
            const subjectDescription = document.getElementById('editSubjectDescription').value;
            const subjectCode = document.getElementById('editSubjectCode').value;
            const subjectFiles = document.getElementById('editSubjectFiles').files;

            const subject = subjects.find(sub => sub.id === parseInt(subjectId));
            subject.name = subjectName;
            subject.description = subjectDescription;
            subject.code = subjectCode;
            subject.files = Array.from(subjectFiles);

            renderSubjects();
            closeEditSubjectModal();
        }

        // Close Edit Subject Modal
        function closeEditSubjectModal() {
            editSubjectModal.style.display = 'none';
            editSubjectForm.reset();
        }

        // Archive Subject
        function archiveSubject(id) {
            const subject = subjects.find(sub => sub.id === id);
            subject.archived = true;
            renderSubjects();
        }

        // Toggle Archived Subjects
        function toggleArchivedSubjects() {
            const archivedSubjects = subjects.filter(sub => sub.archived);
            renderSubjects(archivedSubjects);
        }

        // Search Subjects
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const filteredSubjects = subjects.filter(sub =>
                sub.name.toLowerCase().includes(searchTerm) ||
                sub.code.toLowerCase().includes(searchTerm)
            );
            renderSubjects(filteredSubjects);
        });

        // Toggle Dark Mode
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }

        // Initial Render
        renderSubjects();
    </script>
</body>

</html>