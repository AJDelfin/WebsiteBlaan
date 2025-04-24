import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


    document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');

            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('sidebar-closed');
                sidebar.classList.toggle('sidebar-open');
            });
        });
// Dark mode functionality
function toggleDarkMode() {
    const body = document.documentElement;
    const isDarkMode = body.getAttribute('data-theme') === 'dark';
    
    if (isDarkMode) {
        body.removeAttribute('data-theme');
        localStorage.setItem('theme', 'light');
    } else {
        body.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
}

// Logout functionality
function handleLogout() {
    // Clear any stored data
    localStorage.removeItem('modules');
    localStorage.removeItem('subjects');
    // Redirect to login page
    window.location.href = 'index.html';
}

// Initialize functionality on page load
document.addEventListener('DOMContentLoaded', () => {
    // Initialize logout button if it exists
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', handleLogout);
    }

    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
    }

    // Initialize login form if on login page
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Simple authentication (for demo purposes)
            if (username === 'admin' && password === 'password123') {
                window.location.href = 'home.html';
            } else {
                alert('Invalid username or password');
            }
        });
    }

    // Initialize modules if on modules page
    if (document.getElementById('modulesGrid')) {
        loadModules();
    }

    // Initialize subjects if on subjects page
    if (document.getElementById('subjectsGrid')) {
        loadSubjects();
    }
});

// Subject Management
let subjects = JSON.parse(localStorage.getItem('subjects')) || [];
let showArchived = false;

function loadSubjects() {
    const subjectsGrid = document.getElementById('subjectsGrid');
    if (!subjectsGrid) return;

    subjectsGrid.innerHTML = '';
    subjects
        .filter(subject => showArchived ? subject.archived : !subject.archived)
        .forEach(subject => {
            const subjectCard = createSubjectCard(subject);
            subjectsGrid.appendChild(subjectCard);
        });
}

function createSubjectCard(subject) {
    const card = document.createElement('div');
    card.className = 'subject-card';
    card.innerHTML = `
        ${subject.archived ? '<span class="archived-badge">Archived</span>' : ''}
        <div class="subject-header">
            <h3>${subject.name}</h3>
            <div class="subject-actions">
                <button class="btn-icon" onclick="openEditSubjectModal('${subject.id}')">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon" onclick="toggleArchiveSubject('${subject.id}')">
                    <i class="fas ${subject.archived ? 'fa-box-open' : 'fa-archive'}"></i>
                </button>
                <button class="btn-icon" onclick="deleteSubject('${subject.id}')">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <span class="subject-code">${subject.code}</span>
        <p class="subject-description">${subject.description}</p>
    `;
    return card;
}

function toggleArchivedSubjects() {
    showArchived = !showArchived;
    loadSubjects();
}

function openAddSubjectModal() {
    const modal = document.getElementById('addSubjectModal');
    modal.style.display = 'flex';
}

function closeAddSubjectModal() {
    const modal = document.getElementById('addSubjectModal');
    modal.style.display = 'none';
    document.getElementById('addSubjectForm').reset();
}

function handleAddSubject(event) {
    event.preventDefault();
    
    const newSubject = {
        id: Date.now().toString(),
        name: document.getElementById('subjectName').value,
        description: document.getElementById('subjectDescription').value,
        code: document.getElementById('subjectCode').value,
        archived: false
    };

    subjects.push(newSubject);
    localStorage.setItem('subjects', JSON.stringify(subjects));
    loadSubjects();
    closeAddSubjectModal();
}

function openEditSubjectModal(subjectId) {
    const subject = subjects.find(s => s.id === subjectId);
    if (!subject) return;

    document.getElementById('editSubjectId').value = subject.id;
    document.getElementById('editSubjectName').value = subject.name;
    document.getElementById('editSubjectDescription').value = subject.description;
    document.getElementById('editSubjectCode').value = subject.code;

    const modal = document.getElementById('editSubjectModal');
    modal.style.display = 'flex';
}

function closeEditSubjectModal() {
    const modal = document.getElementById('editSubjectModal');
    modal.style.display = 'none';
    document.getElementById('editSubjectForm').reset();
}

function handleEditSubject(event) {
    event.preventDefault();
    
    const subjectId = document.getElementById('editSubjectId').value;
    const subjectIndex = subjects.findIndex(s => s.id === subjectId);
    
    if (subjectIndex === -1) return;

    subjects[subjectIndex] = {
        ...subjects[subjectIndex],
        name: document.getElementById('editSubjectName').value,
        description: document.getElementById('editSubjectDescription').value,
        code: document.getElementById('editSubjectCode').value
    };

    localStorage.setItem('subjects', JSON.stringify(subjects));
    loadSubjects();
    closeEditSubjectModal();
}

function toggleArchiveSubject(subjectId) {
    const subjectIndex = subjects.findIndex(s => s.id === subjectId);
    if (subjectIndex === -1) return;

    subjects[subjectIndex].archived = !subjects[subjectIndex].archived;
    localStorage.setItem('subjects', JSON.stringify(subjects));
    loadSubjects();
}

