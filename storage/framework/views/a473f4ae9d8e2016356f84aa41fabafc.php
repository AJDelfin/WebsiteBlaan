<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard | GLPBL</title>
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
        
        /* New header styles */
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
    </style>
</head>
<body class="bg-gray-50">
    <!-- Mobile sidebar backdrop -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 sm:hidden hidden" id="sidebarBackdrop"></div>

    <!-- Main Header -->
<header class="main-header flex items-center px-6" id="mainHeader">





<!-- Add this in your header section -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<!-- Login data element -->

    <!-- School Logo and Name -->
    <div class="flex items-center">
        <img src="/images/MaligyaElemSchool.jpg" alt="School Logo" class="h-10 w-10 rounded-full object-cover">
        <span class="text-xl font-semibold text-gray-800 whitespace-nowrap ml-2">Maligaya Elementary School</span>
    </div>
    
    <!-- Spacer -->
    <div class="flex-1"></div>
    
    <!-- User Profile -->
    <div class="flex items-center">
        <div class="relative mr-4">
            <button class="p-1 rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
            </button>
        </div>
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center focus:outline-none">
                <img class="w-8 h-8 rounded-full" src="<?php echo e(asset('images/profile.png')); ?>" alt="User avatar">
                <span class="ml-2 text-sm font-medium text-gray-700 hidden md:inline"><?php echo e(Auth::guard('teacher')->user()->name); ?></span>
                <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            
            <!-- Dropdown menu -->
            <div x-show="open" @click.away="open = false" 
                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                <form method="POST" action="<?php echo e(route('teacher.logout')); ?>">
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
                        <a href="<?php echo e(route('teacher.dashboard')); ?>" class="flex items-center p-3 rounded-lg sidebar-menu-item bg-green-50 text-green-600">
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
<div class="relative mr-4" x-data="{ open: false }">
    <button @click="open = !open" class="p-1 rounded-full hover:bg-gray-100 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
    </button>

    <!-- Notification Dropdown -->
    <div x-show="open" @click.away="open = false" 
         class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
        <div class="py-1">
            <div class="px-4 py-2 border-b border-gray-200">
                <h3 class="text-sm font-medium text-gray-900">Notifications</h3>
            </div>
            
            <div class="max-h-96 overflow-y-auto">
                <!-- Sample notification items -->
                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium">New assignment submitted</p>
                            <p class="text-xs text-gray-500">Student: Juan Dela Cruz</p>
                            <p class="text-xs text-gray-500">2 minutes ago</p>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-100">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium">Upcoming lesson reminder</p>
                            <p class="text-xs text-gray-500">Blaan Language - Basic Greetings</p>
                            <p class="text-xs text-gray-500">1 hour ago</p>
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
                <span class="mx-2 text-gray-400">|</span>
                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Mark all as read</a>
            </div>
        </div>
    </div>
</div>
                        <!-- Profile dropdown -->
                        <div class="ml-3 relative">
                            <div>
                                <button id="userMenuButton" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="User menu">
                                    <span class="hidden md:inline ml-2 text-sm font-medium text-gray-700"><?php echo e(Auth::guard('teacher')->user()->name); ?></span>
                                    <svg class="ml-1 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                           <!-- Dropdown menu -->
