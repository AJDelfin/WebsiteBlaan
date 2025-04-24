<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const userName = "<?php echo e(Auth::user()->name); ?>";
            const showToast = "<?php echo e(session('show_login_toast')); ?>";

            if (showToast) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: `Welcome back, ${userName}!`,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#2C5530',
                    color: '#fff',
                    iconColor: '#FFD700'
                });
            }
        });
    </script>

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
            background-color: var(--light-bg);
            color: var(--dark-text);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
        }

        /* Modern Header */
        .modern-header {
            background: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 1rem 2rem;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            color: var(--gold);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            font-size: 1rem;
            font-weight: 500;
            color: var(--dark-text);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .logout-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(44, 85, 48, 0.15);
        }

        .modern-hero {
    background: 
        linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
        url("<?php echo e(asset('images/iw-2024-philippines.jpg')); ?>");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 80vh;
    display: flex;
    align-items: center;
    padding: 0 2rem;
    margin-top: 0;
}

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            color: var(--white);
            padding: 4rem 0;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            max-width: 800px;
        }

        .hero-content p {
            font-size: 1.25rem;
            max-width: 600px;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        .cta-btn {
            background: var(--primary);
            color: var(--light-bg);
            padding: 1rem 2.5rem;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgb(14, 68, 28);
            border: none;
            cursor: pointer;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(13, 197, 44, 0.4);
        }

        /* Features Section */
        .features-section {
            padding: 6rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--primary);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
        }

        .feature-card {
            background: var(--white);
            border-radius: 12px;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(44, 85, 48, 0.1);
            border-radius: 50%;
        }

        .feature-icon svg {
            width: 40px;
            height: 40px;
            color: var(--primary);
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--dark-text);
        }

        .feature-card p {
            color: var(--gray-text);
            line-height: 1.7;
        }

        /* Language Flyout */
        .flyout-menu {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1000;
            width: 90%;
            max-width: 1000px;
            background: var(--white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .flyout-menu.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            visibility: visible;
        }

        .language-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .language-box {
            background: var(--light-bg);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .language-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            border-color: var(--primary);
        }

        .language-box img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            border: 3px solid var(--white);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .language-box h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .language-box p {
            color: var(--gray-text);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .language-btn {
            background: var(--primary);
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .language-btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        /* How It Works */
        .steps-section {
            padding: 6rem 2rem;
            background: var(--white);
        }

        .steps-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .step-card {
            background: var(--light-bg);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .step-number {
            font-size: 3rem;
            font-weight: 800;
            color: rgba(44, 85, 48, 0.1);
            position: absolute;
            top: 1rem;
            right: 1rem;
            line-height: 1;
        }

        .step-card h3 {
            font-size: 1.5rem;
            margin: 1rem 0;
            color: var(--primary);
        }

        .step-card p {
            color: var(--gray-text);
        }

        /* Testimonials */
        .testimonials-section {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2.5rem;
            border-radius: 12px;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .testimonial-text {
            font-size: 1.25rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .testimonial-author {
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 2rem;
            text-align: center;
            background: var(--light-bg);
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        .cta-subtitle {
            font-size: 1.25rem;
            color: var(--gray-text);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Footer */
        .modern-footer {
            background: var(--dark-text);
            color: var(--white);
            padding: 4rem 2rem 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .footer-links h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .footer-links a {
            display: block;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.8rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--gold);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 3rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .flyout-menu {
                padding: 2rem 1.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .hero-content p {
                font-size: 1rem;
            }
            
            .cta-btn {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>

    

    <!-- Hero Section -->
    <section class="modern-hero">
        <div class="hero-content">
            <h1>Revitalize Your Heritage Through Language</h1>
            <p>An immersive platform preserving Blaan languages through interactive learning and cultural storytelling.</p>
            <button id="start-learning-btn" class="cta-btn">Start Learning</button>
        </div>
    </section>

    <!-- Language Flyout Menu -->
    <div id="flyout-menu" class="flyout-menu">
        <h2 class="section-title" style="color: var(--primary); text-align: center; margin-bottom: 2rem;">Choose Your Language</h2>
        <div class="language-container">
            <div class="language-box">
                <img src="<?php echo e(asset('images/BlaanTibe.png')); ?>" alt="Blaan Culture">
                <h3>Blaan</h3>
                <p>Explore the rich heritage and unique expressions of the Blaan language, spoken in South Cotabato and Sarangani.</p>
                <a href="<?php echo e(route('blaan')); ?>" class="language-btn">Learn Blaan</a>
            </div>
            <!-- Add more language boxes as needed -->
        </div>
    </div>

    <div id="overlay" class="overlay"></div>

    <!-- Features Section -->
    <section class="features-section">
        <h2 class="section-title">Why Choose Blaan Learning?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h3>Interactive Learning</h3>
                <p>Engage with gamified lessons that make language acquisition fun and memorable through interactive exercises.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3>Cultural Stories</h3>
                <p>Immerse yourself in traditional narratives that preserve and share the wisdom of Blaan communities.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                    </svg>
                </div>
                <h3>Native Speaker Audio</h3>
                <p>Learn authentic pronunciation from community elders through high-quality audio recordings.</p>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="steps-section">
        <h2 class="section-title">How It Works</h2>
        <div class="steps-container">
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Choose Your Language</h3>
                    <p>Select from our growing collection of Blaan languages to begin your learning journey.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Interactive Lessons</h3>
                    <p>Progress through engaging modules that combine vocabulary, grammar, and cultural context.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Track Your Progress</h3>
                    <p>Monitor your improvement and earn achievements as you master new language skills.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <h2 class="section-title" style="color: white;">Voices From Our Community</h2>
        <div class="testimonial-card">
            <p class="testimonial-text">"This platform has helped me reconnect with my cultural heritage in ways I never thought possible. I can now speak basic Blaan with my grandparents!"</p>
            <p class="testimonial-author">- Sarah Mansul, Blaan Learner</p>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Begin Your Journey?</h2>
            <p class="cta-subtitle">Join our community of learners and help preserve Blaan languages for future generations.</p>
            <a href="<?php echo e(route('register')); ?>" class="cta-btn">Get Started Today</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="modern-footer">
        <div class="footer-grid">
            <div>
                <a href="<?php echo e(route('dashboard')); ?>" class="footer-logo">Blaan Learning</a>
                <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 1.5rem;">Preserving cultural heritage through language education.</p>
            </div>
            <div class="footer-links">
                <h3>Explore</h3>
                <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                <a href="<?php echo e(route('translate')); ?>">Translate</a>
                <a href="<?php echo e(route('features')); ?>">Features</a>
            </div>
            <div class="footer-links">
                <h3>Company</h3>
                <a href="#">About Us</a>
                <a href="#">Contact</a>
                <a href="#">Careers</a>
            </div>
            <div class="footer-links">
                <h3>Legal</h3>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?php echo e(date('Y')); ?> Blaan Learning. All rights reserved.
        </div>
    </footer>

    <script>
        // Flyout menu functionality
        const startLearningBtn = document.getElementById('start-learning-btn');
        const flyoutMenu = document.getElementById('flyout-menu');
        const overlay = document.getElementById('overlay');

        startLearningBtn.addEventListener('click', () => {
            flyoutMenu.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        overlay.addEventListener('click', () => {
            flyoutMenu.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Animate elements when they come into view
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.feature-card, .step-card');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                
                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        // Set initial state for animation
        document.querySelectorAll('.feature-card, .step-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
        });

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH G:\xampp\htdocs\Blaan_Multi_Role\resources\views/dashboard.blade.php ENDPATH**/ ?>