function deleteSubject(subjectId) {
    if (!confirm('Are you sure you want to delete this subject?')) return;
    
    subjects = subjects.filter(s => s.id !== subjectId);
    localStorage.setItem('subjects', JSON.stringify(subjects));
    loadSubjects();
}

// Module Management
let modules = JSON.parse(localStorage.getItem('modules')) || [];

function loadModules() {
    const modulesGrid = document.getElementById('modulesGrid');
    if (!modulesGrid) return;

    modulesGrid.innerHTML = '';
    modules.forEach(module => {
        const moduleCard = createModuleCard(module);
        modulesGrid.appendChild(moduleCard);
    });
}

function createModuleCard(module) {
    const card = document.createElement('div');
    card.className = 'module-card';
    card.innerHTML = `
        <div class="module-header">
            <h3>${module.name}</h3>
            <div class="module-actions">
                <button class="btn-icon" onclick="openEditModuleModal('${module.id}')">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon" onclick="deleteModule('${module.id}')">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <p class="module-subject">${module.subject}</p>
        <p class="module-description">${module.description}</p>
        ${module.fileName ? `
        <div class="module-file">
            <i class="fas fa-file"></i>
            <span>${module.fileName}</span>
            <small>(${formatFileSize(module.fileSize)})</small>
        </div>
        ` : ''}
    `;
    return card;
}

function formatFileSize(bytes) {
    if (!bytes) return '0 B';
    const k = 1024;
    const sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function openAddModuleModal() {
    const modal = document.getElementById('addModuleModal');
    modal.style.display = 'flex';
}

function closeAddModuleModal() {
    const modal = document.getElementById('addModuleModal');
    modal.style.display = 'none';
    document.getElementById('addModuleForm').reset();
}

function handleAddModule(event) {
    event.preventDefault();
    
    const fileInput = document.getElementById('moduleFile');
    const file = fileInput.files[0];
    
    if (file && file.size > 200 * 1024 * 1024) { // 200MB in bytes
        alert('File size exceeds 200MB limit');
        return;
    }
    
    const newModule = {
        id: Date.now().toString(),
        name: document.getElementById('moduleName').value,
        description: document.getElementById('moduleDescription').value,
        subject: document.getElementById('moduleSubject').value,
        fileName: file ? file.name : null,
        fileSize: file ? file.size : null,
        fileType: file ? file.type : null
    };

    modules.push(newModule);
    localStorage.setItem('modules', JSON.stringify(modules));
    loadModules();
    closeAddModuleModal();
}

function openEditModuleModal(moduleId) {
    const module = modules.find(m => m.id === moduleId);
    if (!module) return;

    document.getElementById('editModuleId').value = module.id;
    document.getElementById('editModuleName').value = module.name;
    document.getElementById('editModuleDescription').value = module.description;
    document.getElementById('editModuleSubject').value = module.subject;

    const modal = document.getElementById('editModuleModal');
    modal.style.display = 'flex';
}

function closeEditModuleModal() {
    const modal = document.getElementById('editModuleModal');
    modal.style.display = 'none';
    document.getElementById('editModuleForm').reset();
}

function handleEditModule(event) {
    event.preventDefault();
    
    const moduleId = document.getElementById('editModuleId').value;
    const moduleIndex = modules.findIndex(m => m.id === moduleId);
    
    if (moduleIndex === -1) return;

    const fileInput = document.getElementById('editModuleFile');
    const file = fileInput.files[0];
    
    if (file && file.size > 200 * 1024 * 1024) { // 200MB in bytes
        alert('File size exceeds 200MB limit');
        return;
    }
    
    modules[moduleIndex] = {
        id: moduleId,
        name: document.getElementById('editModuleName').value,
        description: document.getElementById('editModuleDescription').value,
        subject: document.getElementById('editModuleSubject').value,
        fileName: file ? file.name : modules[moduleIndex].fileName,
        fileSize: file ? file.size : modules[moduleIndex].fileSize,
        fileType: file ? file.type : modules[moduleIndex].fileType
    };

    localStorage.setItem('modules', JSON.stringify(modules));
    loadModules();
    closeEditModuleModal();
}

function deleteModule(moduleId) {
    if (!confirm('Are you sure you want to delete this module?')) return;
    
    modules = modules.filter(m => m.id !== moduleId);
    localStorage.setItem('modules', JSON.stringify(modules));
    loadModules();
}



const userCtx = document.getElementById('userChart').getContext('2d');
        new Chart(userCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Users',
                    data: [500, 700, 1200, 1500, 1800],
                    borderColor: 'blue',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        const lessonCtx = document.getElementById('lessonChart').getContext('2d');
        new Chart(lessonCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                datasets: [{
                    label: 'Lessons',
                    data: [30, 50, 75, 100, 120],
                    backgroundColor: 'green'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        