@extends('layouts.app')

@section('content')
<!-- Hero Section with Futuristic Background -->
<div class="relative min-h-screen bg-gradient-to-b from-gray-900 via-purple-900 to-gray-900 overflow-hidden">
    <!-- Animated background elements -->
    <div class="absolute inset-0 overflow-hidden z-0">
        <div class="absolute -top-10 left-1/4 w-72 h-72 bg-blue-500/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 right-1/4 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-indigo-500/30 rounded-full blur-3xl"></div>
        <!-- Grid pattern overlay -->
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="relative z-10 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-white font-bold text-2xl tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-600">AutoAI</span>
            </div>
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#benefits" class="text-gray-300 hover:text-white transition-colors">Benefits</a>
                <a href="#how-it-works" class="text-gray-300 hover:text-white transition-colors">How it Works</a>
                <a href="#technologies" class="text-gray-300 hover:text-white transition-colors">Technologies</a>
                <a href="#features" class="text-gray-300 hover:text-white transition-colors">Key Features</a>
                <a href="#pricing" class="text-gray-300 hover:text-white transition-colors">Pricing</a>
                <a href="#contact" class="px-4 py-2 rounded-md border border-purple-500 text-white hover:bg-purple-500/20 transition-colors">Contact Us</a>
                <a href="/login" class="px-4 py-2 rounded-md bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 transition-colors">Login</a>
            </div>
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 md:py-28">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                AI-Powered Car Damage <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-600">Assessment in Minutes</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-3xl mx-auto">
                Upload photos of your damaged car and instantly calculate repair costs.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4 mb-16">
                <a href="#upload" class="px-8 py-4 rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium hover:from-blue-700 hover:to-purple-700 transform hover:-translate-y-1 transition-all duration-200 shadow-lg shadow-purple-500/30">
                    Upload Photos
                </a>
                <a href="#demo" class="px-8 py-4 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20 text-white font-medium hover:bg-white/20 transform hover:-translate-y-1 transition-all duration-200">
                    Watch Demo
                </a>
            </div>
        </div>

        <!-- 3D Car Hologram - UPDATED -->
        <div class="relative max-w-3xl mx-auto">
            <div class="car-hologram-container h-96 mb-16 flex items-center justify-center">
                <!-- Hologram Platform with stronger glow -->
                <div class="hologram-base w-72 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full blur-md"></div>
                
                <!-- Vertical light beam for hologram effect -->
                <div class="light-beam absolute h-96 w-40 bottom-0 left-1/2 transform -translate-x-1/2"></div>
                
                <!-- Car Wireframe using SVG for guaranteed display -->
                <div class="car-wireframe w-64 h-48 relative">
                    <svg viewBox="0 0 800 500" class="w-full h-full car-hologram-svg">
                        <path d="M120,400 L250,400 L300,300 L500,300 L550,400 L680,400 L680,350 L650,290 L620,240 L500,200 L300,200 L180,240 L150,290 L120,350 Z" fill="none" stroke="rgba(79, 209, 255, 0.8)" stroke-width="2"></path>
                        <path d="M300,300 L300,200" fill="none" stroke="rgba(79, 209, 255, 0.8)" stroke-width="2"></path>
                        <path d="M500,300 L500,200" fill="none" stroke="rgba(79, 209, 255, 0.8)" stroke-width="2"></path>
                        <circle cx="200" cy="400" r="40" fill="none" stroke="rgba(79, 209, 255, 0.8)" stroke-width="2"></circle>
                        <circle cx="600" cy="400" r="40" fill="none" stroke="rgba(79, 209, 255, 0.8)" stroke-width="2"></circle>
                        <path d="M250,250 L550,250" fill="none" stroke="rgba(79, 209, 255, 0.8)" stroke-width="2"></path>
                        <path d="M180,240 L620,240" fill="none" stroke="rgba(79, 209, 255, 0.8)" stroke-width="2"></path>
                    </svg>
                    
                    <!-- Scanning effect -->
                    <div class="scan-line absolute top-0 left-0 w-full"></div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto mb-20">
            <div class="stat-card">
                <div class="stat-value">10,000+</div>
                <div class="stat-label">Damage assessments completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">$1,200,000+</div>
                <div class="stat-label">Saved on unnecessary repairs</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">98%</div>
                <div class="stat-label">Accuracy in cost estimation</div>
            </div>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<section id="how-it-works" class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">How It Works</h2>
            <p class="text-xl text-gray-400">Simple 3-step process to get your damage assessment</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="process-card">
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">1. Upload Photos</h3>
                <p class="text-gray-400">Take clear photos of your vehicle damage from multiple angles</p>
            </div>
            
            <div class="process-card">
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">2. AI Analysis</h3>
                <p class="text-gray-400">Our advanced AI algorithms analyze the damage in seconds</p>
            </div>
            
            <div class="process-card">
                <div class="process-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">3. Get Results</h3>
                <p class="text-gray-400">Receive a detailed assessment with cost estimates and repair recommendations</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-20 bg-gray-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Simple Pricing for Every Driver</h2>
            <p class="text-xl text-gray-400">Choose the plan that's right for you</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Free Plan -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3 class="pricing-title">Free Plan</h3>
                    <div class="pricing-price">
                        <span class="text-4xl font-bold">$0</span>
                        <span class="text-gray-400">/month</span>
                    </div>
                </div>
                
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Up to 3 assessments/month</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Basic damage assessment</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Email support</span>
                    </div>
                </div>
                
                <div class="pricing-action">
                    <a href="#signup" class="pricing-button pricing-button-outline">Get Started</a>
                </div>
            </div>
            
            <!-- Pro Plan -->
            <div class="pricing-card pricing-card-featured">
                <div class="pricing-popular">Most Popular</div>
                <div class="pricing-header">
                    <h3 class="pricing-title">Pro Plan</h3>
                    <div class="pricing-price">
                        <span class="text-4xl font-bold">$29</span>
                        <span class="text-gray-400">/month</span>
                    </div>
                </div>
                
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Unlimited assessments</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Advanced damage insights</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Priority processing</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>24/7 support</span>
                    </div>
                </div>
                
                <div class="pricing-action">
                    <a href="#signup" class="pricing-button pricing-button-filled">Get Started</a>
                </div>
            </div>
            
            <!-- Business Plan -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3 class="pricing-title">Business Plan</h3>
                    <div class="pricing-price">
                        <span class="text-4xl font-bold">$99</span>
                        <span class="text-gray-400">/month</span>
                    </div>
                </div>
                
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Unlimited assessments</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Fleet management tools</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>API access</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Dedicated account manager</span>
                    </div>
                    <div class="pricing-feature">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Custom reporting</span>
                    </div>
                </div>
                
                <div class="pricing-action">
                    <a href="#contact" class="pricing-button pricing-button-outline">Contact Sales</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to Get Started?</h2>
            <p class="text-xl text-gray-400">Contact us or create an account today</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto">
            <div>
                <h3 class="text-2xl font-bold text-white mb-6">Contact Us</h3>
                <form class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Name</label>
                        <input type="text" id="name" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-white">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                        <input type="email" id="email" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-white">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-400 mb-1">Message</label>
                        <textarea id="message" rows="4" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-white"></textarea>
                    </div>
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg text-white font-medium hover:from-blue-700 hover:to-purple-700 transition-colors">
                        Send Message
                    </button>
                </form>
            </div>
            
            <div class="flex items-center justify-center">
                <div class="text-center md:text-left">
                    <h3 class="text-2xl font-bold text-white mb-6">Our Information</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <h4 class="text-lg font-medium text-white">Address</h4>
                                <p class="text-gray-400">123 AI Boulevard, Silicon Valley, CA 94000</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <h4 class="text-lg font-medium text-white">Email</h4>
                                <p class="text-gray-400">support@autoai-damage.com</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <h4 class="text-lg font-medium text-white">Phone</h4>
                                <p class="text-gray-400">+1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-white mb-4">Follow Us</h4>
                        <div class="flex space-x-4 justify-center md:justify-start">
                            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-blue-500 hover:bg-blue-500 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-blue-500 hover:bg-blue-500 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.184 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-blue-500 hover:bg-blue-500 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.897 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.897-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800 text-blue-500 hover:bg-blue-500 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 py-12 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h3 class="text-xl font-bold text-white mb-4">AutoAI</h3>
                <p class="text-gray-400">Advanced AI-powered car damage assessment for everyone.</p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-white mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#benefits" class="hover:text-white transition-colors">Benefits</a></li>
                    <li><a href="#how-it-works" class="hover:text-white transition-colors">How it Works</a></li>
                    <li><a href="#pricing" class="hover:text-white transition-colors">Pricing</a></li>
                    <li><a href="#contact" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-medium text-white mb-4">Resources</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">API Documentation</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-medium text-white mb-4">Newsletter</h4>
                <p class="text-gray-400 mb-4">Subscribe to our newsletter for the latest updates.</p>
                <form class="flex">
                    <input type="email" placeholder="Your email" class="px-4 py-2 bg-gray-800 border border-gray-700 rounded-l-lg focus:ring-blue-500 focus:border-blue-500 text-white flex-1">
                    <button type="submit" class="px-4 py-2 bg-blue-600 rounded-r-lg text-white hover:bg-blue-700 transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
        <div class="pt-8 border-t border-gray-800 text-center text-gray-400">
            <p>&copy; 2025 AutoAI. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
    /* Custom CSS */
    .bg-grid-pattern {
        background-image: linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 30px 30px;
    }
    
    /* Enhanced car hologram styles */
    .car-hologram-svg {
        filter: drop-shadow(0 0 15px rgba(79, 209, 255, 0.8));
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .hologram-base {
        position: absolute;
        bottom: 20px;
        animation: pulse 2s ease-in-out infinite;
        box-shadow: 0 0 30px rgba(79, 209, 255, 0.9);
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
    }
    
    .scan-line {
        height: 4px;
        background: linear-gradient(to right, transparent, rgba(79, 209, 255, 0.9), transparent);
        box-shadow: 0 0 15px rgba(79, 209, 255, 1);
        animation: scan 3s ease-in-out infinite;
    }
    
    @keyframes scan {
        0% { top: 0; opacity: 1; }
        50% { opacity: 0.7; }
        100% { top: 100%; opacity: 1; }
    }
    
    /* Vertical beam effect - Changed to emergency light colors */
    .light-beam {
        background: linear-gradient(to top, 
                        rgba(220, 38, 38, 0.05) 0%, 
                        rgba(220, 38, 38, 0.2) 20%, 
                        rgba(220, 38, 38, 0.3) 40%, 
                        rgba(30, 64, 175, 0.3) 60%, 
                        rgba(30, 64, 175, 0.2) 80%, 
                        rgba(30, 64, 175, 0.05) 100%);
        animation: emergency-lights 3s infinite;
    }
    
    @keyframes emergency-lights {
        0% { opacity: 0.6; filter: hue-rotate(0deg); }
        33% { opacity: 0.9; filter: hue-rotate(15deg); }
        66% { opacity: 0.7; filter: hue-rotate(-15deg); }
        100% { opacity: 0.6; filter: hue-rotate(0deg); }
    }
    
    .stat-card {
        background: rgba(30, 41, 59, 0.5);
        border: 1px solid rgba(96, 165, 250, 0.2);
        backdrop-filter: blur(4px);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, #60a5fa, #c084fc);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .stat-label {
        color: #a1a1aa;
    }
    
    .process-card {
        background: rgba(30, 41, 59, 0.5);
        border: 1px solid rgba(96, 165, 250, 0.2);
        backdrop-filter: blur(4px);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .process-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(96, 165, 250, 0.3);
    }
    
    .process-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: #60a5fa;
    }
    
    .pricing-card {
        position: relative;
        background: rgba(30, 41, 59, 0.5);
        border: 1px solid rgba(96, 165, 250, 0.2);
        backdrop-filter: blur(4px);
        border-radius: 12px;
        padding: 2rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .pricing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(96, 165, 250, 0.2);
    }
    
    .pricing-card-featured {
        border-color: rgba(124, 58, 237, 0.5);
        background: linear-gradient(145deg, rgba(30, 41, 59, 0.8), rgba(17, 24, 39, 0.8));
    }
    
    .pricing-popular {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 1rem;
        border-radius: 9999px;
    }
    
    .pricing-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .pricing-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }
    
    .pricing-features {
        margin-bottom: 2rem;
    }
    
    .pricing-feature {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: #a1a1aa;
    }
    
    .pricing-feature svg {
        flex-shrink: 0;
        margin-right: 0.75rem;
    }
    
    .pricing-action {
        text-align: center;
    }
    
    .pricing-button {
        display: inline-block;
        width: 100%;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 9999px;
        transition: all 0.3s ease;
    }
    
    .pricing-button-outline {
        border: 1px solid rgba(96, 165, 250, 0.5);
        color: #60a5fa;
    }
    
    .pricing-button-outline:hover {
        background: rgba(96, 165, 250, 0.1);
    }
    
    .pricing-button-filled {
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        color: white;
    }
    
    .pricing-button-filled:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
</style>
@endsection