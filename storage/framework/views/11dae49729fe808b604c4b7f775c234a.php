<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blaan Indigenous Learning Center</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', 'Noto Sans', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #1a5f2c, #2b6e3a, #4a8c5d);
        }
        
        .blaan-pattern-bg {
            background-color: #2b6e3a;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234a8c5d' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
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
            background-color: #4a8c5d;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
        
        /* Fixed aspect ratio hero section */
        .hero-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            overflow: hidden;
        }
        
        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("<?php echo e(asset('images/MaligyaElemSchool.jpg')); ?>");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            width: 100%;
            padding: 0 1.5rem;
        }
        
        .culture-icon {
            color: #d4a017;
        }
        
        .language-badge {
            background-color: #d4a017;
            color: white;
        }
        
        @media (max-width: 768px) {
            .hero-container {
                padding-bottom: 75%; /* Taller aspect ratio for mobile */
            }
        }
        
        /* School logo styling */
        .school-logo {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Top Bar -->
    <div class="blaan-pattern-bg text-white text-sm py-2 px-6">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex space-x-4">
                <span><i class="fas fa-phone-alt mr-2"></i> (083) 123-4567</span>
                <span><i class="fas fa-envelope mr-2"></i> blaan.learning@example.com</span>
            </div>
            
        </div>
    </div>

    <!-- Navbar with School Logo -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <!-- School Logo -->
                    <img src="<?php echo e(asset('images/MaligyaElemSchool.jpg')); ?>" alt="Maligaya Elementary School Logo" class="school-logo rounded-full border-2 border-green-600">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Blaan Learning</h1>
                        <p class="text-xs text-gray-600">Maligaya Elementary School, General Santos</p>
                    </div>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="<?php echo e(route('welcome')); ?>" class="nav-link text-gray-800 hover:text-green-700 font-medium">Home</a>
                    <a href="#" class="nav-link text-gray-800 hover:text-green-700 font-medium">Language Program</a>

                    
                    <!-- Login Dropdown -->
<div class="relative">
    <button id="login-dropdown-button" class="flex items-center space-x-1 text-gray-800 hover:text-green-700 focus:outline-none font-medium">
        <span>Login/Register</span>
        <i class="fas fa-chevron-down text-xs"></i>
    </button>
    <div id="login-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
        <?php if(auth()->guard('web')->check()): ?>
        <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
            <?php echo csrf_field(); ?>
            <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                Logout
            </button>
        </form>
        <?php else: ?>
        <!-- Student Section -->
        <div class="border-b border-gray-100">
            <a href="<?php echo e(route('login')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center">
                    <i class="fas fa-user-graduate mr-3 text-gray-500"></i>
                    <div>
                        <div class="font-medium">Student Login</div>
                        <div class="text-xs text-gray-500">For learners</div>
                    </div>
                </div>
            </a>
            <a href="<?php echo e(route('register')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center">
                    <i class="fas fa-user-plus mr-3 text-gray-500"></i>
                    <div>
                        <div class="font-medium">Student Register</div>
                        <div class="text-xs text-gray-500">New student account</div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Staff Section -->
        <div>
            <a href="<?php echo e(route('teacher.login')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-100">
                <div class="flex items-center">
                    <i class="fas fa-chalkboard-teacher mr-3 text-blue-500"></i>
                    <div>
                        <div class="font-medium">Teacher Login</div>
                        <div class="text-xs text-gray-500">For educators</div>
                    </div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.login')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <div class="flex items-center">
                    <i class="fas fa-user-shield mr-3 text-red-500"></i>
                    <div>
                        <div class="font-medium">Admin Login</div>
                        <div class="text-xs text-gray-500">For administrators</div>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
                </nav>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-800 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            
            <!-- Mobile menu -->
<div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
    <a href="<?php echo e(route('welcome')); ?>" class="block py-2 text-gray-800 hover:text-green-700">Home</a>
    <a href="#" class="block py-2 text-gray-800 hover:text-green-700">Language Program</a>
    <div class="border-t border-gray-200 mt-2 pt-2">
        <div class="font-medium text-sm px-4 py-2 text-gray-500">Students</div>
        <a href="<?php echo e(route('login')); ?>" class="block px-6 py-2 text-sm text-gray-800 hover:text-green-700">Login</a>
        <a href="<?php echo e(route('register')); ?>" class="block px-6 py-2 text-sm text-gray-800 hover:text-green-700">Register</a>
        
        <div class="font-medium text-sm px-4 py-2 text-gray-500 mt-2">Staff</div>
        <a href="<?php echo e(route('teacher.login')); ?>" class="block px-6 py-2 text-sm text-gray-800 hover:text-green-700">Teacher Login</a>
        <a href="<?php echo e(route('admin.login')); ?>" class="block px-6 py-2 text-sm text-gray-800 hover:text-green-700">Admin Login</a>
    </div>
</div>
    </header>

    <!-- Hero Section with Fixed Aspect Ratio -->
    <div class="hero-container">
        <div class="hero-image">
            <div class="hero-content container mx-auto">
                <div class="max-w-2xl">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight text-white">Learn Blaan Traditions <br>With Our Community</h1>
                    <p class="text-xl mb-8 text-white">Open to all who wish to learn - Blaan and non-Blaan alike. Discover the rich heritage of the Blaan people.</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="<?php echo e(route('login')); ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-8 py-3 rounded-full font-semibold text-center transition-all">
                            Start Learning
                        </a>
                        <a href="#" class="bg-white hover:bg-gray-100 text-green-700 px-8 py-3 rounded-full font-semibold text-center transition-all">
                            Our Programs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rest of your content remains the same -->
    <!-- Cultural Values Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Blaan Cultural Values</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We integrate these core Blaan values into all our learning programs</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-hands-helping culture-icon text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Kanduli (Community)</h3>
                    <p class="text-gray-600">Emphasizing collective well-being and mutual support within the community.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-mountain culture-icon text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Fulu (Land Stewardship)</h3>
                    <p class="text-gray-600">Teaching respect and care for the ancestral lands and environment.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-book culture-icon text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Temu (Wisdom)</h3>
                    <p class="text-gray-600">Preserving and passing down traditional knowledge and oral histories.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Learning Programs -->
    <section class="py-16 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Our Learning Programs</h2>
                <p class="max-w-2xl mx-auto opacity-90">Open to all who wish to learn about Blaan language</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white bg-opacity-10 p-8 rounded-xl backdrop-filter backdrop-blur-sm card-hover">
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-language text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center">Blaan Language</h3>
                    <p class="text-center opacity-90">Learn basic Blaan phrases and conversation for daily communication.</p>
                    <div class="mt-4 text-center">
                        <span class="text-xs bg-white bg-opacity-20 px-3 py-1 rounded-full">All Ages</span>
                    </div>
                </div>
              <div class="bg-white bg-opacity-10 p-8 rounded-xl backdrop-filter backdrop-blur-sm card-hover">
    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6 mx-auto">
        <i class="fas fa-language text-2xl"></i>
    </div>
    <h3 class="text-xl font-semibold mb-3 text-center">Basic Blaan Vocabulary</h3>
    <p class="text-center opacity-90">Learn essential Blaan words and phrases for everyday communication.</p>
    <div class="mt-4 text-center">
        <span class="text-xs bg-white bg-opacity-20 px-3 py-1 rounded-full">All Ages</span>
    </div>
</div>
<div class="bg-white bg-opacity-10 p-8 rounded-xl backdrop-filter backdrop-blur-sm card-hover">
    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6 mx-auto">
        <i class="fas fa-book text-2xl"></i>
    </div>
    <h3 class="text-xl font-semibold mb-3 text-center">Blaan Grammar</h3>
    <p class="text-center opacity-90">Understand the structure and rules of the Blaan language.</p>
    <div class="mt-4 text-center">
        <span class="text-xs bg-white bg-opacity-20 px-3 py-1 rounded-full">Teens & Adults</span>
    </div>
</div>
<div class="bg-white bg-opacity-10 p-8 rounded-xl backdrop-filter backdrop-blur-sm card-hover">
    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6 mx-auto">
        <i class="fas fa-comments text-2xl"></i>
    </div>
    <h3 class="text-xl font-semibold mb-3 text-center">Conversational Blaan</h3>
    <p class="text-center opacity-90">Practice common dialogues and speaking patterns in Blaan.</p>
    <div class="mt-4 text-center">
        <span class="text-xs bg-white bg-opacity-20 px-3 py-1 rounded-full">All Ages</span>
    </div>
</div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block border-2 border-white text-white hover:bg-white hover:text-green-700 px-8 py-3 rounded-full font-semibold transition-all">
                    View All Programs
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">What Learners Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Hear from both Blaan and non-Blaan participants in our programs</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                            
                        </div>
                        <div>
                            <h4 class="font-semibold">Lina Fulong</h4>
                            <p class="text-sm text-gray-600">Blaan Community Member</p>
                        </div>
                    </div>
                    <p class="italic text-gray-700">"As a Blaan youth, these programs help me connect with my heritage in ways my parents couldn't teach me alone."</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                            
                        </div>
                        <div>
                            <h4 class="font-semibold">Miguel Santos</h4>
                            <p class="text-sm text-gray-600">Teacher from General Santos</p>
                        </div>
                    </div>
                    <p class="italic text-gray-700"> </p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                            
                        </div>
                        <div>
                            <h4 class="font-semibold">Sarah Johnson</h4>
                            <p class="text-sm text-gray-600">Anthropology Student</p>
                        </div>
                    </div>
                    <p class="italic text-gray-700">"The weaving workshop gave me deep appreciation for Blaan artistry that no textbook could convey."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 blaan-pattern-bg text-white">
        <div class="container mx-auto px-6 text-center">
          
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="<?php echo e(route('register')); ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-8 py-3 rounded-full font-semibold inline-block transition-all">
                    Register Now
                </a>
                <a href="#" class="border-2 border-white text-white hover:bg-white hover:text-green-700 px-8 py-3 rounded-full font-semibold inline-block transition-all">
                    Visit Our Center
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-6">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Blaan Indigenous Learning</h3>
                    <p class="text-gray-400">Preserving and sharing Blaan Lnauguage through education at Maligaya Elementary School.</p>
                    <div class="mt-4">
                        <span class="text-sm text-gray-400">Open to all learners</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Language Program</a></li>
                       
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Programs</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Language Classes</a></li>
                        <li><a href="#" class="hover:text-white">Cultural Workshops</a></li>
                        <li><a href="#" class="hover:text-white">School Integration</a></li>
                        <li><a href="#" class="hover:text-white">Community Events</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                            <span>Maligaya Elementary School, Southern Faltina District, General Santos</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3"></i>
                            <span>(083) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>blaan.learning@example.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; <?php echo e(date('Y')); ?> Blaan Indigenous Learning Center. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Cultural Sensitivity</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Terms of Participation</a>
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
            
            // Toggle login dropdown
            const loginButton = document.getElementById('login-dropdown-button');
            const loginDropdown = document.getElementById('login-dropdown');
            
            loginButton.addEventListener('click', (e) => {
                e.stopPropagation();
                loginDropdown.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!loginButton.contains(e.target) && !loginDropdown.contains(e.target)) {
                    loginDropdown.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Blaan_Multi_Role\resources\views/welcome.blade.php ENDPATH**/ ?>