<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses | GLPBL</title>
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
        
        .course-card {
            border-left: 4px solid #1a5f2c;
        }
        
        .course-card.archived {
            border-left: 4px solid #6b7280;
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
        
        /* Grade level colors */
        .grade-1 { background-color: #FEF3C7; color: #92400E; }
        .grade-2 { background-color: #D1FAE5; color: #065F46; }
        .grade-3 { background-color: #DBEAFE; color: #1E40AF; }
        .grade-4 { background-color: #E9D5FF; color: #6B21A8; }
        .grade-5 { background-color: #FECACA; color: #991B1B; }
        .grade-6 { background-color: #FDE68A; color: #92400E; }
        
        /* Module styles */
        .module-item {
            border-left: 3px solid #1a5f2c;
            transition: all 0.2s;
        }
        
        .module-item:hover {
            background-color: #f0fdf4;
        }
        
        .module-item.completed {
            border-left-color: #10b981;
        }
        
        .section-item {
            padding-left: 2rem;
            border-left: 2px solid #d1fae5;
        }
        
        .status-completed {
            color: #10b981;
        }
        
        .status-pending {
            color: #f59e0b;
        }
        
        .status-not-started {
            color: #6b7280;
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
                        <a href="{{ route('teacher.dashboard') }}" class="flex items-center p-3 rounded-lg sidebar-menu-item bg-green-50 text-green-600">
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
                                <a href="{{ route('mycourses') }}" class="block py-2 px-3 rounded-lg text-sm hover:bg-gray-100">My Courses</a>
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
                        <a href="#" class="flex items-center p-3 rounded-lg sidebar-menu-item">
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
                <img class="h-8 w-8 rounded-full" src="{{ asset('images/profile.png') }}" alt="User menu">
                <span class="hidden md:inline ml-2 text-sm font-medium text-gray-700">{{ Auth::guard('teacher')->user()->name }}</span>
                <svg class="ml-1 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Profile Dropdown Menu -->
        <div id="userMenu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
            <form method="POST" action="{{ route('teacher.logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">
                    Sign out
                </button>
            </form>
        </div>
    </div>
</div>

                            <!-- Dropdown menu -->
<div id="userMenu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
    
    <!-- Logout Form -->
    <form method="POST" action="{{ route('teacher.logout') }}" class="w-full">
        @csrf
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

        <!-- Courses content -->
        <div class="p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Tab Navigation -->
                <div class="tab-container">
                    <div class="tab active" data-tab="active">Active Courses</div>
                    <div class="tab" data-tab="archived">Archived Courses</div>
                </div>
                
                <!-- Active Courses Section -->
                <div id="active-courses" class="tab-content">
                    <!-- Page Header -->
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">My Courses</h1>
                            <p class="text-gray-600 mt-2">Manage your Blaan Language courses for Grades 1-6</p>
                        </div>
                        <button id="newCourseBtn" class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            New Course
                        </button>
                    </div>
                    
                    <!-- Courses Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="active-courses-container">
                        <!-- Course cards will be dynamically inserted here -->
                    </div>
                    
                    <!-- Upcoming Activities -->
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Upcoming Activities</h2>
                        <div class="card p-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="relative px-6 py-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="activities-table-body">
                                        <!-- Activities will be dynamically inserted here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button id="newActivityBtn" class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    New Activity
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Archived Courses Section (initially hidden) -->
                <div id="archived-courses" class="tab-content hidden">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Archived Courses</h1>
                            <p class="text-gray-600 mt-2">View and restore your archived courses</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="archived-courses-container">
                        <!-- Archived courses will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Detail Modal -->
    <div id="courseDetailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-6xl shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 id="courseDetailTitle" class="text-2xl font-bold text-gray-900"></h3>
                <button id="closeCourseDetail" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="mt-4">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <p id="courseDetailDescription" class="text-gray-600"></p>
                        <div class="flex items-center mt-2">
                            <span id="courseDetailGrade" class="badge mr-2"></span>
                            <span id="courseDetailStatus" class="badge"></span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button id="editCourseBtn" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg text-sm hover:bg-blue-700 transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit Course
                        </button>
                        <button id="archiveCourseBtn" class="px-4 py-2 bg-gray-600 text-white font-medium rounded-lg text-sm hover:bg-gray-700 transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                            </svg>
                            Archive
                        </button>
                    </div>
                </div>
                
                <!-- Modules and Sections -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-xl font-bold text-gray-900">Modules</h4>
                        <button id="addModuleBtn" class="px-3 py-1 bg-green-600 text-white font-medium rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add Module
                        </button>
                    </div>
                    
                    <div id="modulesContainer" class="space-y-4">
                        <!-- Modules will be dynamically inserted here -->
                    </div>
                </div>
                
                <!-- Course Statistics -->
                <div class="card p-6">
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Course Statistics</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Students</p>
                            <p id="courseDetailStudents" class="text-3xl font-bold text-green-600">0</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Lessons</p>
                            <p id="courseDetailLessons" class="text-3xl font-bold text-blue-600">0</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500">Completion</p>
                            <p id="courseDetailCompletion" class="text-3xl font-bold text-yellow-600">0%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Module/Section Form Modal -->
    <div id="moduleFormModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 id="moduleFormTitle" class="text-xl font-bold text-gray-900">Add New Module</h3>
                <button id="closeModuleForm" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="mt-4">
                <form id="moduleForm">
                    <input type="hidden" id="moduleId">
                    <input type="hidden" id="moduleCourseId">
                    
                    <div class="mb-4">
                        <label for="moduleTitle" class="block text-sm font-medium text-gray-700 mb-1">Module Title</label>
                        <input type="text" id="moduleTitle" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="moduleDescription" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="moduleDescription" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="moduleStatus" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="moduleStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            <option value="not-started">Not Started</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    
                    <div id="sectionFields" class="mb-4 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sections</label>
                        <div id="sectionsContainer" class="space-y-3">
                            <!-- Sections will be dynamically added here -->
                        </div>
                        <button type="button" id="addSectionBtn" class="mt-2 px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded hover:bg-gray-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add Section
                        </button>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" id="cancelModuleForm" class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg text-sm hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg text-sm hover:bg-green-700">
                            Save Module
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
        
        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        
        // Modal elements
        const courseDetailModal = document.getElementById('courseDetailModal');
        const closeCourseDetail = document.getElementById('closeCourseDetail');
        const moduleFormModal = document.getElementById('moduleFormModal');
        const closeModuleForm = document.getElementById('closeModuleForm');
        const cancelModuleForm = document.getElementById('cancelModuleForm');
        
        // Sample data for courses (in a real app, this would come from an API)
        let courses = {
            active: [
                {
                    id: 1,
                    title: "Blaan Language - Grade 1",
                    description: "Basic vocabulary and greetings",
                    grade: 1,
                    status: "active",
                    students: 20,
                    lessons: 8,
                    progress: "Ongoing",
                    modules: [
                        {
                            id: 1,
                            title: "1st Grading",
                            description: "Introduction to the course structure and expectations",
                            status: "completed",
                            isLocked: false,
                            sections: [
                                {
                                    id: 1,
                                    title: "Course Introduction",
                                    type: "handout",
                                    submitted: true,
                                    score: "8/10",
                                    due: "Feb 3",
                                    status: "completed"
                                }
                            ]
                        },
                        {
                            id: 2,
                            title: "2nd Grading",
                            description: "Getting started with Power Apps",
                            status: "in-progress",
                            isLocked: true,
                            sections: [
                                {
                                    id: 2,
                                    title: "01 Handout 1",
                                    type: "handout",
                                    submitted: true,
                                    score: "8/10",
                                    due: "Feb 3",
                                    status: "completed"
                                },
                                {
                                    id: 3,
                                    title: "01 Activity 1 - ARG",
                                    type: "activity",
                                    submitted: true,
                                    score: "100/100",
                                    due: "Jan 27",
                                    status: "completed"
                                },
                                {
                                    id: 4,
                                    title: "01 Laboratory Exercise 1 - ARG",
                                    type: "lab",
                                    submitted: true,
                                    score: "",
                                    due: "",
                                    status: "completed"
                                }
                            ]
                        },
                        {
                            id: 3,
                            title: "3rd Grading",
                            description: "Advanced topics",
                            status: "not-started",
                            isLocked: true,
                            sections: []
                        },
                        {
                            id: 4,
                            title: "4th Grading",
                            description: "Final assessments",
                            status: "not-started",
                            isLocked: true,
                            sections: []
                        }
                    ]
                },
                {
                    id: 2,
                    title: "Blaan Language - Grade 2",
                    description: "Common phrases and sentences",
                    grade: 2,
                    status: "active",
                    students: 22,
                    lessons: 10,
                    progress: "Ongoing",
                    modules: []
                },
                {
                    id: 3,
                    title: "Blaan Language - Grade 3",
                    description: "Basic conversations",
                    grade: 3,
                    status: "active",
                    students: 25,
                    lessons: 12,
                    progress: "Ongoing",
                    modules: []
                },
                {
                    id: 4,
                    title: "Blaan Language - Grade 4",
                    description: "Intermediate vocabulary",
                    grade: 4,
                    status: "active",
                    students: 28,
                    lessons: 15,
                    progress: "Ongoing",
                    modules: []
                },
                {
                    id: 5,
                    title: "Blaan Language - Grade 5",
                    description: "Advanced conversations",
                    grade: 5,
                    status: "active",
                    students: 24,
                    lessons: 18,
                    progress: "Ongoing",
                    modules: []
                },
                {
                    id: 6,
                    title: "Blaan Language - Grade 6",
                    description: "Cultural context and idioms",
                    grade: 6,
                    status: "active",
                    students: 26,
                    lessons: 20,
                    progress: "Ongoing",
                    modules: []
                }
            ],
            archived: [
                {
                    id: 7,
                    title: "Blaan Culture - Grade 4",
                    description: "Traditional practices and values",
                    grade: 4,
                    status: "archived",
                    students: 22,
                    lessons: 15,
                    progress: "Completed",
                    modules: []
                }
            ]
        };

        // Sample data for activities
        let activities = [
            {
                id: 1,
                courseId: 1,
                title: "Vocabulary Quiz",
                description: "Basic Greetings",
                dueDate: "2023-06-15T10:00",
                type: "quiz",
                status: "pending"
            },
            {
                id: 2,
                courseId: 3,
                title: "Lesson Plan",
                description: "Common Phrases",
                dueDate: "2023-06-16T08:00",
                type: "lesson",
                status: "in-progress"
            },
            {
                id: 3,
                courseId: 5,
                title: "Cultural Presentation",
                description: "Traditional Practices",
                dueDate: "2023-06-19T13:00",
                type: "presentation",
                status: "scheduled"
            }
        ];
        
        // Current course being viewed
        let currentCourse = null;
        
        // Initialize the page
        renderCourses();
        renderActivities();
        
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
        
        // Tab switching
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                tab.classList.add('active');
                
                // Hide all tab contents
                tabContents.forEach(content => content.classList.add('hidden'));
                
                // Show the selected tab content
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(`${tabId}-courses`).classList.remove('hidden');
            });
        });
        
        // Create New Course Button
        document.getElementById('newCourseBtn').addEventListener('click', () => {
            showCourseForm();
        });
        
        // Create New Course from Sidebar
        document.getElementById('createCourseBtn').addEventListener('click', (e) => {
            e.preventDefault();
            showCourseForm();
        });
        
        // View Archived Courses from Sidebar
        document.getElementById('viewArchivedBtn').addEventListener('click', (e) => {
            e.preventDefault();
            // Switch to archived tab
            tabs[1].click();
        });
        
        // New Activity Button
        document.getElementById('newActivityBtn').addEventListener('click', () => {
            showActivityForm();
        });
        
        // Close Course Detail Modal
        closeCourseDetail.addEventListener('click', () => {
            courseDetailModal.classList.add('hidden');
        });
        
        // Close Module Form Modal
        closeModuleForm.addEventListener('click', () => {
            moduleFormModal.classList.add('hidden');
        });
        
        // Cancel Module Form
        cancelModuleForm.addEventListener('click', () => {
            moduleFormModal.classList.add('hidden');
        });
        
        // Edit Course Button
        document.getElementById('editCourseBtn').addEventListener('click', () => {
            if (currentCourse) {
                showCourseForm(true, currentCourse);
                courseDetailModal.classList.add('hidden');
            }
        });
        
        // Archive Course Button
        document.getElementById('archiveCourseBtn').addEventListener('click', () => {
            if (currentCourse) {
                archiveCourse(currentCourse.id);
                courseDetailModal.classList.add('hidden');
            }
        });
        
        // Add Module Button
        document.getElementById('addModuleBtn').addEventListener('click', () => {
            showModuleForm();
        });
        
        // Add Section Button
        document.getElementById('addSectionBtn').addEventListener('click', () => {
            addSectionField();
        });
        
        // Module Form Submission
        document.getElementById('moduleForm').addEventListener('submit', (e) => {
            e.preventDefault();
            saveModule();
        });
        
        // Function to show course form
        function showCourseForm(edit = false, courseData = null) {
            Swal.fire({
                title: edit ? 'Edit Course' : 'Create New Course',
                html: `
                    <div class="text-left">
                        <div class="mb-4">
                            <label for="course-title" class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                            <input id="course-title" class="swal2-input" placeholder="e.g. Blaan Language - Grade 3" value="${courseData ? courseData.title : ''}">
                        </div>
                        <div class="mb-4">
                            <label for="course-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="course-description" class="swal2-textarea" placeholder="Brief description of the course">${courseData ? courseData.description : ''}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="course-grade" class="block text-sm font-medium text-gray-700 mb-1">Grade Level</label>
                            <select id="course-grade" class="swal2-select">
                                <option value="1" ${courseData && courseData.grade == 1 ? 'selected' : ''}>Grade 1</option>
                                <option value="2" ${courseData && courseData.grade == 2 ? 'selected' : ''}>Grade 2</option>
                                <option value="3" ${courseData && courseData.grade == 3 ? 'selected' : ''}>Grade 3</option>
                                <option value="4" ${courseData && courseData.grade == 4 ? 'selected' : ''}>Grade 4</option>
                                <option value="5" ${courseData && courseData.grade == 5 ? 'selected' : ''}>Grade 5</option>
                                <option value="6" ${courseData && courseData.grade == 6 ? 'selected' : ''}>Grade 6</option>
                            </select>
                        </div>
                    </div>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const title = document.getElementById('course-title').value;
                    const description = document.getElementById('course-description').value;
                    const grade = document.getElementById('course-grade').value;
                    
                    if (!title || !description) {
                        Swal.showValidationMessage('Please fill in all fields');
                        return false;
                    }
                    
                    return { title, description, grade: parseInt(grade) };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { title, description, grade } = result.value;
                    
                    // In a real app, you would send this data to your backend
                    if (edit) {
                        // Update existing course
                        const courseIndex = courses.active.findIndex(c => c.id == courseData.id);
                        if (courseIndex !== -1) {
                            courses.active[courseIndex] = {
                                ...courses.active[courseIndex],
                                title,
                                description,
                                grade
                            };
                        }
                        renderCourses();
                        Swal.fire('Updated!', 'Your course has been updated.', 'success');
                    } else {
                        // Create new course
                        const newCourse = {
                            id: Math.max(...courses.active.map(c => c.id), ...courses.archived.map(c => c.id)) + 1,
                            title: title,
                            description: description,
                            grade: grade,
                            status: "active",
                            students: 0,
                            lessons: 0,
                            progress: "Not started",
                            modules: []
                        };
                        
                        courses.active.push(newCourse);
                        renderCourses();
                        
                        Swal.fire('Created!', 'Your new course has been created.', 'success');
                    }
                }
            });
        }
        
        // Function to show activity form
        function showActivityForm(edit = false, activityData = null) {
            Swal.fire({
                title: edit ? 'Edit Activity' : 'Create New Activity',
                html: `
                    <div class="text-left">
                        <div class="mb-4">
                            <label for="activity-course" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                            <select id="activity-course" class="swal2-select">
                                ${courses.active.map(course => 
                                    `<option value="${course.id}" ${activityData && activityData.courseId == course.id ? 'selected' : ''}>${course.title}</option>`
                                ).join('')}
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="activity-title" class="block text-sm font-medium text-gray-700 mb-1">Activity Title</label>
                            <input id="activity-title" class="swal2-input" placeholder="e.g. Vocabulary Quiz" value="${activityData ? activityData.title : ''}">
                        </div>
                        <div class="mb-4">
                            <label for="activity-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="activity-description" class="swal2-textarea" placeholder="Brief description of the activity">${activityData ? activityData.description : ''}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="activity-due-date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                            <input id="activity-due-date" type="datetime-local" class="swal2-input" value="${activityData ? activityData.dueDate : ''}">
                        </div>
                        <div class="mb-4">
                            <label for="activity-type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select id="activity-type" class="swal2-select">
                                <option value="quiz" ${activityData && activityData.type === 'quiz' ? 'selected' : ''}>Quiz</option>
                                <option value="assignment" ${activityData && activityData.type === 'assignment' ? 'selected' : ''}>Assignment</option>
                                <option value="presentation" ${activityData && activityData.type === 'presentation' ? 'selected' : ''}>Presentation</option>
                                <option value="lesson" ${activityData && activityData.type === 'lesson' ? 'selected' : ''}>Lesson</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="activity-status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="activity-status" class="swal2-select">
                                <option value="pending" ${activityData && activityData.status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="in-progress" ${activityData && activityData.status === 'in-progress' ? 'selected' : ''}>In Progress</option>
                                <option value="scheduled" ${activityData && activityData.status === 'scheduled' ? 'selected' : ''}>Scheduled</option>
                                <option value="completed" ${activityData && activityData.status === 'completed' ? 'selected' : ''}>Completed</option>
                            </select>
                        </div>
                    </div>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const courseId = document.getElementById('activity-course').value;
                    const title = document.getElementById('activity-title').value;
                    const description = document.getElementById('activity-description').value;
                    const dueDate = document.getElementById('activity-due-date').value;
                    const type = document.getElementById('activity-type').value;
                    const status = document.getElementById('activity-status').value;
                    
                    if (!title || !description || !dueDate) {
                        Swal.showValidationMessage('Please fill in all fields');
                        return false;
                    }
                    
                    return { 
                        courseId: parseInt(courseId), 
                        title, 
                        description, 
                        dueDate, 
                        type,
                        status 
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const { courseId, title, description, dueDate, type, status } = result.value;
                    
                    if (edit) {
                        // Update existing activity
                        const activityIndex = activities.findIndex(a => a.id == activityData.id);
                        if (activityIndex !== -1) {
                            activities[activityIndex] = {
                                ...activities[activityIndex],
                                courseId,
                                title,
                                description,
                                dueDate,
                                type,
                                status
                            };
                        }
                    } else {
                        // Create new activity
                        const newActivity = {
                            id: activities.length > 0 ? Math.max(...activities.map(a => a.id)) + 1 : 1,
                            courseId,
                            title,
                            description,
                            dueDate,
                            type,
                            status
                        };
                        
                        activities.push(newActivity);
                    }
                    
                    renderActivities();
                    
                    Swal.fire(
                        edit ? 'Updated!' : 'Created!',
                        edit ? 'Activity has been updated.' : 'New activity has been created.',
                        'success'
                    );
                }
            });
        }
        
        // Function to view course details
        function viewCourse(courseId) {
            // In a real app, you would fetch course details from your backend
            currentCourse = [...courses.active, ...courses.archived].find(c => c.id == courseId);
            
            if (currentCourse) {
                // Update modal content
                document.getElementById('courseDetailTitle').textContent = currentCourse.title;
                document.getElementById('courseDetailDescription').textContent = currentCourse.description;
                
                // Update grade badge
                const gradeBadge = document.getElementById('courseDetailGrade');
                gradeBadge.textContent = `Grade ${currentCourse.grade}`;
                gradeBadge.className = `badge grade-${currentCourse.grade}`;
                
                // Update status badge
                const statusBadge = document.getElementById('courseDetailStatus');
                statusBadge.textContent = currentCourse.status === 'active' ? 'Active' : 'Archived';
                statusBadge.className = `badge ${currentCourse.status === 'active' ? 'badge-primary' : 'badge-archived'}`;
                
                // Update statistics
                document.getElementById('courseDetailStudents').textContent = currentCourse.students;
                document.getElementById('courseDetailLessons').textContent = currentCourse.lessons;
                document.getElementById('courseDetailCompletion').textContent = currentCourse.progress === 'Completed' ? '100%' : 
                                                                               currentCourse.progress === 'Not started' ? '0%' : '50%';
                
                // Update archive/restore button
                const archiveBtn = document.getElementById('archiveCourseBtn');
                if (currentCourse.status === 'active') {
                    archiveBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                        </svg>
                        Archive
                    `;
                    archiveBtn.className = 'px-4 py-2 bg-gray-600 text-white font-medium rounded-lg text-sm hover:bg-gray-700 transition flex items-center';
                } else {
                    archiveBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                        Restore
                    `;
                    archiveBtn.className = 'px-4 py-2 bg-green-600 text-white font-medium rounded-lg text-sm hover:bg-green-700 transition flex items-center';
                }
                
                // Render modules
                renderModules(currentCourse.modules);
                
                // Show the modal
                courseDetailModal.classList.remove('hidden');
            }
        }
        
        // Function to render modules
        function renderModules(modules) {
            const modulesContainer = document.getElementById('modulesContainer');
            modulesContainer.innerHTML = '';
            
            if (modules.length === 0) {
                modulesContainer.innerHTML = `
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 class="mt-2 text-lg font-medium text-gray-900">No Modules Yet</h4>
                        <p class="mt-1 text-gray-500">Add your first module to get started</p>
                    </div>
                `;
                return;
            }
            
            modules.forEach(module => {
                const moduleElement = document.createElement('div');
                moduleElement.className = `card module-item ${module.status === 'completed' ? 'completed' : ''} ${module.isLocked ? 'locked' : ''} p-4`;
                moduleElement.setAttribute('data-module-id', module.id);
                
                // Status badge
                let statusBadge = '';
                if (module.status === 'completed') {
                    statusBadge = '<span class="badge bg-green-100 text-green-800 ml-2">Completed</span>';
                } else if (module.status === 'in-progress') {
                    statusBadge = '<span class="badge bg-yellow-100 text-yellow-800 ml-2">In Progress</span>';
                } else {
                    statusBadge = '<span class="badge bg-gray-100 text-gray-800 ml-2">Not Started</span>';
                }
                
                // Lock status
                const lockStatus = module.isLocked ? 
                    `<span class="badge bg-red-100 text-red-800 ml-2">Locked</span>` : 
                    `<span class="badge bg-green-100 text-green-800 ml-2">Unlocked</span>`;
                
                moduleElement.innerHTML = `
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center mb-1">
                                <h5 class="font-bold text-lg">${module.title}</h5>
                                ${lockStatus}
                                ${statusBadge}
                            </div>
                            ${module.description ? `<p class="text-gray-600 mt-1">${module.description}</p>` : ''}
                        </div>
                        <div class="flex space-x-2">
                            <button class="toggle-lock-btn p-1 text-gray-500 hover:text-${module.isLocked ? 'green' : 'red'}-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ${module.isLocked ? 'unlock-icon' : 'lock-icon'}" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="${module.isLocked ? 'M10 2a5 5 0 00-5 5v1a1 1 0 001 1h8a1 1 0 001-1V7a5 5 0 00-5-5zm3.707 9.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z' : 'M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z'}" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="edit-module-btn p-1 text-gray-500 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </button>
                            <button class="delete-module-btn p-1 text-gray-500 hover:text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                
                // Add sections if they exist
                if (module.sections && module.sections.length > 0 && !module.isLocked) {
                    const sectionsContainer = document.createElement('div');
                    sectionsContainer.className = 'mt-4 space-y-3';
                    
                    module.sections.forEach(section => {
                        const sectionElement = document.createElement('div');
                        sectionElement.className = 'section-item p-3 bg-gray-50 rounded';
                        
                        // Status icon
                        let statusIcon = '';
                        if (section.status === 'completed') {
                            statusIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>';
                        } else {
                            statusIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>';
                        }
                        
                        sectionElement.innerHTML = `
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    ${statusIcon}
                                    <div>
                                        <h6 class="font-medium">${section.title}</h6>
                                        ${section.due ? `<p class="text-xs text-gray-500">Due: ${section.due}</p>` : ''}
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    ${section.submitted ? '<span class="text-xs text-green-600 mr-3">Submitted</span>' : ''}
                                    ${section.score ? `<span class="text-xs font-medium">${section.score}</span>` : ''}
                                </div>
                            </div>
                        `;
                        
                        sectionsContainer.appendChild(sectionElement);
                    });
                    
                    moduleElement.appendChild(sectionsContainer);
                } else if (module.isLocked) {
                    const lockedMessage = document.createElement('div');
                    lockedMessage.className = 'mt-4 text-center py-4 bg-gray-50 rounded text-gray-500';
                    lockedMessage.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <p class="mt-2">This module is locked. Students cannot access it.</p>
                    `;
                    moduleElement.appendChild(lockedMessage);
                }
                
                modulesContainer.appendChild(moduleElement);
            });
            
            // Add event listeners to module buttons
            document.querySelectorAll('.edit-module-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const moduleId = parseInt(e.target.closest('.module-item').getAttribute('data-module-id'));
                    const module = currentCourse.modules.find(m => m.id === moduleId);
                    if (module) {
                        showModuleForm(module);
                    }
                });
            });
            
            document.querySelectorAll('.delete-module-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const moduleId = parseInt(e.target.closest('.module-item').getAttribute('data-module-id'));
                    deleteModule(moduleId);
                });
            });
            
            document.querySelectorAll('.toggle-lock-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const moduleId = parseInt(e.target.closest('.module-item').getAttribute('data-module-id'));
                    toggleModuleLock(moduleId);
                });
            });
        }
        
        // Function to toggle module lock status
        function toggleModuleLock(moduleId) {
            if (currentCourse) {
                const module = currentCourse.modules.find(m => m.id === moduleId);
                if (module) {
                    module.isLocked = !module.isLocked;
                    renderModules(currentCourse.modules);
                    
                    Swal.fire(
                        module.isLocked ? 'Locked!' : 'Unlocked!',
                        module.isLocked ? 'Module has been locked. Students cannot access it.' : 'Module has been unlocked. Students can now access it.',
                        'success'
                    );
                }
            }
        }
        
        // Function to show module form
        function showModuleForm(moduleData = null) {
            const formTitle = document.getElementById('moduleFormTitle');
            const moduleTitle = document.getElementById('moduleTitle');
            const moduleDescription = document.getElementById('moduleDescription');
            const moduleStatus = document.getElementById('moduleStatus');
            const moduleIsLocked = document.getElementById('moduleIsLocked');
            const moduleId = document.getElementById('moduleId');
            const moduleCourseId = document.getElementById('moduleCourseId');
            const sectionFields = document.getElementById('sectionFields');
            
            if (moduleData) {
                // Edit existing module
                formTitle.textContent = 'Edit Module';
                moduleTitle.value = moduleData.title;
                moduleDescription.value = moduleData.description || '';
                moduleStatus.value = moduleData.status || 'not-started';
                moduleIsLocked.checked = moduleData.isLocked || false;
                moduleId.value = moduleData.id;
                moduleCourseId.value = currentCourse.id;
                
                // Show sections if they exist
                if (moduleData.sections && moduleData.sections.length > 0) {
                    sectionFields.classList.remove('hidden');
                    const sectionsContainer = document.getElementById('sectionsContainer');
                    sectionsContainer.innerHTML = '';
                    
                    moduleData.sections.forEach(section => {
                        addSectionField(section);
                    });
                } else {
                    sectionFields.classList.add('hidden');
                }
            } else {
                // Add new module
                formTitle.textContent = 'Add New Module';
                moduleTitle.value = '';
                moduleDescription.value = '';
                moduleStatus.value = 'not-started';
                moduleIsLocked.checked = false;
                moduleId.value = '';
                moduleCourseId.value = currentCourse.id;
                sectionFields.classList.add('hidden');
            }
            
            moduleFormModal.classList.remove('hidden');
        }
        
        // Function to add section field
        function addSectionField(sectionData = null) {
            const sectionsContainer = document.getElementById('sectionsContainer');
            const sectionId = sectionData ? sectionData.id : Date.now();
            
            const sectionField = document.createElement('div');
            sectionField.className = 'flex items-start space-x-2';
            sectionField.innerHTML = `
                <div class="flex-1 space-y-2">
                    <input type="text" placeholder="Section title" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" value="${sectionData ? sectionData.title : ''}" required>
                    <div class="grid grid-cols-2 gap-2">
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            <option value="handout" ${sectionData && sectionData.type === 'handout' ? 'selected' : ''}>Handout</option>
                            <option value="activity" ${sectionData && sectionData.type === 'activity' ? 'selected' : ''}>Activity</option>
                            <option value="lab" ${sectionData && sectionData.type === 'lab' ? 'selected' : ''}>Lab Exercise</option>
                            <option value="quiz" ${sectionData && sectionData.type === 'quiz' ? 'selected' : ''}>Quiz</option>
                        </select>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500" value="${sectionData && sectionData.due ? sectionData.due : ''}">
                    </div>
                </div>
                <button type="button" class="remove-section-btn p-2 text-gray-500 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            
            sectionsContainer.appendChild(sectionField);
            
            // Add event listener to remove button
            sectionField.querySelector('.remove-section-btn').addEventListener('click', () => {
                sectionsContainer.removeChild(sectionField);
            });
            
            // Show section fields container if it's hidden
            document.getElementById('sectionFields').classList.remove('hidden');
        }
        
        // Function to save module
        function saveModule() {
            const moduleId = document.getElementById('moduleId').value;
            const courseId = parseInt(document.getElementById('moduleCourseId').value);
            const title = document.getElementById('moduleTitle').value;
            const description = document.getElementById('moduleDescription').value;
            const status = document.getElementById('moduleStatus').value;
            const isLocked = document.getElementById('moduleIsLocked').checked;
            
            if (!title) {
                Swal.fire('Error', 'Module title is required', 'error');
                return;
            }
            
            // Collect sections data
            const sections = [];
            document.querySelectorAll('#sectionsContainer > div').forEach(sectionEl => {
                const inputs = sectionEl.querySelectorAll('input, select');
                sections.push({
                    id: Date.now(), // In a real app, this would come from your backend
                    title: inputs[0].value,
                    type: inputs[1].value,
                    due: inputs[2].value,
                    submitted: false,
                    status: 'pending'
                });
            });
            
            if (moduleId) {
                // Update existing module
                const course = [...courses.active, ...courses.archived].find(c => c.id === courseId);
                if (course) {
                    const moduleIndex = course.modules.findIndex(m => m.id === parseInt(moduleId));
                    if (moduleIndex !== -1) {
                        course.modules[moduleIndex] = {
                            ...course.modules[moduleIndex],
                            title,
                            description,
                            status,
                            isLocked,
                            sections: sections.length > 0 ? sections : course.modules[moduleIndex].sections
                        };
                    }
                }
            } else {
                // Add new module
                const newModule = {
                    id: Date.now(), // In a real app, this would come from your backend
                    title,
                    description,
                    status,
                    isLocked,
                    sections
                };
                
                const course = [...courses.active, ...courses.archived].find(c => c.id === courseId);
                if (course) {
                    course.modules.push(newModule);
                }
            }
            
            // Update the current course view
            if (currentCourse && currentCourse.id === courseId) {
                currentCourse = [...courses.active, ...courses.archived].find(c => c.id === courseId);
                renderModules(currentCourse.modules);
            }
            
            // Close the form
            moduleFormModal.classList.add('hidden');
            
            Swal.fire(
                moduleId ? 'Updated!' : 'Created!',
                moduleId ? 'Module has been updated.' : 'New module has been created.',
                'success'
            );
        }
        
        // Function to delete a module
        function deleteModule(moduleId) {
            Swal.fire({
                title: 'Delete Module?',
                text: 'This will also delete all sections in this module.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (currentCourse) {
                        const moduleIndex = currentCourse.modules.findIndex(m => m.id === moduleId);
                        if (moduleIndex !== -1) {
                            currentCourse.modules.splice(moduleIndex, 1);
                            renderModules(currentCourse.modules);
                            Swal.fire('Deleted!', 'The module has been deleted.', 'success');
                        }
                    }
                }
            });
        }
        
        // Function to archive a course
        function archiveCourse(courseId) {
            Swal.fire({
                title: currentCourse.status === 'active' ? 'Archive Course?' : 'Restore Course?',
                text: currentCourse.status === 'active' ? 
                    'Archived courses can be restored later.' : 
                    'The course will be moved back to active courses.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: currentCourse.status === 'active' ? '#6b7280' : '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: currentCourse.status === 'active' ? 'Yes, archive it' : 'Yes, restore it'
            }).then((result) => {
                if (result.isConfirmed) {
                    // In a real app, you would send this to your backend
                    if (currentCourse.status === 'active') {
                        const courseIndex = courses.active.findIndex(c => c.id == courseId);
                        if (courseIndex !== -1) {
                            const [course] = courses.active.splice(courseIndex, 1);
                            course.status = "archived";
                            courses.archived.push(course);
                        }
                    } else {
                        const courseIndex = courses.archived.findIndex(c => c.id == courseId);
                        if (courseIndex !== -1) {
                            const [course] = courses.archived.splice(courseIndex, 1);
                            course.status = "active";
                            courses.active.push(course);
                        }
                    }
                    
                    renderCourses();
                    
                    Swal.fire(
                        currentCourse.status === 'active' ? 'Archived!' : 'Restored!',
                        currentCourse.status === 'active' ? 'The course has been archived.' : 'The course has been restored.',
                        'success'
                    );
                }
            });
        }
        
        // Function to delete a course
        function deleteCourse(courseId) {
            Swal.fire({
                title: 'Delete Course?',
                text: 'This action cannot be undone. All course data will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it'
            }).then((result) => {
                if (result.isConfirmed) {
                    // In a real app, you would send this to your backend
                    const courseIndex = courses.archived.findIndex(c => c.id == courseId);
                    if (courseIndex !== -1) {
                        courses.archived.splice(courseIndex, 1);
                        renderCourses();
                        
                        Swal.fire('Deleted!', 'The course has been permanently deleted.', 'success');
                    }
                }
            });
        }
        
        // Function to render courses (for demo purposes)
        function renderCourses() {
            // In a real app, you would fetch this from your backend
            const activeContainer = document.getElementById('active-courses-container');
            const archivedContainer = document.getElementById('archived-courses-container');
            
            // Clear containers
            activeContainer.innerHTML = '';
            archivedContainer.innerHTML = '';
            
            // Render active courses
            courses.active.forEach(course => {
                activeContainer.appendChild(createCourseCard(course));
            });
            
            // Render archived courses
            courses.archived.forEach(course => {
                archivedContainer.appendChild(createCourseCard(course, true));
            });
            
            // Reattach event listeners
            document.querySelectorAll('.view-course-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const courseId = this.closest('.card').getAttribute('data-course-id');
                    viewCourse(courseId);
                });
            });
            
            document.querySelectorAll('.archive-course-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const courseId = this.closest('.card').getAttribute('data-course-id');
                    archiveCourse(courseId);
                });
            });
            
            document.querySelectorAll('.restore-course-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const courseId = this.closest('.card').getAttribute('data-course-id');
                    restoreCourse(courseId);
                });
            });
            
            document.querySelectorAll('.delete-course-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const courseId = this.closest('.card').getAttribute('data-course-id');
                    deleteCourse(courseId);
                });
            });
        }
        
        // Function to render activities
        function renderActivities() {
            const activitiesTableBody = document.getElementById('activities-table-body');
            activitiesTableBody.innerHTML = '';
            
            activities.forEach(activity => {
                const course = [...courses.active, ...courses.archived].find(c => c.id == activity.courseId);
                const courseTitle = course ? course.title : 'Unknown Course';
                
                const row = document.createElement('tr');
                row.className = 'archive-item';
                
                // Format due date
                const dueDate = new Date(activity.dueDate);
                const formattedDate = dueDate.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    month: 'short', 
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                // Determine status badge
                let statusBadge = '';
                let statusText = '';
                switch(activity.status) {
                    case 'pending':
                        statusBadge = 'bg-green-100 text-green-800';
                        statusText = 'Pending';
                        break;
                    case 'in-progress':
                        statusBadge = 'bg-yellow-100 text-yellow-800';
                        statusText = 'In Progress';
                        break;
                    case 'scheduled':
                        statusBadge = 'bg-blue-100 text-blue-800';
                        statusText = 'Scheduled';
                        break;
                    case 'completed':
                        statusBadge = 'bg-gray-100 text-gray-800';
                        statusText = 'Completed';
                        break;
                }
                
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">${courseTitle}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-gray-900">${activity.title}</div>
                        <div class="text-gray-500">${activity.description}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                        ${formattedDate}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusBadge}">
                            ${statusText}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-green-600 hover:text-green-900 edit-activity-btn mr-3">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 delete-activity-btn">Delete</a>
                    </td>
                `;
                
                activitiesTableBody.appendChild(row);
            });
            
            // Attach event listeners to edit buttons
            document.querySelectorAll('.edit-activity-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const row = e.target.closest('tr');
                    const rowIndex = Array.from(row.parentNode.children).indexOf(row);
                    const activity = activities[rowIndex];
                    showActivityForm(true, activity);
                });
            });
            
            // Attach event listeners to delete buttons
            document.querySelectorAll('.delete-activity-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const row = e.target.closest('tr');
                    const rowIndex = Array.from(row.parentNode.children).indexOf(row);
                    const activity = activities[rowIndex];
                    
                    Swal.fire({
                        title: 'Delete Activity?',
                        text: 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, delete it'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            activities.splice(rowIndex, 1);
                            renderActivities();
                            Swal.fire('Deleted!', 'The activity has been deleted.', 'success');
                        }
                    });
                });
            });
        }
        
        // Function to create a course card element
        function createCourseCard(course, isArchived = false) {
            const card = document.createElement('div');
            card.className = `card course-card ${isArchived ? 'archived' : ''} p-6`;
            card.setAttribute('data-course-id', course.id);
            
            // Get grade level color class
            const gradeColorClass = `grade-${course.grade}`;
            
            card.innerHTML = `
                <div class="flex items-start justify-between">
                    <div>
                        <div class="flex items-center mb-2">
                            <span class="badge ${isArchived ? 'badge-archived' : 'badge-primary'}">${isArchived ? 'Archived' : 'Active'}</span>
                            <span class="badge ${gradeColorClass} ml-2">Grade ${course.grade}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">${course.title}</h3>
                        <p class="text-gray-600 mt-1">${course.description}</p>
                    </div>
                    <div class="p-2 rounded-full ${isArchived ? 'bg-gray-100 text-gray-600' : 'bg-green-50 text-green-600'}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="${isArchived ? 'M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z' : 'M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z'}"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">Students</p>
                            <p class="font-medium">${course.students}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Lessons</p>
                            <p class="font-medium">${course.lessons}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="font-medium ${isArchived ? 'text-gray-600' : 'text-green-600'}">${course.progress}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <button class="${isArchived ? 'restore-course-btn' : 'view-course-btn'} flex-1 px-4 py-2 border ${isArchived ? 'border-green-600 text-green-600' : 'border-green-600 text-green-600'} font-medium rounded-lg text-sm hover:${isArchived ? 'bg-green-50' : 'bg-green-50'} transition">
                            ${isArchived ? 'Restore' : 'View Course'}
                        </button>
                        <button class="${isArchived ? 'delete-course-btn' : 'archive-course-btn'} p-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="${isArchived ? 'M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z' : 'M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z'}"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            
            return card;
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
</html>