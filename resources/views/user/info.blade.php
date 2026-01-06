@extends('user.layouts.master-layouts.plain')
    <title>Privacy & Policies | Company Information</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @push('style')
    <style>
        :root {
            --primary-color: #f97316;     
            --primary-hover: #ea580c;      
            --secondary-color: #eab308;    
            --secondary-hover: #ca8a04; 
            --accent-color: #16a34a;     
            --accent-hover: #15803d;       
            --text-on-primary: #000000;  
            --text-on-secondary: #000000;  
            --light-orange: #ffedd5;
            --dark-orange: #9a3412;
            --light-bg: #f8fafc;
            --white: #ffffff;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
            --text-on-primary: #ffffff;
            --text-on-secondary: #ffffff;
        
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: var(--light-bg);
        }
        
        .gradient-primary {
            background: var(--gradient-primary);
        }
        
        .gradient-secondary {
            background: var(--gradient-secondary);
        }
        
        .text-primary {
            color: var(--primary-color);
        }
        
        .bg-primary {
            background-color: var(--primary-color);
        }
        
        .bg-secondary {
            background-color: var(--secondary-color);
        }
        
        .bg-accent {
            background-color: var(--accent-color);
        }
        
        .bg-light-orange {
            background-color: var(--light-orange);
        }
        
        .border-primary {
            border-color: var(--primary-color);
        }
        
        .border-secondary {
            border-color: var(--secondary-color);
        }
        
        .hover\:bg-primary:hover {
            background-color: var(--primary-hover);
        }
        
        .hover\:bg-secondary:hover {
            background-color: var(--secondary-hover);
        }
        
        .hover\:bg-accent:hover {
            background-color: var(--accent-hover);
        }
        
        .policy-section {
            scroll-margin-top: 6rem;
        }
        
        .active-nav {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
    @endpush
@section('content')

<div class="text-gray-800">
    <!-- Navigation -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 gradient-primary rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold">Policy<span class="text-primary">Hub</span></h1>
                </div>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden">
                    <i class="fas fa-bars text-2xl text-gray-700"></i>
                </button>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#privacy" class="font-medium hover:text-primary transition">Privacy</a>
                    <a href="#shipping" class="font-medium hover:text-primary transition">Shipping</a>
                    <a href="#returns" class="font-medium hover:text-primary transition">Returns</a>
                    <a href="#terms" class="font-medium hover:text-primary transition">Terms</a>
                    <a href="#cookies" class="font-medium hover:text-primary transition">Cookies</a>
                    <a href="#contact" class="font-medium hover:text-primary transition">Contact</a>
                </nav>
            </div>
            
            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-2">
                <div class="flex flex-col space-y-3">
                    <a href="#privacy" class="font-medium hover:text-primary transition py-2 border-b border-gray-100">Privacy Policy</a>
                    <a href="#shipping" class="font-medium hover:text-primary transition py-2 border-b border-gray-100">Shipping Policy</a>
                    <a href="#returns" class="font-medium hover:text-primary transition py-2 border-b border-gray-100">Returns & Refunds</a>
                    <a href="#terms" class="font-medium hover:text-primary transition py-2 border-b border-gray-100">Terms of Service</a>
                    <a href="#cookies" class="font-medium hover:text-primary transition py-2 border-b border-gray-100">Cookie Policy</a>
                    <a href="#contact" class="font-medium hover:text-primary transition py-2">Contact Information</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="gradient-primary py-12 md:py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Our Policies & Legal Information</h1>
                <p class="text-xl mb-8 opacity-90">Transparent information about how we handle your data, ship products, process returns, and more.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#privacy" class="bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg hover:bg-gray-100 transition shadow-lg">Privacy Policy</a>
                    <a href="#shipping" class="bg-transparent border-2 border-white text-white font-semibold py-3 px-6 rounded-lg hover:bg-white/10 transition">Shipping Info</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- Table of Contents -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-12">
            <h2 class="text-2xl font-bold mb-6 text-primary">Quick Navigation</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="#privacy" class="bg-light-orange p-4 rounded-lg flex items-center hover:shadow-md transition">
                    <div class="bg-primary text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <h3 class="font-bold">Privacy Policy</h3>
                        <p class="text-sm text-gray-600">How we handle your data</p>
                    </div>
                </a>
                <a href="#shipping" class="bg-blue-50 p-4 rounded-lg flex items-center hover:shadow-md transition">
                    <div class="bg-accent text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div>
                        <h3 class="font-bold">Shipping Policy</h3>
                        <p class="text-sm text-gray-600">Delivery timelines & costs</p>
                    </div>
                </a>
                <a href="#returns" class="bg-green-50 p-4 rounded-lg flex items-center hover:shadow-md transition">
                    <div class="bg-secondary text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-undo-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-bold">Returns & Refunds</h3>
                        <p class="text-sm text-gray-600">Our return policy</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Privacy Policy Section -->
        <section id="privacy" class="policy-section bg-white rounded-xl shadow-lg p-6 md:p-8 mb-12 fade-in">
            <div class="flex items-center mb-8">
                <div class="bg-primary text-white p-3 rounded-lg mr-4">
                    <i class="fas fa-user-shield text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">Privacy Policy</h2>
                    <p class="text-gray-600">Last updated: June 15, 2023</p>
                </div>
            </div>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">1. Information We Collect</h3>
                    <p class="text-gray-700 mb-3">We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support.</p>
                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                        <li><strong>Personal Information:</strong> Name, email address, phone number, and billing/shipping addresses.</li>
                        <li><strong>Payment Information:</strong> Credit card details (processed securely by our payment processors).</li>
                        <li><strong>Technical Data:</strong> IP address, browser type, device information, and cookies.</li>
                        <li><strong>Usage Data:</strong> How you interact with our website and services.</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">2. How We Use Your Information</h3>
                    <p class="text-gray-700 mb-3">We use the information we collect for various business purposes, including:</p>
                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                        <li>Processing and fulfilling your orders</li>
                        <li>Providing customer support and responding to inquiries</li>
                        <li>Sending transactional emails (order confirmations, shipping updates)</li>
                        <li>Improving our website, products, and services</li>
                        <li>Detecting and preventing fraud and security issues</li>
                        <li>Complying with legal obligations</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">3. Data Sharing and Disclosure</h3>
                    <p class="text-gray-700">We do not sell your personal information. We may share your information with:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-bold mb-2">Service Providers</h4>
                            <p class="text-gray-700 text-sm">Third parties who help us operate our business (payment processors, shipping carriers).</p>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-bold mb-2">Legal Compliance</h4>
                            <p class="text-gray-700 text-sm">When required by law or to protect our rights, property, or safety.</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">4. Your Rights and Choices</h3>
                    <p class="text-gray-700 mb-3">Depending on your location, you may have certain rights regarding your personal information:</p>
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-light-orange text-gray-800 px-4 py-2 rounded-full text-sm font-medium">Right to Access</span>
                        <span class="bg-light-orange text-gray-800 px-4 py-2 rounded-full text-sm font-medium">Right to Correction</span>
                        <span class="bg-light-orange text-gray-800 px-4 py-2 rounded-full text-sm font-medium">Right to Deletion</span>
                        <span class="bg-light-orange text-gray-800 px-4 py-2 rounded-full text-sm font-medium">Right to Opt-Out</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Shipping Policy Section -->
        <section id="shipping" class="policy-section bg-white rounded-xl shadow-lg p-6 md:p-8 mb-12 fade-in">
            <div class="flex items-center mb-8">
                <div class="bg-accent text-white p-3 rounded-lg mr-4">
                    <i class="fas fa-shipping-fast text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">Shipping Policy</h2>
                    <p class="text-gray-600">Delivery information and timelines</p>
                </div>
            </div>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Shipping Methods & Timelines</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-left font-semibold">Shipping Method</th>
                                    <th class="py-3 px-4 text-left font-semibold">Delivery Time</th>
                                    <th class="py-3 px-4 text-left font-semibold">Cost</th>
                                    <th class="py-3 px-4 text-left font-semibold">Available Regions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t border-gray-300">
                                    <td class="py-3 px-4 font-medium">Standard Shipping</td>
                                    <td class="py-3 px-4">5-7 business days</td>
                                    <td class="py-3 px-4">$5.99</td>
                                    <td class="py-3 px-4">Domestic only</td>
                                </tr>
                                <tr class="border-t border-gray-300 bg-gray-50">
                                    <td class="py-3 px-4 font-medium">Express Shipping</td>
                                    <td class="py-3 px-4">2-3 business days</td>
                                    <td class="py-3 px-4">$12.99</td>
                                    <td class="py-3 px-4">Domestic only</td>
                                </tr>
                                <tr class="border-t border-gray-300">
                                    <td class="py-3 px-4 font-medium">International Standard</td>
                                    <td class="py-3 px-4">10-14 business days</td>
                                    <td class="py-3 px-4">$19.99</td>
                                    <td class="py-3 px-4">Select countries</td>
                                </tr>
                                <tr class="border-t border-gray-300 bg-gray-50">
                                    <td class="py-3 px-4 font-medium">Free Shipping</td>
                                    <td class="py-3 px-4">7-10 business days</td>
                                    <td class="py-3 px-4">FREE</td>
                                    <td class="py-3 px-4">Orders over $50 (domestic)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Order Processing & Tracking</h3>
                    <p class="text-gray-700 mb-3">Most orders are processed within 24-48 hours after placement. You will receive a confirmation email with your order details and a tracking number once your order ships.</p>
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 my-4">
                        <p class="font-medium">Note: Delivery times are estimates and not guaranteed. Shipping delays may occur due to weather, customs, or carrier issues.</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Shipping Restrictions</h3>
                    <p class="text-gray-700">We currently ship to the following regions:</p>
                    <div class="flex flex-wrap gap-3 mt-4">
                        <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">United States</span>
                        <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">Canada</span>
                        <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">United Kingdom</span>
                        <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">European Union</span>
                        <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">Australia</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Returns & Refunds Section -->
        <section id="returns" class="policy-section bg-white rounded-xl shadow-lg p-6 md:p-8 mb-12 fade-in">
            <div class="flex items-center mb-8">
                <div class="bg-secondary text-white p-3 rounded-lg mr-4">
                    <i class="fas fa-undo-alt text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">Returns & Refunds Policy</h2>
                    <p class="text-gray-600">Our return and refund procedures</p>
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="border border-gray-200 rounded-lg p-5 text-center">
                        <div class="text-4xl font-bold text-primary mb-2">30</div>
                        <h4 class="font-bold mb-2">Day Return Window</h4>
                        <p class="text-gray-700 text-sm">Return items within 30 days of delivery for a full refund.</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-5 text-center">
                        <div class="text-4xl font-bold text-primary mb-2">$0</div>
                        <h4 class="font-bold mb-2">Free Returns</h4>
                        <p class="text-gray-700 text-sm">Free return shipping for defective or incorrect items.</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-5 text-center">
                        <div class="text-4xl font-bold text-primary mb-2">14</div>
                        <h4 class="font-bold mb-2">Refund Processing</h4>
                        <p class="text-gray-700 text-sm">Refunds processed within 14 days of receiving returned items.</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Return Conditions</h3>
                    <p class="text-gray-700 mb-4">To be eligible for a return, your item must be:</p>
                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                        <li>In the original packaging with all tags attached</li>
                        <li>Unused and in the same condition as received</li>
                        <li>Accompanied by the original receipt or proof of purchase</li>
                    </ul>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 my-4">
                        <p class="font-medium">Non-returnable items: Gift cards, personalized items, digital products, and intimate apparel.</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Refund Methods</h3>
                    <p class="text-gray-700 mb-3">Refunds will be issued to the original payment method. The time it takes for the refund to appear in your account depends on your payment provider:</p>
                    <div class="flex items-center space-x-4 mt-4">
                        <div class="flex items-center">
                            <i class="fas fa-credit-card text-gray-500 mr-2"></i>
                            <span class="text-gray-700">Credit/Debit Cards: 5-10 business days</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fab fa-paypal text-blue-500 mr-2"></i>
                            <span class="text-gray-700">PayPal: 3-5 business days</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Terms of Service Section -->
        <section id="terms" class="policy-section bg-white rounded-xl shadow-lg p-6 md:p-8 mb-12 fade-in">
            <div class="flex items-center mb-8">
                <div class="bg-purple-600 text-white p-3 rounded-lg mr-4">
                    <i class="fas fa-file-contract text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">Terms of Service</h2>
                    <p class="text-gray-600">Legal terms governing use of our services</p>
                </div>
            </div>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Acceptance of Terms</h3>
                    <p class="text-gray-700">By accessing and using our website, you accept and agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.</p>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">User Responsibilities</h3>
                    <p class="text-gray-700 mb-3">As a user of our services, you agree to:</p>
                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                        <li>Provide accurate and complete information when creating an account</li>
                        <li>Maintain the confidentiality of your account credentials</li>
                        <li>Not use our services for any illegal or unauthorized purpose</li>
                        <li>Not attempt to gain unauthorized access to any part of our services</li>
                        <li>Comply with all applicable laws and regulations</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Intellectual Property</h3>
                    <p class="text-gray-700">All content on this website, including text, graphics, logos, and software, is the property of our company and is protected by intellectual property laws. You may not reproduce, distribute, or create derivative works without our express written permission.</p>
                </div>
            </div>
        </section>

        <!-- Cookie Policy Section -->
        <section id="cookies" class="policy-section bg-white rounded-xl shadow-lg p-6 md:p-8 mb-12 fade-in">
            <div class="flex items-center mb-8">
                <div class="bg-yellow-500 text-white p-3 rounded-lg mr-4">
                    <i class="fas fa-cookie-bite text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">Cookie Policy</h2>
                    <p class="text-gray-600">How we use cookies and similar technologies</p>
                </div>
            </div>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">What Are Cookies?</h3>
                    <p class="text-gray-700">Cookies are small text files stored on your device when you visit our website. They help us provide a better user experience by remembering your preferences and understanding how you interact with our site.</p>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Types of Cookies We Use</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border border-gray-200 rounded-lg p-5">
                            <h4 class="font-bold mb-3 text-primary">Essential Cookies</h4>
                            <p class="text-gray-700 text-sm">Required for the website to function properly. These cannot be disabled.</p>
                            <div class="mt-3">
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-3 py-1 rounded-full">Required</span>
                            </div>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-5">
                            <h4 class="font-bold mb-3 text-primary">Analytics Cookies</h4>
                            <p class="text-gray-700 text-sm">Help us understand how visitors interact with our website.</p>
                            <div class="mt-3">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">Optional</span>
                            </div>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-5">
                            <h4 class="font-bold mb-3 text-primary">Functional Cookies</h4>
                            <p class="text-gray-700 text-sm">Remember your preferences and settings for future visits.</p>
                            <div class="mt-3">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">Optional</span>
                            </div>
                        </div>
                        <div class="border border-gray-200 rounded-lg p-5">
                            <h4 class="font-bold mb-3 text-primary">Advertising Cookies</h4>
                            <p class="text-gray-700 text-sm">Used to deliver relevant advertisements to you.</p>
                            <div class="mt-3">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">Optional</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-3 text-primary">Managing Cookies</h3>
                    <p class="text-gray-700 mb-3">You can control and manage cookies in various ways:</p>
                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                        <li>Browser settings: Most browsers allow you to refuse or accept cookies</li>
                        <li>Opt-out tools: Use industry opt-out tools for advertising cookies</li>
                        <li>Our cookie consent banner: Adjust your preferences via our cookie banner</li>
                    </ul>
                </div>
            </div>
        </section>

    
    </main>
</div>
@endsection

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-primary text-white p-3 rounded-full shadow-lg hover:bg-primary-hover transition opacity-0">
        <i class="fas fa-arrow-up"></i>
    </button>
@push('script')
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Close mobile menu when clicking a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
        
        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('opacity-0');
                backToTopButton.classList.add('opacity-100');
            } else {
                backToTopButton.classList.remove('opacity-100');
                backToTopButton.classList.add('opacity-0');
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        // Update active nav link on scroll
        const sections = document.querySelectorAll('.policy-section');
        const navLinks = document.querySelectorAll('header nav a, #mobile-menu a');
        
        const observerOptions = {
            root: null,
            rootMargin: '-100px 0px -50% 0px',
            threshold: 0
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    
                    navLinks.forEach(link => {
                        if (link.getAttribute('href') === `#${id}`) {
                            link.classList.add('active-nav');
                        } else {
                            link.classList.remove('active-nav');
                        }
                    });
                }
            });
        }, observerOptions);
        
        sections.forEach(section => {
            observer.observe(section);
        });
        
        // Form submission (for demo purposes)
        const contactForm = document.querySelector('form');
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Thank you for your message! This is a demo form. In a real application, this would send your message to our team.');
            contactForm.reset();
        });
        
        // Add fade-in animation to sections as they come into view
        const fadeInObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.policy-section').forEach(section => {
            fadeInObserver.observe(section);
        });
    </script>
    @endpush
