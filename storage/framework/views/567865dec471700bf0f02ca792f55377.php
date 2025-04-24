<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features & Blaan Culture - Blaan Learning</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #2C5530;
            --primary-light: #4A7850;
            --secondary: #8B4513;
            --accent: #E86F52;
            --gold: #D4AF37;
            --light-bg: #FAF6F1;
            --dark-text: #2D3748;
            --gray-text: #718096;
            --white: #FFFFFF;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--light-bg);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }
        
        .culture-icon {
            color: var(--gold);
        }
        
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <!-- Navigation -->
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4">
        <!-- Logo and Title (Left Side) -->
        <div class="flex justify-center items-center">
            <div class="absolute left-6 flex items-center space-x-4">
                <img src="<?php echo e(asset('images/MaligyaElemSchool.jpg')); ?>" 
                     alt="Maligaya Elementary School Logo" 
                     class="h-12 w-12 rounded-full object-cover border-2 border-green-600">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Blaan Learning</h1>
                    <p class="text-xs text-gray-600">Preserving Cultural Heritage</p>
                </div>
            </div>
            
            <!-- Centered Navigation Links -->
            <nav class="hidden md:flex space-x-8 mx-auto">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-link text-gray-800 hover:text-green-700 font-medium">Dashboard</a>
                <a href="<?php echo e(route('translate')); ?>" class="nav-link text-gray-800 hover:text-green-700 font-medium">Translate</a>
                <a href="<?php echo e(route('features')); ?>" class="nav-link text-gray-800 hover:text-green-700 font-medium text-green-600">Features</a>
            </nav>
            
            <!-- User Dropdown (Right Side) -->
            <div class="absolute right-6">
                <div class="relative">
                    <button id="user-dropdown-button" class="flex items-center space-x-1 text-gray-800 hover:text-green-700 focus:outline-none font-medium">
                        <span><?php echo e(Auth::user()->name); ?></span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user-circle mr-2"></i> Profile
                        </a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu button -->
            <button id="mobile-menu-button" class="md:hidden text-gray-800 focus:outline-none absolute right-6">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 text-center">
            <a href="<?php echo e(route('dashboard')); ?>" class="block py-2 text-gray-800 hover:text-green-700">Dashboard</a>
            <a href="<?php echo e(route('translate')); ?>" class="block py-2 text-gray-800 hover:text-green-700">Translate</a>
            <a href="<?php echo e(route('features')); ?>" class="block py-2 text-gray-800 hover:text-green-700 font-medium text-green-600">Features</a>
            <div class="border-t border-gray-200 mt-2 pt-2">
                <a href="<?php echo e(route('profile.edit')); ?>" class="block py-2 text-gray-800 hover:text-green-700">Profile</a>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="block py-2 text-gray-800 hover:text-green-700 w-full text-left">Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4 text-green-700">Platform Features</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Discover how our platform helps preserve Blaan languages and cultures</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-gamepad text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Interactive Learning</h3>
                    <p class="text-gray-600">Engage with dynamic and fun learning modules designed to help you learn Blaan languages faster and more effectively.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-trophy text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Gamified Experience</h3>
                    <p class="text-gray-600">Learn through exciting games and challenges that make language learning enjoyable while preserving cultural context.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-language text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Language Preservation</h3>
                    <p class="text-gray-600">Our platform is dedicated to helping preserve and promote Blaan languages through modern technology.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blaan Culture Section -->
    <section class="py-16 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Blaan Cultural Heritage</h2>
                <p class="max-w-2xl mx-auto opacity-90">Explore the rich traditions and practices of the Blaan people</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white bg-opacity-10 p-8 rounded-xl backdrop-filter backdrop-blur-sm card-hover">
                    <img src="<?php echo e(asset('images/blaan-clothing.jpg')); ?>" alt="Blaan Traditional Clothing" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold mb-3">Traditional Clothing</h3>
                    <p class="opacity-90">The Blaan people are known for their intricate traditional clothing, often made from abaca fibers and adorned with beadwork and brass ornaments.</p>
                </div>
                
                <div class="bg-white bg-opacity-10 p-8 rounded-xl backdrop-filter backdrop-blur-sm card-hover">
                    <img src="<?php echo e(asset('images/blaan-music.jpg')); ?>" alt="Blaan Music and Dance" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold mb-3">Music and Dance</h3>
                    <p class="opacity-90">Blaan music and dance are integral to their culture, often performed during festivals, rituals, and community celebrations.</p>
                </div>
                
                <div class="bg-white bg-opacity-10 p-8 rounded-xl backdrop-filter backdrop-blur-sm card-hover">
                    <img src="<?php echo e(asset('images/blaan-handicrafts.jpg')); ?>" alt="Blaan Handicrafts" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold mb-3">Handicrafts</h3>
                    <p class="opacity-90">Blaan handicrafts, such as woven baskets, mats, and jewelry, showcase their creativity and craftsmanship passed down through generations.</p>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="<?php echo e(route('blaan')); ?>" class="inline-block border-2 border-white text-white hover:bg-white hover:text-green-700 px-8 py-3 rounded-full font-semibold transition-all">
                    Learn More About Blaan Culture
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6 mt-auto">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Blaan Learning</h3>
                    <p class="text-gray-400">Preserving and sharing Blaan knowledge through technology.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:text-white">Dashboard</a></li>
                        <li><a href="<?php echo e(route('translate')); ?>" class="text-gray-400 hover:text-white">Translate</a></li>
                        <li><a href="<?php echo e(route('features')); ?>" class="text-gray-400 hover:text-white">Features</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Resources</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="<?php echo e(route('blaan')); ?>" class="hover:text-white">Blaan Language</a></li>
                        <li><a href="#" class="hover:text-white">Cultural Resources</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                            <span>General Santos City, Philippines</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>info@BlaanLearning.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; <?php echo e(date('Y')); ?> Blaan Learning. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle mobile menu
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
            
            // Toggle user dropdown
            const userButton = document.getElementById('user-dropdown-button');
            const userDropdown = document.getElementById('user-dropdown');
            
            userButton.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', (e) => {
                if (!userButton.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
                if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Blaan_Multi_Role\resources\views/features.blade.php ENDPATH**/ ?>