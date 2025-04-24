<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades | GLPBL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
        
        .badge-archived {
            background-color: #f3f4f6;
            color: #6b7280;
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
        
        /* Grade level colors */
        .grade-1 { background-color: #FEF3C7; color: #92400E; }
        .grade-2 { background-color: #D1FAE5; color: #065F46; }
        .grade-3 { background-color: #DBEAFE; color: #1E40AF; }
        .grade-4 { background-color: #E9D5FF; color: #6B21A8; }
        .grade-5 { background-color: #FECACA; color: #991B1B; }
        .grade-6 { background-color: #FDE68A; color: #92400E; }
        
        /* Grade colors */
        .grade-A { background-color: #D1FAE5; color: #065F46; }
        .grade-B { background-color: #D1FAE5; color: #065F46; }
        .grade-C { background-color: #FEF3C7; color: #92400E; }
        .grade-D { background-color: #FECACA; color: #991B1B; }
        .grade-F { background-color: #FECACA; color: #991B1B; }
        
        /* Status colors */
        .status-completed {
            color: #10b981;
        }
        
        .status-pending {
            color: #f59e0b;
        }
        
        .status-not-started {
            color: #6b7280;
        }
        
        /* Grade input styling */
        .grade-input {
            width: 60px;
            text-align: center;
            padding: 0.25rem 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
        }
        
        .grade-input:focus {
            outline: none;
            border-color: #1a5f2c;
            box-shadow: 0 0 0 2px rgba(26, 95, 44, 0.2);
        }
        
        /* Tab styles */
        .tab-container {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }
        
        .tab {
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            font-weight: 500;
            color: #6b7280;
        }
        
        .tab.active {
            color: #1a5f2c;
            border-bottom-color: #1a5f2c;
        }
        
        /* Student grade row hover */
        .student-row:hover {
            background-color: #f0fdf4;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Mobile sidebar backdrop -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 sm:hidden hidden" id="sidebarBackdrop"></div>

    <!-- Sidebar -->
    <aside class="sidebar bg-white shadow-md fixed z-50 sm:z-0" id="sidebar">
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
                        <a href="<?php echo e(route('teacher.dashboard')); ?>" class="flex items-center p-3 rounded-lg sidebar-menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap" id="dashboardText">Dashboard</span>
                        </a>

                        <!-- Subject dropdown -->
                        <div class="sidebar-menu">
                            <button class="sidebar-menu-toggle flex items-center justify-between w-full p-3 rounded-lg sidebar-menu-item">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                    </svg>
                                    <span class="ml-3 whitespace-nowrap" id="coursesText">Subject</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="sidebar-submenu pl-11">
                                <a href="<?php echo e(route('mycourses')); ?>" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">My Courses</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100" id="createCourseBtn">Create New</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100" id="viewArchivedBtn">Archived Courses</a>
                            </div>
                        </div>

                        <!-- Students -->
                        <div class="sidebar-menu">
                            <button class="sidebar-menu-toggle flex items-center justify-between w-full p-3 rounded-lg sidebar-menu-item">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                                    </svg>
                                    <span class="ml-3 whitespace-nowrap" id="studentsText">Students</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="sidebar-submenu pl-11">
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">All Students</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Groups</a>
                                <a href="#" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">Progress</a>
                            </div>
                        </div>

                        <!-- Assignments -->
                        <a href="#" class="flex items-center p-3 rounded-lg sidebar-menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap" id="assignmentsText">Assignments</span>
                        </a>

                        <!-- Grades -->
                        <a href="<?php echo e(route('teacher.grades')); ?>" class="flex items-center p-3 rounded-lg sidebar-menu-item bg-green-50 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap" id="gradesText">Grades</span>
                        </a>

                        <!-- Messages -->
                        <a href="#" class="flex items-center p-3 rounded-lg sidebar-menu-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 whitespace-nowrap" id="messagesText">Messages</span>
                            <span class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">5</span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <div class="content-area">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button id="mobileMenuButton" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Center content -->
                    <div class="flex items-center justify-center flex-1 sm:justify-start">
                        <div class="flex-shrink-0 flex items-center sm:hidden">
                            <img src="/images/MaligyaElemSchool.jpg" alt="School Logo" class="h-8 w-8 rounded-full object-cover">
                            <span class="text-xl font-semibold text-gray-800 ml-2">Maligaya ES</span>
                        </div>
                    </div>

                    <!-- Right content -->
                    <div class="flex items-center">
                        <!-- Notification Bell Button -->
                        <div class="relative mr-4">
                            <button id="notificationDropdownButton" class="p-1 rounded-full hover:bg-gray-100 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                            </button>

                            <!-- Notification Dropdown -->
                            <div id="notificationDropdown" class="hidden origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                <div class="py-1">
                                    <div class="px-4 py-2 border-b border-gray-200">
                                        <h3 class="text-sm font-medium text-gray-900">Notifications</h3>
                                    </div>
                                    
                                    <div class="max-h-96 overflow-y-auto">
                                        <!-- Notification items would be dynamically inserted here -->
                                    </div>
                                    
                                    <div class="px-4 py-2 bg-gray-50 text-center border-t border-gray-200">
                                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">See all</a>
                                        <span class="mx-2 text-gray-400">|</span>
                                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Mark all read</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="ml-3 relative">
                            <div>
                                <button id="userMenuButton" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="<?php echo e(asset('images/profile.png')); ?>" alt="User menu">
                                    <span class="hidden md:inline ml-2 text-sm font-medium text-gray-700"><?php echo e(Auth::guard('teacher')->user()->name); ?></span>
                                    <svg class="ml-1 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Profile Dropdown Menu -->
                            <div id="userMenu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                <form method="POST" action="<?php echo e(route('teacher.logout')); ?>" class="w-full">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Grades content -->
        <div class="p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Page Header -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Student Grades</h1>
                        <p class="text-gray-600 mt-2">View and manage student grades for Blaan Language courses</p>
                    </div>
                    <div class="flex space-x-3">
                        <button id="exportGradesBtn" class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg text-sm hover:bg-gray-50 transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            Export
                        </button>
                        <button id="printGradesBtn" class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg text-sm hover:bg-gray-50 transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                            Print
                        </button>
                    </div>
                </div>
                
                <!-- Filter Controls -->
                <div class="card p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="gradeLevelFilter" class="block text-sm font-medium text-gray-700 mb-1">Grade Level</label>
                            <select id="gradeLevelFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="">All Grades</option>
                                <option value="1">Grade 1</option>
                                <option value="2">Grade 2</option>
                                <option value="3">Grade 3</option>
                                <option value="4">Grade 4</option>
                                <option value="5">Grade 5</option>
                                <option value="6">Grade 6</option>
                            </select>
                        </div>
                        <div>
                            <label for="sectionFilter" class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                            <select id="sectionFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="">All Sections</option>
                                <option value="A">Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                            </select>
                        </div>
                        <div>
                            <label for="gradingPeriodFilter" class="block text-sm font-medium text-gray-700 mb-1">Grading Period</label>
                            <select id="gradingPeriodFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="">All Periods</option>
                                <option value="1st">1st Grading</option>
                                <option value="2nd">2nd Grading</option>
                                <option value="3rd">3rd Grading</option>
                                <option value="4th">4th Grading</option>
                            </select>
                        </div>
                        <div>
                            <label for="searchStudent" class="block text-sm font-medium text-gray-700 mb-1">Search Student</label>
                            <div class="relative">
                                <input type="text" id="searchStudent" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" placeholder="Student name or ID">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Grades Table -->
                <div class="card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade Level</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">1st Grading</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">2nd Grading</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">3rd Grading</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">4th Grading</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Final Grade</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="gradesTableBody">
                                <!-- Student grades will be dynamically inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Grade Summary -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                    <div class="card p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Passed Students</p>
                                <p class="text-2xl font-bold">24</p>
                            </div>
                        </div>
                    </div>
                    <div class="card p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Conditional</p>
                                <p class="text-2xl font-bold">3</p>
                            </div>
                        </div>
                    </div>
                    <div class="card p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Failed Students</p>
                                <p class="text-2xl font-bold">1</p>
                            </div>
                        </div>
                    </div>
                    <div class="card p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Students</p>
                                <p class="text-2xl font-bold">28</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grade Edit Modal -->
    <div id="gradeEditModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 id="gradeEditTitle" class="text-xl font-bold text-gray-900">Edit Grades</h3>
                <button id="closeGradeEdit" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="mt-4">
                <form id="gradeEditForm">
                    <input type="hidden" id="editStudentId">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Student</label>
                        <p id="editStudentName" class="font-medium"></p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Grade Level</label>
                            <p id="editGradeLevel" class="text-gray-600"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                            <p id="editSection" class="text-gray-600"></p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="grid grid-cols-5 gap-2 items-center">
                            <label class="block text-sm font-medium text-gray-700">1st Grading</label>
                            <input type="number" id="editFirstGrading" min="0" max="100" class="grade-input">
                            <span class="text-sm text-gray-500">Equivalent:</span>
                            <span id="editFirstEquivalent" class="badge">-</span>
                            <span id="editFirstRemarks" class="text-sm">-</span>
                        </div>
                        
                        <div class="grid grid-cols-5 gap-2 items-center">
                            <label class="block text-sm font-medium text-gray-700">2nd Grading</label>
                            <input type="number" id="editSecondGrading" min="0" max="100" class="grade-input">
                            <span class="text-sm text-gray-500">Equivalent:</span>
                            <span id="editSecondEquivalent" class="badge">-</span>
                            <span id="editSecondRemarks" class="text-sm">-</span>
                        </div>
                        
                        <div class="grid grid-cols-5 gap-2 items-center">
                            <label class="block text-sm font-medium text-gray-700">3rd Grading</label>
                            <input type="number" id="editThirdGrading" min="0" max="100" class="grade-input">
                            <span class="text-sm text-gray-500">Equivalent:</span>
                            <span id="editThirdEquivalent" class="badge">-</span>
                            <span id="editThirdRemarks" class="text-sm">-</span>
                        </div>
                        
                        <div class="grid grid-cols-5 gap-2 items-center">
                            <label class="block text-sm font-medium text-gray-700">4th Grading</label>
                            <input type="number" id="editFourthGrading" min="0" max="100" class="grade-input">
                            <span class="text-sm text-gray-500">Equivalent:</span>
                            <span id="editFourthEquivalent" class="badge">-</span>
                            <span id="editFourthRemarks" class="text-sm">-</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t">
                        <div class="grid grid-cols-5 gap-2 items-center">
                            <label class="block text-sm font-medium text-gray-700">Final Grade</label>
                            <input type="number" id="editFinalGrade" min="0" max="100" class="grade-input" readonly>
                            <span class="text-sm text-gray-500">Equivalent:</span>
                            <span id="editFinalEquivalent" class="badge">-</span>
                            <span id="editFinalRemarks" class="text-sm font-medium">-</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-6 border-t">
                        <button type="button" id="cancelGradeEdit" class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg text-sm hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg text-sm hover:bg-green-700">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Sidebar functionality
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');
        const contentArea = document.querySelector('.content-area');
        const menuToggles = document.querySelectorAll('.sidebar-menu-toggle');
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenu = document.getElementById('userMenu');
        
        // Modal elements
        const gradeEditModal = document.getElementById('gradeEditModal');
        const closeGradeEdit = document.getElementById('closeGradeEdit');
        const cancelGradeEdit = document.getElementById('cancelGradeEdit');
        
        // Sample data for students and grades
        const students = [
            {
                id: 1,
                name: "Juan Dela Cruz",
                gradeLevel: 1,
                section: "A",
                grades: {
                    first: 89,
                    second: 92,
                    third: 85,
                    fourth: 90
                }
            },
            {
                id: 2,
                name: "Maria Santos",
                gradeLevel: 1,
                section: "A",
                grades: {
                    first: 92,
                    second: 94,
                    third: 91,
                    fourth: 93
                }
            },
            {
                id: 3,
                name: "Pedro Reyes",
                gradeLevel: 2,
                section: "B",
                grades: {
                    first: 78,
                    second: 82,
                    third: 85,
                    fourth: 80
                }
            },
            {
                id: 4,
                name: "Ana Lopez",
                gradeLevel: 2,
                section: "B",
                grades: {
                    first: 85,
                    second: 88,
                    third: 90,
                    fourth: 87
                }
            },
            {
                id: 5,
                name: "Luis Garcia",
                gradeLevel: 3,
                section: "C",
                grades: {
                    first: 92,
                    second: 90,
                    third: 94,
                    fourth: 93
                }
            },
            {
                id: 6,
                name: "Elena Martinez",
                gradeLevel: 3,
                section: "C",
                grades: {
                    first: 75,
                    second: 78,
                    third: 72,
                    fourth: 74
                }
            },
            {
                id: 7,
                name: "Carlos Hernandez",
                gradeLevel: 4,
                section: "A",
                grades: {
                    first: 88,
                    second: 90,
                    third: 92,
                    fourth: 91
                }
            },
            {
                id: 8,
                name: "Sofia Torres",
                gradeLevel: 4,
                section: "A",
                grades: {
                    first: 82,
                    second: 85,
                    third: 88,
                    fourth: 86
                }
            },
            {
                id: 9,
                name: "Miguel Ramos",
                gradeLevel: 5,
                section: "B",
                grades: {
                    first: 94,
                    second: 95,
                    third: 93,
                    fourth: 96
                }
            },
            {
                id: 10,
                name: "Isabel Flores",
                gradeLevel: 5,
                section: "B",
                grades: {
                    first: 79,
                    second: 82,
                    third: 85,
                    fourth: 80
                }
            },
            {
                id: 11,
                name: "Jose Gonzales",
                gradeLevel: 6,
                section: "C",
                grades: {
                    first: 87,
                    second: 89,
                    third: 91,
                    fourth: 90
                }
            },
            {
                id: 12,
                name: "Carmen Reyes",
                gradeLevel: 6,
                section: "C",
                grades: {
                    first: 68,
                    second: 72,
                    third: 75,
                    fourth: 70
                }
            }
        ];
        
        // Current student being edited
        let currentStudent = null;
        
        // Initialize the page
        renderGradesTable();
        
        // Toggle sidebar collapse/expand
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            contentArea.classList.toggle('expanded');
            
            // Update text visibility
            const textElements = [
                'logoText', 'dashboardText', 'coursesText', 'studentsText', 
                'assignmentsText', 'gradesText', 'messagesText', 'settingsText', 'userInfo'
            ];
            
            textElements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.classList.toggle('hidden');
                }
            });
        });
        
        // Toggle mobile menu
        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarBackdrop.classList.toggle('hidden');
        });
        
        // Close mobile menu when clicking backdrop
        sidebarBackdrop.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebarBackdrop.classList.add('hidden');
        });
        
        // Toggle dropdown menus
        menuToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const menu = toggle.nextElementSibling;
                const icon = toggle.querySelector('svg:last-child');
                
                menu.classList.toggle('open');
                icon.classList.toggle('rotate-180');
            });
        });
        
        // Toggle user menu
        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });
        
        // Close user menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
        
        // Close Grade Edit Modal
        closeGradeEdit.addEventListener('click', () => {
            gradeEditModal.classList.add('hidden');
        });
        
        // Cancel Grade Edit
        cancelGradeEdit.addEventListener('click', () => {
            gradeEditModal.classList.add('hidden');
        });
        
        // Export Grades Button
        document.getElementById('exportGradesBtn').addEventListener('click', () => {
            Swal.fire({
                title: 'Export Grades',
                text: 'Choose the format to export the grades:',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Excel (.xlsx)',
                denyButtonText: 'PDF (.pdf)',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Exported!', 'Grades have been exported to Excel format.', 'success');
                } else if (result.isDenied) {
                    Swal.fire('Exported!', 'Grades have been exported to PDF format.', 'success');
                }
            });
        });
        
        // Print Grades Button
        document.getElementById('printGradesBtn').addEventListener('click', () => {
            window.print();
        });
        
        // Filter functionality
        document.getElementById('gradeLevelFilter').addEventListener('change', filterGrades);
        document.getElementById('sectionFilter').addEventListener('change', filterGrades);
        document.getElementById('gradingPeriodFilter').addEventListener('change', filterGrades);
        document.getElementById('searchStudent').addEventListener('input', filterGrades);
        
        // Grade Edit Form Submission
        document.getElementById('gradeEditForm').addEventListener('submit', (e) => {
            e.preventDefault();
            saveGradeChanges();
        });
        
        // Grade input change handlers
        document.getElementById('editFirstGrading').addEventListener('change', updateGradeEquivalents);
        document.getElementById('editSecondGrading').addEventListener('change', updateGradeEquivalents);
        document.getElementById('editThirdGrading').addEventListener('change', updateGradeEquivalents);
        document.getElementById('editFourthGrading').addEventListener('change', updateGradeEquivalents);
        
        // Function to render grades table
        function renderGradesTable(filteredStudents = students) {
            const gradesTableBody = document.getElementById('gradesTableBody');
            gradesTableBody.innerHTML = '';
            
            if (filteredStudents.length === 0) {
                gradesTableBody.innerHTML = `
                    <tr>
                        <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                            No students found matching the selected filters.
                        </td>
                    </tr>
                `;
                return;
            }
            
            filteredStudents.forEach(student => {
                const firstGrade = student.grades.first;
                const secondGrade = student.grades.second;
                const thirdGrade = student.grades.third;
                const fourthGrade = student.grades.fourth;
                
                // Calculate final grade (average of all grading periods)
                const finalGrade = Math.round((firstGrade + secondGrade + thirdGrade + fourthGrade) / 4);
                
                // Get equivalent and remarks for each grading period
                const firstEquivalent = getGradeEquivalent(firstGrade);
                const secondEquivalent = getGradeEquivalent(secondGrade);
                const thirdEquivalent = getGradeEquivalent(thirdGrade);
                const fourthEquivalent = getGradeEquivalent(fourthGrade);
                const finalEquivalent = getGradeEquivalent(finalGrade);
                
                // Get remarks for final grade
                const finalRemarks = getGradeRemarks(finalGrade);
                
                const row = document.createElement('tr');
                row.className = 'student-row hover:bg-gray-50';
                row.setAttribute('data-student-id', student.id);
                
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=${encodeURIComponent(student.name)}&background=random" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">${student.name}</div>
                                <div class="text-sm text-gray-500">ID: ${student.id.toString().padStart(4, '0')}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="badge grade-${student.gradeLevel}">Grade ${student.gradeLevel}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${student.section}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="grade-badge ${getGradeClass(firstGrade)}">${firstGrade}</span>
                        <span class="text-xs text-gray-500 ml-1">${firstEquivalent}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="grade-badge ${getGradeClass(secondGrade)}">${secondGrade}</span>
                        <span class="text-xs text-gray-500 ml-1">${secondEquivalent}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="grade-badge ${getGradeClass(thirdGrade)}">${thirdGrade}</span>
                        <span class="text-xs text-gray-500 ml-1">${thirdEquivalent}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="grade-badge ${getGradeClass(fourthGrade)}">${fourthGrade}</span>
                        <span class="text-xs text-gray-500 ml-1">${fourthEquivalent}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="grade-badge ${getGradeClass(finalGrade)}">${finalGrade}</span>
                        <span class="text-xs text-gray-500 ml-1">${finalEquivalent}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="${finalRemarks === 'Passed' ? 'text-green-600' : finalRemarks === 'Conditional' ? 'text-yellow-600' : 'text-red-600'}">${finalRemarks}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-grade-btn text-green-600 hover:text-green-900">Edit</button>
                    </td>
                `;
                
                gradesTableBody.appendChild(row);
            });
            
            // Attach event listeners to edit buttons
            document.querySelectorAll('.edit-grade-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const studentId = parseInt(e.target.closest('tr').getAttribute('data-student-id'));
                    editStudentGrade(studentId);
                });
            });
        }
        
        // Function to filter grades
        function filterGrades() {
            const gradeLevel = document.getElementById('gradeLevelFilter').value;
            const section = document.getElementById('sectionFilter').value;
            const gradingPeriod = document.getElementById('gradingPeriodFilter').value;
            const searchQuery = document.getElementById('searchStudent').value.toLowerCase();
            
            let filteredStudents = students;
            
            if (gradeLevel) {
                filteredStudents = filteredStudents.filter(student => student.gradeLevel == gradeLevel);
            }
            
            if (section) {
                filteredStudents = filteredStudents.filter(student => student.section === section);
            }
            
            if (searchQuery) {
                filteredStudents = filteredStudents.filter(student => 
                    student.name.toLowerCase().includes(searchQuery) || 
                    student.id.toString().includes(searchQuery)
                );
            }
            
            // Filter by grading period if needed (this is a simplified example)
            if (gradingPeriod) {
                // In a real app, you might filter based on the selected grading period
                // For now, we'll just highlight the relevant column
                document.querySelectorAll('th, td').forEach(el => {
                    el.classList.remove('bg-green-50');
                });
                
                if (gradingPeriod === '1st') {
                    document.querySelectorAll('th:nth-child(4), td:nth-child(4)').forEach(el => {
                        el.classList.add('bg-green-50');
                    });
                } else if (gradingPeriod === '2nd') {
                    document.querySelectorAll('th:nth-child(5), td:nth-child(5)').forEach(el => {
                        el.classList.add('bg-green-50');
                    });
                } else if (gradingPeriod === '3rd') {
                    document.querySelectorAll('th:nth-child(6), td:nth-child(6)').forEach(el => {
                        el.classList.add('bg-green-50');
                    });
                } else if (gradingPeriod === '4th') {
                    document.querySelectorAll('th:nth-child(7), td:nth-child(7)').forEach(el => {
                        el.classList.add('bg-green-50');
                    });
                }
            }
            
            renderGradesTable(filteredStudents);
        }
        
        // Function to edit student grade
        function editStudentGrade(studentId) {
            currentStudent = students.find(student => student.id === studentId);
            
            if (currentStudent) {
                // Update modal content
                document.getElementById('editStudentId').value = currentStudent.id;
                document.getElementById('editStudentName').textContent = currentStudent.name;
                document.getElementById('editGradeLevel').textContent = `Grade ${currentStudent.gradeLevel}`;
                document.getElementById('editSection').textContent = currentStudent.section;
                
                // Set grade values
                document.getElementById('editFirstGrading').value = currentStudent.grades.first;
                document.getElementById('editSecondGrading').value = currentStudent.grades.second;
                document.getElementById('editThirdGrading').value = currentStudent.grades.third;
                document.getElementById('editFourthGrading').value = currentStudent.grades.fourth;
                
                // Update equivalents and remarks
                updateGradeEquivalents();
                
                // Show the modal
                gradeEditModal.classList.remove('hidden');
            }
        }
        
        // Function to update grade equivalents when grades change
        function updateGradeEquivalents() {
            const firstGrade = parseInt(document.getElementById('editFirstGrading').value) || 0;
            const secondGrade = parseInt(document.getElementById('editSecondGrading').value) || 0;
            const thirdGrade = parseInt(document.getElementById('editThirdGrading').value) || 0;
            const fourthGrade = parseInt(document.getElementById('editFourthGrading').value) || 0;
            
            // Calculate final grade
            const finalGrade = Math.round((firstGrade + secondGrade + thirdGrade + fourthGrade) / 4);
            document.getElementById('editFinalGrade').value = finalGrade;
            
            // Update equivalents and remarks for each grading period
            updateGradeDisplay('First', firstGrade);
            updateGradeDisplay('Second', secondGrade);
            updateGradeDisplay('Third', thirdGrade);
            updateGradeDisplay('Fourth', fourthGrade);
            updateGradeDisplay('Final', finalGrade);
        }
        
        // Function to update grade display (equivalent and remarks)
        function updateGradeDisplay(period, grade) {
            const equivalent = getGradeEquivalent(grade);
            const remarks = getGradeRemarks(grade);
            
            document.getElementById(`edit${period}Equivalent`).textContent = equivalent;
            document.getElementById(`edit${period}Equivalent`).className = `badge ${getGradeClass(grade)}`;
            document.getElementById(`edit${period}Remarks`).textContent = remarks;
            document.getElementById(`edit${period}Remarks`).className = `text-sm ${remarks === 'Passed' ? 'text-green-600' : remarks === 'Conditional' ? 'text-yellow-600' : 'text-red-600'}`;
        }
        
        // Function to get grade equivalent (A, B, C, D, F)
        function getGradeEquivalent(grade) {
            if (grade >= 90) return 'A';
            if (grade >= 80) return 'B';
            if (grade >= 75) return 'C';
            if (grade >= 70) return 'D';
            return 'F';
        }
        
        // Function to get grade remarks
        function getGradeRemarks(grade) {
            if (grade >= 75) return 'Passed';
            if (grade >= 70) return 'Conditional';
            return 'Failed';
        }
        
        // Function to get grade badge class
        function getGradeClass(grade) {
            const equivalent = getGradeEquivalent(grade);
            return `grade-${equivalent}`;
        }
        
        // Function to save grade changes
        function saveGradeChanges() {
            const studentId = parseInt(document.getElementById('editStudentId').value);
            const firstGrade = parseInt(document.getElementById('editFirstGrading').value) || 0;
            const secondGrade = parseInt(document.getElementById('editSecondGrading').value) || 0;
            const thirdGrade = parseInt(document.getElementById('editThirdGrading').value) || 0;
            const fourthGrade = parseInt(document.getElementById('editFourthGrading').value) || 0;
            
            // Validate grades
            if (firstGrade < 0 || firstGrade > 100 || 
                secondGrade < 0 || secondGrade > 100 || 
                thirdGrade < 0 || thirdGrade > 100 || 
                fourthGrade < 0 || fourthGrade > 100) {
                Swal.fire('Error', 'Grades must be between 0 and 100', 'error');
                return;
            }
            
            // Update student grades
            const studentIndex = students.findIndex(student => student.id === studentId);
            if (studentIndex !== -1) {
                students[studentIndex].grades = {
                    first: firstGrade,
                    second: secondGrade,
                    third: thirdGrade,
                    fourth: fourthGrade
                };
                
                // Re-render the table
                renderGradesTable();
                
                // Close the modal
                gradeEditModal.classList.add('hidden');
                
                Swal.fire('Updated!', 'Grades have been updated successfully.', 'success');
            }
        }
    });

    // Toggle notification dropdown
    const notificationButton = document.getElementById('notificationDropdownButton');
    const notificationDropdown = document.getElementById('notificationDropdown');
    const userMenuButton = document.getElementById('userMenuButton');
    const userMenu = document.getElementById('userMenu');

    notificationButton?.addEventListener('click', (e) => {
        e.stopPropagation();
        notificationDropdown.classList.toggle('hidden');
        userMenu.classList.add('hidden'); // Close profile menu if open
    });

    userMenuButton?.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenu.classList.toggle('hidden');
        notificationDropdown.classList.add('hidden'); // Close notification menu if open
    });

    // Close menus when clicking outside
    document.addEventListener('click', (e) => {
        if (!notificationButton?.contains(e.target) && !notificationDropdown?.contains(e.target)) {
            notificationDropdown.classList.add('hidden');
        }
        if (!userMenuButton?.contains(e.target) && !userMenu?.contains(e.target)) {
            userMenu.classList.add('hidden');
        }
    });

    // Close menus when pressing Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            notificationDropdown.classList.add('hidden');
            userMenu.classList.add('hidden');
        }
    });
</script>
</body>
</html><?php /**PATH F:\xampp\htdocs\Blaan_Multi_Role\resources\views/teacher/grades.blade.php ENDPATH**/ ?>