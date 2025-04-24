<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JACO- Learning Platform</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/min/tiny-slider.js"></script>
    <style>
        :root {
            --primary: #2C5530;
            --secondary: #8B4513;
            --accent: #E86F52;
            --background: #FAF6F1;
            --text: #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            line-height: 1.6;
        }

        /* Header Styles */
        header {
            background-color: white;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: bold;
        }

        nav a {
            color: var(--text);
            text-decoration: none;
            margin-left: 2rem;
            font-weight: 500;
        }

        .btn {
            margin-left: 10px;
            background-color: var(--accent);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Hero Section */
        .hero {
            background-image: url("img/iw-2024-philippines.jpg");
            background-size: cover;
            background-position: center;
            height: 80vh;

            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-top: 60px;
            margin-left: 10px;
            margin-right: 10px;
        }


        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-family: Georgia, serif;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        /* Features Section */
        .features {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Languages Section */
        .languages {
            background-color: white;
            padding: 4rem 2rem;
        }

        .language-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 2rem auto;
        }

        .language-card {
            background: var(--background);
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .language-card:hover {
            transform: translateY(-5px);
        }

        .language-icon {
            width: 80px;
            height: 80px;
            background-color: var(--primary);
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }

        .language-description {
            margin: 1rem 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* How It Works Section */
        .how-it-works {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .step {
            text-align: center;
            padding: 2rem;
        }

        /* Testimonials Section */
        .testimonials {
            background-color: white;
            padding: 4rem 2rem;
        }

        .testimonial-slider {
            max-width: 800px;
            margin: 2rem auto;
        }

        .testimonial {
            text-align: center;
            padding: 2rem;
        }

        /* CTA Section */
        .cta {
            background-color: var(--primary);
            color: white;
            text-align: center;
            padding: 4rem 2rem;
        }

        /* Footer */
        footer {
            background-color: var(--text);
            color: white;
            padding: 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero-content h1 {
                font-size: 2rem;
            }
        }

        /* Section Styling */
        .language-section {
            background-color: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .language-section h2 {
            font-size: 2rem;
            color: #2c6e49;
            /* Green color for title */
            margin-bottom: 10px;
        }

        .language-section h3 {
            font-size: 1.5rem;
            color: #2c6e49;
            /* Green color for subheading */
            margin-top: 20px;
        }

        .language-section p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-top: 10px;
            color: #555;
        }

        /* Button Styling */
        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            background-color: #2c6e49;
            /* Green background */
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1b4d33;
            /* Darker green on hover */
            cursor: pointer;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .language-section {

                padding: 40px;
            }

            .language-section h2 {
                font-size: 1.8rem;
            }

            .language-section h3 {
                font-size: 1.3rem;
            }

            .language-section p {
                margin-top: 10px;
                font-size: 1rem;
            }

            .btn {
                padding: 10px 15px;
            }
        }

        /* culture section*/

        .culture-section {
            background-color: white;
            font-size: 25px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            /* Adds shadow effect */
            margin-bottom: 20px;
            text-align: center;
            /* Centers content */
        }

        .culture-image-container {
            margin-bottom: 20px;
            /* Adds space below the image */
        }

        .culture-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            /* Optional: Adds rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Adds shadow to the image */
        }

        /* Flyout Menu Styles */
        .flyout-menu {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.95);
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            z-index: 1000;
            width: 90%;
            max-width: 1200px;
        }

        .flyout-menu.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            visibility: visible;
        }

        .level-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 40px;
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .level-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid #edf2f7;
            opacity: 0;
            transform: translateY(20px);
            position: relative;
            overflow: hidden;
        }

        .level-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #ff9500);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .level-box:hover::before {
            transform: scaleX(1);
        }

        .flyout-menu.active .level-box {
            opacity: 1;
            transform: translateY(0);
        }

        /* Staggered animation for level boxes */
        .flyout-menu.active .level-box:nth-child(1) {
            transition-delay: 0.1s;
        }

        .flyout-menu.active .level-box:nth-child(2) {
            transition-delay: 0.2s;
        }

        .flyout-menu.active .level-box:nth-child(3) {
            transition-delay: 0.3s;
        }

        .level-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .level-box h4 {
            color: #2d3748;
            font-size: 1.8em;
            margin-bottom: 15px;
        }

        .level-box p {
            color: #718096;
            margin-bottom: 25px;
            font-size: 1.1em;
        }

        .level-box .btn {
            background: transparent;
            color: #1a365d;
            border: 2px solid #1a365d;
            padding: 12px 25px;
            font-size: 1em;
        }

        .level-box .btn:hover {
            background: #1a365d;
            color: white;
        }

        /* Overlay Styles */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.4s;
            z-index: 999;
        }

        .flyout-menu.active+.overlay {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>

<body>
    <header>
        <div class="nav-container">
            <a href="<?php echo e(route('dashboard')); ?>" class="logo" style="text-decoration: none; display: inline-block; padding: 12px 20px; ">Indigenous Learn</a>
            <nav class="nav-links">
                <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                <a href="<?php echo e(route('translate')); ?>">Translate</a>
                <a href="<?php echo e(route('features')); ?>">Features</a>
                <a href="<?php echo e(route('logout')); ?>" class="block px-4 py-2 text-gray-800 hover:bg-indigo-50">
                    Logout
                </a>

            </nav>
        </div>
    </header>

    <main>
        <section id="blaan-culture" class="culture-section">
            <h2>Blaan Culture</h2>
            <div class="culture-image-container">
                <img src="<?php echo e(asset('images/blaanCulture.png')); ?>" alt="Blaan Culture" class="culture-image">
            </div>
            <p>Experience the unique and beautiful culture of the Bla’an people, known for their vibrant dances, colorful attire, traditional music, and rich history. The Bla’an people hold a deep respect for nature, with traditions that reflect harmony and balance with their environment.</p>
            <p>Learn about their customs, rituals, and way of life that have been passed down through generations, preserving their cultural heritage and identity.</p>
        </section>

        <section id="blaan-language" class="language-section">
            <h2>Blaan Language</h2>
            <p>Welcome to the Blaan language page! Here, you can explore the rich and vibrant language of the Blaan people, cherished by communities in South Cotabato and Sarangani.</p>
            <h3>Unique Expressions</h3>
            <p>Delve into common expressions, phrases, and unique words that embody the culture and traditions of the Blaan people.</p>
            <button id="start-learning-btn" class="btn">Start Learning Blaan</button>
        </section>

        <div id="flyout-menu" class="flyout-menu">
            <div class="level-container">
                <div class="level-box">
                    <h4>Basic Level</h4>
                    <p>Get started with the basics of the Blaan language, including common phrases and introductory grammar.</p>
                    <a href="<?php echo e(route('blaanLevel')); ?>" class="btn">Learn Basic</a>
                </div>
                <div class="level-box">
                    <h4>Intermediate Level</h4>
                    <p>Build upon your foundational knowledge with more complex sentences, vocabulary, and cultural nuances.</p>
                    <a href="" class="btn">Learn Intermediate</a>
                </div>
                <div class="level-box">
                    <h4>Advanced Level</h4>
                    <p>Master the Blaan language with in-depth conversations, advanced grammar, and fluency-focused lessons.</p>
                    <a href="#" class="btn">Learn Advanced</a>
                </div>
            </div>
        </div>
        <div id="overlay" class="overlay"></div>
        </div>

    </main>


    <section id="languages" class="languages">
        <h2>Available Languages</h2>
        <div class="language-grid">
            <div class="language-card">
                <div class="language-icon">B</div>
                <h3>Blaan</h3>
                <p class="language-description">Discover the rich language of the Blaan people from South Cotabato and Sarangani. Learn the unique expressions and cultural wisdom passed down through generations.</p>
                <a href=" " class="btn">Start Learning</a>
            </div>

    </section>


    <section id="how-it-works" class="how-it-works">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step">
                <h3>Step 1</h3>
                <p>Choose your language and create your profile</p>
            </div>
            <div class="step">
                <h3>Step 2</h3>
                <p>Start with basic lessons and progress through interactive games</p>
            </div>
            <div class="step">
                <h3>Step 3</h3>
                <p>Track your progress and earn achievement badges</p>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <h2>What Our Learners Say</h2>
        <div class="testimonial-slider">
            <div class="testimonial">
                <p>"This platform has helped me reconnect with my cultural heritage in ways I never thought possible."</p>
                <cite>- Sarah Mansul</cite>
            </div>
        </div>
    </section>

    <section class="cta">
        <h2>Join the Movement to Preserve Indigenous Languages!</h2>
        <p>Start your journey today and help keep our cultural heritage alive.</p>
        <a href="<?php echo e(route('register')); ?>" class="btn">Sign Up Today</a>
    </section>

    <footer>
        <div class="footer-content">
            <div>
                <h3>Quick Links</h3>
                <p>About Us</p>
                <p>Privacy Policy</p>
                <p>Terms of Service</p>
            </div>
            <div>
                <h3>Contact</h3>
                <p>Email: contact@indigenouslearn.com</p>
                <p>Phone: (555) 123-4567</p>
            </div>
            <div>
                <h3>Follow Us</h3>
                <p>Facebook</p>
                <p>Twitter</p>
                <p>Instagram</p>
            </div>
        </div>
    </footer>

    <script>
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        //Flyoutmenu//
        const startLearningBtn = document.getElementById('start-learning-btn');
        const flyoutMenu = document.getElementById('flyout-menu');
        const overlay = document.getElementById('overlay');

        startLearningBtn.addEventListener('click', () => {
            flyoutMenu.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            flyoutMenu.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Close flyout when clicking outside
        document.addEventListener('click', (event) => {
            if (!flyoutMenu.contains(event.target) &&
                !startLearningBtn.contains(event.target)) {
                flyoutMenu.classList.remove('active');
                overlay.classList.remove('active');
            }
        });

        // Prevent closing when clicking inside flyout
        flyoutMenu.addEventListener('click', (event) => {
            event.stopPropagation();
        });

        document.getElementById('start-learning-btn').addEventListener('click', function() {
            // Get the flyout menu element
            const flyoutMenu = document.getElementById('flyout-menu');

            // Scroll to the flyout menu with smooth behavior
            flyoutMenu.scrollIntoView({
                behavior: 'smooth',
                block: 'center' // Ensures the flyout menu is centered in view
            });
        });
    </script>
</body>

</html><?php /**PATH G:\xampp\htdocs\Blaan_Multi_Role\resources\views/blaan.blade.php ENDPATH**/ ?>