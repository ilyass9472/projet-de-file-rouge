<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Interactive Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .hero-gradient {
            background: linear-gradient(135deg,rgb(10, 25, 90),rgb(55, 67, 117),rgb(107, 3, 10),rgb(0, 0, 0), rgb(131, 127, 127), rgb(255, 255, 255));
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .text-gradient {
            background: linear-gradient(to right, #820c0c, #1a0e81);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cursor-glow {
            width: 20px;
            height: 20px;
            background: rgba(0, 0, 0, 0.442);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="cursor-glow hidden md:block"></div>
    <nav class="fixed w-full bg-white/80 backdrop-blur-md z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <span class="text-2xl font-bold text-gradient">Highway</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="nav-link text-gray-600 hover:text-indigo-600 transition-colors">Home</a>
                    <a href="#services" class="nav-link text-gray-600 hover:text-indigo-600 transition-colors">Services</a>
                    <a href="#about" class="nav-link text-gray-600 hover:text-indigo-600 transition-colors">About</a>
                    <a href="#contact" class="nav-link text-gray-600 hover:text-indigo-600 transition-colors">Contact</a>
                    <button onclick="window.location.href='./login'" class="bg-red-800 text-white px-6 py-2 rounded-full hover:bg-red-900 transition-colors">
                       Get Started
                    </button>
                   
                </div>

                <button class="md:hidden text-gray-600" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white/80 backdrop-blur-md">
                <a href="#home" class="block px-3 py-2 text-gray-600 hover:text-indigo-600">Home</a>
                <a href="#services" class="block px-3 py-2 text-gray-600 hover:text-indigo-600">Services</a>
                <a href="#about" class="block px-3 py-2 text-gray-600 hover:text-indigo-600">About</a>
                <a href="#contact" class="block px-3 py-2 text-gray-600 hover:text-indigo-600">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient min-h-screen flex items-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white" data-aos="fade-right">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        On The Highway
                    </h1>
                    <p class="text-xl mb-8 text-indigo-100">
                        our services help your life.
                    </p>
                    <div class="flex space-x-4">
                        <button class="bg-white text-indigo-600 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition-colors">
                            Get Started
                        </button>
                        <button class="border-2 border-white text-white px-8 py-3 rounded-full font-medium hover:bg-white hover:text-indigo-600 transition-colors">
                            Learn More
                        </button>
                    </div>
                </div>
                <div class="hidden md:block" data-aos="fade-left">
                    <img src="https://images.pexels.com/photos/315938/pexels-photo-315938.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Hero Image" class="rounded-lg shadow-2xl floating">
                </div>
            </div>
        </div>
    </section>

    
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Services</h2>
                <p class="text-xl text-gray-600">Discover what we can do for you</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">

                <div class="card-hover bg-gray-50 rounded-xl p-8 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-road"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Signalement de Problèmes</h3>
                    <p class="text-gray-600">Identifiez et signalez facilement les problèmes routiers</p>
                </div>

                <div class="card-hover bg-gray-50 rounded-xl p-8 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Suivi des Problèmes</h3>
                    <p class="text-gray-600">Suivez l'état de vos signalements en temps réel</p>
                </div>

                <div class="card-hover bg-gray-50 rounded-xl p-8 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-indigo-600 text-4xl mb-4">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">UI/UX Design</h3>
                    <p class="text-gray-600">Beautiful and functional user experiences.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <img src="https://via.placeholder.com/600x400" alt="About Us" class="rounded-lg shadow-xl">
                </div>
                <div data-aos="fade-left">
                    <h2 class="text-3xl font-bold mb-6">À Propos de SafeRoute</h2>
                    <p class="text-gray-600 mb-6">
                        Notre mission est d'améliorer la sécurité routière en permettant aux citoyens de signaler 
                        rapidement et facilement les problèmes sur les routes. Nous collaborons avec les autorités 
                        locales pour résoudre les problèmes et créer des infrastructures plus sûres.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <div class="text-3xl font-bold text-indigo-600 mb-2">500+</div>
                            <div class="text-gray-600">Problèmes Signalés</div>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <div class="text-3xl font-bold text-indigo-600 mb-2">100%</div>
                            <div class="text-gray-600">Problèmes Résolus</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Get In Touch</h2>
                <p class="text-xl text-gray-600">Let's discuss your quetion</p>
            </div>
            
            <div class="max-w-3xl mx-auto">
                <form class="space-y-6" data-aos="fade-up">
                    <div class="grid md:grid-cols-2 gap-6">
                        <input type="text" placeholder="Name" class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <input type="email" placeholder="Email" class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <input type="text" placeholder="Subject" class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    <textarea rows="5" placeholder="Message" class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-colors">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Brand</h3>
                    <p class="text-gray-400">Creating amazing digital experiences.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Services</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-phone mr-2"></i> (123) 456-7890</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@example.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> 123 Street, City, Country</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Brand. All rights reserved.</p>
            </div>
        </div>
    </footer>

    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        
        const cursor = document.querySelector('.cursor-glow');
        
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX - 10 + 'px';
            cursor.style.top = e.clientY - 10 + 'px';
        });

        
        const navbar = document.querySelector('nav');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 0) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });

        
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>