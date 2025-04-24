<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | School Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a5f2c;
            --primary-light: #4a8c5d;
            --secondary: #2b6e3a;
            --accent: #F59E0B;
            --background: #F9FAFB;
            --card-bg: #FFFFFF;
            --text: #1F2937;
            --text-light: #6B7280;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text);
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .announcement-card {
            background: linear-gradient(135deg, #1a5f2c, #2b6e3a, #4a8c5d);
            color: white;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #1a5f2c, #2b6e3a, #4a8c5d);
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .badge-primary {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-warning {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .badge-danger {
            background-color: #FEE2E2;
            color: #B91C1C;
        }

        /* Sidebar styles */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar-menu-item {
            transition: all 0.2s;
        }
        
        .sidebar-menu-item:hover {
            background-color: rgba(26, 95, 44, 0.1);
        }
        
        .sidebar-submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .sidebar-submenu.open {
            max-height: 500px;
        }
        
        .content-area {
            transition: all 0.3s;
            margin-left: 260px;
        }
        
        .content-area.expanded {
            margin-left: 80px;
        }
        
        .content-area.full {
            margin-left: 0;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 50;
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .content-area {
                margin-left: 0 !important;
            }
        }
        
        /* Header styles */
        .main-header {
            height: 64px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            right: 0;
            left: 260px;
            z-index: 40;
            transition: all 0.3s;
        }
        
        .main-header.expanded {
            left: 80px;
        }
        
        .main-header.full {
            left: 0;
        }
        
        @media (max-width: 768px) {
            .main-header {
                left: 0 !important;
            }
        }

        /* Data table styles */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .data-table th {
            background-color: #f3f4f6;
            text-align: left;
            padding: 12px 16px;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .data-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        
        .data-table tr:last-child td {
            border-bottom: none;
        }
        
        .data-table tr:hover td {
            background-color: #f9fafb;
        }

        /* Status indicators */
        .status-active {
            background-color: #D1FAE5;
            color: #065F46;
        }
        
        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }
        
        .status-inactive {
            background-color: #F3F4F6;
            color: #6B7280;
        }

        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        
        .modal-container {
            background-color: white;
            border-radius: 0.5rem;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .modal-content {
            padding: 1.5rem;
        }
        
        /* Rotate transition for dropdown arrows */
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: false }">
    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 sm:hidden"></div>

    <!-- Main Header -->
    <header class="main-header flex items-center px-6" id="mainHeader">
        <!-- Mobile menu button -->
        <button @click="sidebarOpen = true" class="mr-4 sm:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        
        <!-- School Logo and Name -->
        <div class="flex items-center">
            <img src="/images/MaligyaElemSchool.jpg" alt="School Logo" class="h-10 w-10 rounded-full object-cover">
            <span class="text-xl font-semibold text-gray-800 whitespace-nowrap ml-2">Maligaya Elementary School</span>
        </div>
        
        <!-- Spacer -->
        <div class="flex-1"></div>
        
        <!-- User Profile -->
        <div class="flex items-center">
            <div class="relative mr-4" x-data="{ open: false }">
                <button @click="open = !open" class="p-1 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                </button>
                
                <!-- Notification Dropdown -->
                <div x-show="open" @click.away="open = false" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                    <div class="py-1">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-900">Notifications</h3>
                        </div>
                        
                        <div class="max-h-96 overflow-y-auto">
                            <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">New teacher registration</p>
                                        <p class="text-xs text-gray-500">Maria Santos needs approval</p>
                                        <p class="text-xs text-gray-500">2 minutes ago</p>
                                    </div>
                                </div>
                            </a>
                            
                            <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">System maintenance</p>
                                        <p class="text-xs text-gray-500">Scheduled for tomorrow at 2:00 AM</p>
                                        <p class="text-xs text-gray-500">5 hours ago</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="px-4 py-2 bg-gray-50 text-center border-t border-gray-200">
                            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">See all notifications</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center focus:outline-none">
                    <img class="w-8 h-8 rounded-full" src="<?php echo e(asset('images/profile.png')); ?>" alt="User avatar">
                    <span class="ml-2 text-sm font-medium text-gray-700 hidden md:inline">Admin User</span>
                    <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <!-- Dropdown menu -->
                <div x-show="open" @click.away="open = false" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar bg-white shadow-md fixed z-50 sm:z-0" id="sidebar" :class="{ 'open': sidebarOpen }">
        <div class="flex flex-col h-full">
            <!-- Sidebar toggle aligned with header -->
            <div class="h-16 flex items-center px-4 border-b">
                <button id="toggleSidebar" class="flex items-center p-2 rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                    <span class="ml-2 text-sm font-medium text-gray-700 hidden md:inline"></span>
                </button>
            </div>

            <!-- Sidebar content -->
            <div class="flex-1 overflow-y-auto">
                <nav class="p-4">
                    <div class="space-y-1">
                        <!-- Dashboard -->
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center p-3 rounded-lg sidebar-menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap" id="dashboardText">Dashboard</span>
                        </a>

                        <!-- User Management -->
                        <div class="sidebar-menu" x-data="{ open: true }">
                            <button @click="open = !open" class="sidebar-menu-toggle flex items-center justify-between w-full p-3 rounded-lg sidebar-menu-item bg-green-50 text-green-600">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                                    </svg>
                                    <span class="ml-3 whitespace-nowrap" id="usersText">User Management</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="sidebar-submenu pl-11" :class="{ 'open': open }">
                                <a href="<?php echo e(route('admin.teacher')); ?>" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100 bg-green-50 text-green-600">Teachers</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Students</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Parents</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Add New User</a>
                            </div>
                        </div>

                        <!-- Academic Management -->
                        <div class="sidebar-menu" x-data="{ open: false }">
                            <button @click="open = !open" class="sidebar-menu-toggle flex items-center justify-between w-full p-3 rounded-lg sidebar-menu-item">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                    <span class="ml-3 whitespace-nowrap" id="academicText">Academic</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="sidebar-submenu pl-11" :class="{ 'open': open }">
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Subjects</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Classes</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Sections</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Syllabus</a>
                            </div>
                        </div>

                        <!-- Attendance -->
                        <a href="#" class="flex items-center p-3 rounded-lg sidebar-menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap" id="attendanceText">Attendance</span>
                        </a>

                        <!-- Reports -->
                        <a href="#" class="flex items-center p-3 rounded-lg sidebar-menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap" id="reportsText">Reports</span>
                        </a>

                        <!-- System Settings -->
                        <div class="sidebar-menu" x-data="{ open: false }">
                            <button @click="open = !open" class="sidebar-menu-toggle flex items-center justify-between w-full p-3 rounded-lg sidebar-menu-item">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-3 whitespace-nowrap" id="settingsText">System Settings</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="sidebar-submenu pl-11" :class="{ 'open': open }">
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">School Information</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Academic Year</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">User Roles</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="content-area pt-16">
        <!-- Teacher Management Section -->
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Teacher Management</h1>
            
            <!-- CRUD Table for Teachers -->
            <div x-data="teacherCrud">
                <!-- Add Teacher Button -->
                <button @click="openModal('teacher')" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 hover:bg-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Teacher
                </button>
                
                <!-- Teachers Table -->
                <div class="card overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="teacher in teachers" :key="teacher.id">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" :src="teacher.avatar || '/images/profile.png'" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900" x-text="teacher.name"></div>
                                                <div class="text-sm text-gray-500" x-text="teacher.department || 'No department'"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="teacher.email"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span x-text="teacher.status || 'Active'" 
                                              :class="{
                                                'bg-green-100 text-green-800': teacher.status === 'Active',
                                                'bg-yellow-100 text-yellow-800': teacher.status === 'Pending',
                                                'bg-red-100 text-red-800': teacher.status === 'Inactive'
                                              }" 
                                              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button @click="editItem('teacher', teacher)" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteItem('teacher', teacher.id)" class="text-red-600 hover:text-red-900 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button @click="assignSubjects(teacher)" class="text-green-600 hover:text-green-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Subjects Section (shown when assigning subjects) -->
            <div x-data="subjectCrud" x-show="showSubjectsSection" x-transition class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Assign Subjects to <span x-text="selectedTeacher.name" class="text-green-600"></span></h2>
                    <button @click="showSubjectsSection = false" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Teachers
                    </button>
                </div>
                
                <div class="card overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade Level</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="subject in subjects" :key="subject.id">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900" x-text="subject.name"></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="subject.code || 'N/A'"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="subject.grade_level || 'All'"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span x-text="isAssigned(subject.id) ? 'Yes' : 'No'" 
                                              :class="isAssigned(subject.id) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button 
                                            @click="toggleAssignment(subject.id)" 
                                            class="px-3 py-1 rounded-md text-sm font-medium"
                                            :class="isAssigned(subject.id) ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-green-500 text-white hover:bg-green-600'"
                                            x-text="isAssigned(subject.id) ? 'Remove' : 'Assign'">
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding/Editing Teachers -->
    <div x-data="{ 
        modalOpen: false, 
        modalType: '', 
        formData: { 
            id: null, 
            name: '', 
            email: '', 
            department: '',
            status: 'Active'
        },
        errors: {}
    }" 
    x-show="modalOpen" 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="px-6 py-4 border-b">
                <h3 class="text-xl font-bold text-gray-800" x-text="modalType === 'teacher' ? (formData.id ? 'Edit Teacher' : 'Add Teacher') : ''"></h3>
            </div>
            <form @submit.prevent="submitForm">
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" x-model="formData.name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <p x-show="errors.name" x-text="errors.name" class="mt-1 text-sm text-red-600"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" x-model="formData.email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <p x-show="errors.email" x-text="errors.email" class="mt-1 text-sm text-red-600"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <input type="text" x-model="formData.department" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select x-model="formData.status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="Active">Active</option>
                            <option value="Pending">Pending</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="px-6 py-4 border-t flex justify-end space-x-3">
                    <button type="button" @click="modalOpen = false; errors = {}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            // Teacher CRUD functionality
            Alpine.data('teacherCrud', () => ({
                teachers: [
                    { id: 1, name: 'Juan Dela Cruz', email: 'juan.delacruz@example.com', department: 'Mathematics', status: 'Active', avatar: 'https://randomuser.me/api/portraits/men/32.jpg' },
                    { id: 2, name: 'Maria Santos', email: 'maria.santos@example.com', department: 'Science', status: 'Active', avatar: 'https://randomuser.me/api/portraits/women/44.jpg' },
                    { id: 3, name: 'Pedro Reyes', email: 'pedro.reyes@example.com', department: 'English', status: 'Pending', avatar: 'https://randomuser.me/api/portraits/men/22.jpg' },
                    { id: 4, name: 'Ana Lopez', email: 'ana.lopez@example.com', department: 'Filipino', status: 'Inactive', avatar: 'https://randomuser.me/api/portraits/women/63.jpg' }
                ],
                showSubjectsSection: false,
                selectedTeacher: null,
                assignedSubjects: [],

                init() {
                    // Load state from localStorage if available
                    if (localStorage.getItem('teacherCrudState')) {
                        const savedState = JSON.parse(localStorage.getItem('teacherCrudState'));
                        this.showSubjectsSection = savedState.showSubjectsSection;
                        this.selectedTeacher = savedState.selectedTeacher;
                    }
                },

                saveState() {
                    localStorage.setItem('teacherCrudState', JSON.stringify({
                        showSubjectsSection: this.showSubjectsSection,
                        selectedTeacher: this.selectedTeacher
                    }));
                },

                openModal(type) {
                    this.$dispatch('open-modal', { type });
                },

                editItem(type, item) {
                    this.$dispatch('edit-item', { type, item });
                },

                deleteItem(type, id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.teachers = this.teachers.filter(teacher => teacher.id !== id);
                            Swal.fire(
                                'Deleted!',
                                'The teacher has been removed.',
                                'success'
                            );
                        }
                    });
                },

                assignSubjects(teacher) {
                    this.selectedTeacher = teacher;
                    this.showSubjectsSection = true;
                    this.fetchAssignedSubjects(teacher.id);
                    this.saveState();
                },

                fetchAssignedSubjects(teacherId) {
                    // Simulate API call
                    setTimeout(() => {
                        this.assignedSubjects = [
                            { id: 1, name: 'Mathematics', code: 'MATH101', grade_level: 'Grade 1' },
                            { id: 3, name: 'English', code: 'ENG101', grade_level: 'Grade 2' }
                        ];
                    }, 300);
                }
            }));

            // Subject assignment functionality
            Alpine.data('subjectCrud', () => ({
                subjects: [
                    { id: 1, name: 'Mathematics', code: 'MATH101', grade_level: 'Grade 1' },
                    { id: 2, name: 'Science', code: 'SCI101', grade_level: 'Grade 1' },
                    { id: 3, name: 'English', code: 'ENG101', grade_level: 'Grade 2' },
                    { id: 4, name: 'Filipino', code: 'FIL101', grade_level: 'Grade 2' },
                    { id: 5, name: 'Araling Panlipunan', code: 'AP101', grade_level: 'Grade 3' },
                    { id: 6, name: 'MAPEH', code: 'MAP101', grade_level: 'Grade 3' }
                ],
                assignedSubjects: [],

                init() {
                    // Listen for teacher selection event
                    this.$watch('selectedTeacher', (teacher) => {
                        if (teacher) {
                            this.fetchAssignedSubjects(teacher.id);
                        }
                    });
                },

                isAssigned(subjectId) {
                    return this.assignedSubjects.some(s => s.id === subjectId);
                },

                toggleAssignment(subjectId) {
                    const isAssigned = this.isAssigned(subjectId);
                    
                    if (isAssigned) {
                        this.assignedSubjects = this.assignedSubjects.filter(s => s.id !== subjectId);
                        Swal.fire('Removed!', 'Subject has been unassigned.', 'success');
                    } else {
                        const subject = this.subjects.find(s => s.id === subjectId);
                        this.assignedSubjects.push(subject);
                        Swal.fire('Assigned!', 'Subject has been assigned to teacher.', 'success');
                    }
                },

                fetchAssignedSubjects(teacherId) {
                    // Simulate API call
                    setTimeout(() => {
                        this.assignedSubjects = [
                            { id: 1, name: 'Mathematics', code: 'MATH101', grade_level: 'Grade 1' },
                            { id: 3, name: 'English', code: 'ENG101', grade_level: 'Grade 2' }
                        ];
                    }, 300);
                }
            }));

            // Modal handling
            Alpine.data('modalHandler', () => ({
                modalOpen: false,
                modalType: '',
                formData: { 
                    id: null, 
                    name: '', 
                    email: '', 
                    department: '',
                    status: 'Active'
                },
                errors: {},

                init() {
                    // Listen for open modal event
                    this.$el.addEventListener('open-modal', (e) => {
                        this.modalType = e.detail.type;
                        this.formData = { 
                            id: null, 
                            name: '', 
                            email: '', 
                            department: '',
                            status: 'Active'
                        };
                        this.errors = {};
                        this.modalOpen = true;
                    });

                    // Listen for edit item event
                    this.$el.addEventListener('edit-item', (e) => {
                        if (e.detail.type === 'teacher') {
                            this.modalType = e.detail.type;
                            this.formData = { ...e.detail.item };
                            this.errors = {};
                            this.modalOpen = true;
                        }
                    });
                },

                submitForm() {
                    // Simple validation
                    this.errors = {};
                    if (!this.formData.name) {
                        this.errors.name = 'Name is required';
                    }
                    if (!this.formData.email) {
                        this.errors.email = 'Email is required';
                    } else if (!this.formData.email.includes('@')) {
                        this.errors.email = 'Email must be valid';
                    }

                    if (Object.keys(this.errors).length > 0) {
                        return;
                    }

                    // Simulate form submission
                    if (this.formData.id) {
                        // Update existing teacher
                        const index = Alpine.store('teachers').findIndex(t => t.id === this.formData.id);
                        if (index !== -1) {
                            Alpine.store('teachers')[index] = { ...this.formData };
                        }
                        Swal.fire('Updated!', 'Teacher has been updated.', 'success');
                    } else {
                        // Add new teacher
                        const newId = Math.max(...Alpine.store('teachers').map(t => t.id)) + 1;
                        Alpine.store('teachers').push({
                            ...this.formData,
                            id: newId,
                            avatar: `https://randomuser.me/api/portraits/${Math.random() > 0.5 ? 'men' : 'women'}/${Math.floor(Math.random() * 100)}.jpg`
                        });
                        Swal.fire('Added!', 'New teacher has been added.', 'success');
                    }

                    this.modalOpen = false;
                }
            }));
        });

        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleSidebar = document.getElementById('toggleSidebar');
            const contentArea = document.querySelector('.content-area');
            const mainHeader = document.getElementById('mainHeader');
            
            // Check if sidebar is collapsed in localStorage
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                contentArea.classList.add('expanded');
                mainHeader.classList.add('expanded');
            }

            // Toggle sidebar collapse/expand
            if (toggleSidebar) {
                toggleSidebar.addEventListener('click', () => {
                    sidebar.classList.toggle('collapsed');
                    contentArea.classList.toggle('expanded');
                    mainHeader.classList.toggle('expanded');
                    
                    // Save state to localStorage
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                    
                    // Update text visibility
                    const textElements = [
                        'dashboardText', 'usersText', 'academicText', 
                        'attendanceText', 'reportsText', 'settingsText'
                    ];
                    
                    textElements.forEach(id => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.classList.toggle('hidden');
                        }
                    });
                });
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Blaan_Multi_Role\resources\views/admin/teacher.blade.php ENDPATH**/ ?>