<div id="userMenu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
    
    <!-- Logout Form -->
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

        <!-- Dashboard content -->
        <div class="p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Welcome Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Welcome back, <?php echo e(Auth::guard('teacher')->user()->name); ?></h1>
                    <p class="text-gray-600 mt-2">Here's what's happening with your Blaan Language class today</p>
                </div>
                
                <!-- Announcement Card -->
                <div class="card announcement-card p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-1">
                            <span class="badge badge-warning mb-4">Important Update</span>
                            <h2 class="text-2xl font-bold mb-3"></h2>
                            <p class="mb-4"></p>
                            <div class="flex items-center gap-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                <span></span>
                            </div>
                        </div>
                        <div class="flex-1 bg-white bg-opacity-10 p-6 rounded-lg">
                            <h3 class="font-semibold mb-3">What you need to know:</h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span></span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span></span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span></span>
                                </li>
                            </ul>
                            <button class="mt-6 px-4 py-2 bg-white text-green-600 font-medium rounded-lg text-sm hover:bg-opacity-90 transition">
                                Setup Instructions
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Overview -->
                <div class="dashboard-grid mb-8">
                    <div class="card p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Students</p>
                                <h3 class="text-3xl font-bold mt-1">0</h3>
                            </div>
                            <div class="p-3 rounded-full bg-green-50 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-500">No change from yesterday</span>
                        </div>
                    </div>
                    
                    <div class="card p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Lessons Completed</p>
                                <h3 class="text-3xl font-bold mt-1">1</h3>
                            </div>
                            <div class="p-3 rounded-full bg-green-50 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-sm text-green-600 font-medium">+1 this week</span>
                        </div>
                    </div>
                    
                    <div class="card p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Active Learners</p>
                                <h3 class="text-3xl font-bold mt-1">0</h3>
                            </div>
                            <div class="p-3 rounded-full bg-amber-50 text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-500">No active sessions</span>
                        </div>
                    </div>
                </div>
                
                <!-- Subject Info Card -->
                <div class="card p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-semibold text-lg">Blaan Language Class</h3>
                        <span class="badge badge-primary">Current Subject</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-medium text-green-800 mb-2">Upcoming Lessons</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Basic Greetings - Tomorrow</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Common Phrases - Friday</span>
                                </li>
                            </ul>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-medium text-blue-800 mb-2">Recent Assignments</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Vocabulary Quiz - Due Today</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Culture Presentation - Next Week</span>
                                </li>
                            </ul>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-medium text-purple-800 mb-2">Class Resources</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Blaan Dictionary</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Cultural Notes</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="card p-6">
                    <h3 class="font-semibold text-lg mb-6">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button class="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <div class="p-3 mb-2 rounded-full bg-green-100 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Create Lesson</span>
                        </button>
                        
                        <button class="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <div class="p-3 mb-2 rounded-full bg-green-100 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Manage Class</span>
                        </button>
                        
                        <button class="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <div class="p-3 mb-2 rounded-full bg-amber-100 text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Support</span>
                        </button>
                        
                        <button class="flex flex-col items-center justify-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                            <div class="p-3 mb-2 rounded-full bg-purple-100 text-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Settings</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       // Sidebar functionality
    const sidebar = document.getElementById('sidebar');
    const toggleSidebar = document.getElementById('toggleSidebar');
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const contentArea = document.querySelector('.content-area');
    const menuToggles = document.querySelectorAll('.sidebar-menu-toggle');
    const userMenuButton = document.getElementById('userMenuButton');
    const userMenu = document.getElementById('userMenu');
    const notificationButton = document.getElementById('notificationDropdownButton');
    const notificationDropdown = document.getElementById('notificationDropdown');

    // Toggle sidebar collapse/expand
    if (toggleSidebar) {
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
    }

    // Toggle mobile menu
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarBackdrop.classList.toggle('hidden');
        });
    }

    // Close mobile menu when clicking backdrop
    if (sidebarBackdrop) {
        sidebarBackdrop.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebarBackdrop.classList.add('hidden');
        });
    }

    // Toggle dropdown menus
    if (menuToggles) {
        menuToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const menu = toggle.nextElementSibling;
                const icon = toggle.querySelector('svg:last-child');
                
                menu.classList.toggle('open');
                icon.classList.toggle('rotate-180');
            });
        });
    }

    // Toggle user menu
    if (userMenuButton) {
        userMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
            if (notificationDropdown) notificationDropdown.classList.add('hidden');
        });
    }

    // Toggle notification dropdown
    if (notificationButton) {
        notificationButton.addEventListener('click', (e) => {
            e.stopPropagation();
            notificationDropdown.classList.toggle('hidden');
            if (userMenu) userMenu.classList.add('hidden');
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        if (userMenu && !userMenuButton.contains(e.target)) {
            userMenu.classList.add('hidden');
        }
        if (notificationDropdown && !notificationButton.contains(e.target)) {
            notificationDropdown.classList.add('hidden');
        }
    });


    
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Blaan_Multi_Role\resources\views/teacher/dashboard.blade.php ENDPATH**/ ?>