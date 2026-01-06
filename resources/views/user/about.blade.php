@extends("user.layouts.master-layouts.plain")
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Grocery Station One | About </title>

@push("script")
@endpush


@push("style")
   
<link rel="stylesheet" href="{{ asset('css/about.css') }}">

@endpush


@section("content")
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

 
</head>
<body>
    <!-- Language Toggle -->
    <div class="language-toggle p-4 flex gap-2 justify-end">
        <button id="englishBtn" class="lang-btn active px-4 py-2 bg-blue-600 text-white rounded">
            <i class="fas fa-language mr-2"></i> English
        </button>
        <button id="urduBtn" class="lang-btn px-4 py-2 bg-gray-200 text-black rounded">
            <i class="fas fa-language mr-2"></i> اردو
        </button>
    </div>

    <!-- Floating Elements -->
    <div class="floating-element floating-element-1"></div>
    <div class="floating-element floating-element-2"></div>
    <div class="floating-element floating-element-3"></div>

    <!-- Hero Section -->
    <section class="hero-bg bg-green-50 py-16">
        <div class="hero-section">
            <div class="container mx-auto px-4">
                <div class="hero-content animate-on-scroll text-center">
                    <h1 class="hero-title text-4xl font-bold mb-4" data-english="Welcome to GroceryStationOne" data-urdu="گروسری اسٹیشن ون میں خوش آمدید">Welcome to GroceryStationOne</h1>
                    <p class="hero-subtitle text-lg mb-4" data-english="The perfect platform for grocery items" data-urdu="گروسری آئٹمز کے لیے بہترین پلیٹ فارم">The perfect platform for grocery items</p>
                    <div class="hero-breadcrumb text-sm text-gray-600">
                        <a href="{{ route('home') }}" data-english="Home" data-urdu="ہوم">Home</a>
                        <span>/</span>
                        <a href="{{ route('about') }}" data-english="About Us" data-urdu="ہمارے بارے میں">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Vision, Motive, Mission, Journey, Quality Section -->
    <section class="section section-bg py-16 bg-white">
        <div class="container mx-auto px-4 space-y-12">

            <!-- OUR VISION -->
            <div class="story-content animate-on-scroll">
                <h2 class="story-title text-3xl font-bold mb-4" data-english="OUR VISION" data-urdu="ہمارا وژن">OUR VISION</h2>
                <p class="story-text text-lg" data-english="Our main and supreme vision is to provide quality over quantity at a very decent price." data-urdu="ہمارا بنیادی اور اعلیٰ وژن یہ ہے کہ مقدار کے بجائے معیار فراہم کریں اور قیمت بہت مناسب ہو۔">Our main and supreme vision is to provide quality over quantity at a very decent price.</p>
            </div>

            <!-- OUR MOTIVE -->
            <div class="story-content animate-on-scroll">
                <h2 class="story-title text-3xl font-bold mb-4" data-english="OUR MOTIVE" data-urdu="ہمارا مقصد">OUR MOTIVE</h2>
                <p class="story-text text-lg" data-english="Our company's motive is to make the public aware about quality and price. You can compare our quality and price with any wholesale market, retail store, or supermarket, and you will see the difference we offer." data-urdu="ہماری کمپنی کا مقصد عوام کو معیار اور قیمت کے بارے میں آگاہ کرنا ہے۔ آپ ہماری معیار اور قیمت کا موازنہ کسی بھی ہول سیل مارکیٹ، ریٹیل اسٹور، یا سپر مارکیٹ سے کر سکتے ہیں اور فرق دیکھ سکتے ہیں جو ہم فراہم کرتے ہیں۔">Our company's motive is to make the public aware about quality and price. You can compare our quality and price with any wholesale market, retail store, or supermarket, and you will see the difference we offer.</p>
            </div>

            <!-- OUR MISSION -->
            <div class="story-content animate-on-scroll">
                <h2 class="story-title text-3xl font-bold mb-4" data-english="OUR MISSION" data-urdu="ہمارا مشن">OUR MISSION</h2>
                <p class="story-text text-lg" data-english="Our mission is to sell products at importing costs and spread our work worldwide. Providing the best quality products at minimum prices, so people who can't afford high supermarket prices can enjoy quality items." data-urdu="ہمارا مشن مصنوعات کو درآمدی لاگت پر بیچنا اور اپنا کام دنیا بھر میں پھیلانا ہے۔ بہترین معیار کی مصنوعات کم سے کم قیمت پر فراہم کرنا تاکہ وہ لوگ جو مہنگی سپر مارکیٹ کی قیمتیں برداشت نہیں کر سکتے معیار سے لطف اندوز ہو سکیں۔">Our mission is to sell products at importing costs and spread our work worldwide. Providing the best quality products at minimum prices, so people who can't afford high supermarket prices can enjoy quality items.</p>
            </div>

            <!-- OUR JOURNEY -->
<div class="story-content animate-on-scroll">
    <h2 class="story-title text-3xl font-bold mb-4" 
        data-english="OUR JOURNEY" 
        data-urdu="ہمارا سفر">
        OUR JOURNEY
    </h2>

    <p class="story-text text-lg" 
       data-english="The journey has just begun, but our company has been importing these items for the last 20 years. We used to sell them to supermarkets at very minimal rates, and they would then sell them to you at double the price. To end this cycle and offer you fair prices directly, we are here now with our own online platform." 
       data-urdu="سفر ابھی شروع ہوا ہے، لیکن ہماری کمپنی پچھلے 20 سالوں سے یہ اشیاء درآمد کر رہی ہے۔ ہم یہ چیزیں سپر مارکیٹوں کو بہت کم قیمت پر دیتے تھے، اور وہ آپ کو دوگنی قیمت پر بیچتی تھیں۔ اسی کھیل کو ختم کرنے اور آپ تک مناسب قیمتیں پہنچانے کے لیے ہم اب اپنا آن لائن پلیٹ فارم لے کر آئے ہیں۔">
        The journey has just begun, but our company has been importing these items for the last 20 years. We used to sell them to supermarkets at very minimal rates, and they would then sell them to you at double the price. To end this cycle and offer you fair prices directly, we are here now with our own online platform.
    </p>
</div>


            <!-- QUALITY & TASTE -->
<!-- QUALITY & TASTE -->
<div class="story-content animate-on-scroll">
    <h2 class="story-title text-3xl font-bold mb-4" data-english="QUALITY & TASTE" data-urdu="معیار اور ذائقہ">QUALITY & TASTE</h2>
    <p class="story-text text-lg" data-english="At GroceryStationOne, we provide the best quality possible. Quality and taste are the foundation of our work. Prices adjust according to international market changes, both increasing and decreasing to provide relief to our customers." data-urdu="گروسری اسٹیشن ون میں، ہم بہترین معیار فراہم کرتے ہیں۔ معیار اور ذائقہ ہمارے کام کی بنیاد ہیں۔ قیمتیں بین الاقوامی مارکیٹ کی تبدیلیوں کے مطابق بڑھتی یا گھٹتی ہیں تاکہ ہمارے صارفین کو راحت ملے۔">At GroceryStationOne, we provide the best quality possible. Quality and taste are the foundation of our work. Prices adjust according to international market changes, both increasing and decreasing to provide relief to our customers.</p>
    <b><p class="story-text text-lg" data-english="Our rates depend on the international import/export market." data-urdu="ہماری قیمتیں بین الاقوامی درآمد/برآمد مارکیٹ پر منحصر ہیں۔">Our rates depend on the international import/export market.</p></b>
</div>


        </div>
    </section>

    <!-- Previous Stats Section -->
    <section class="section stats-section py-16 bg-green-50">
        <div class="container mx-auto px-4">
            <div class="stats-container stagger-animation grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                <div class="stat-item">
                    <i class="fas fa-store stat-icon text-4xl mb-2"></i>
                    <span class="stat-number" data-count="15">0</span>
                    <span class="stat-label" data-english="Store Locations" data-urdu="اسٹور مقامات">Store Locations</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-users stat-icon text-4xl mb-2"></i>
                    <span class="stat-number" data-count="500">0</span>
                    <span class="stat-label" data-english="Team Members" data-urdu="ٹیم کے اراکین">Team Members</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-smile stat-icon text-4xl mb-2"></i>
                    <span class="stat-number" data-count="50000">0</span>
                    <span class="stat-label" data-english="Happy Customers" data-urdu="خوش گاہک">Happy Customers</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-calendar-alt stat-icon text-4xl mb-2"></i>
                    <span class="stat-number" data-count="12">0</span>
                    <span class="stat-label" data-english="Years of Service" data-urdu="سالوں کی خدمت">Years of Service</span>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('script')
    <!-- Language & Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const englishBtn = document.getElementById('englishBtn');
            const urduBtn = document.getElementById('urduBtn');
            const body = document.body;
            let currentLanguage = 'english';

            function switchLanguage(lang) {
                currentLanguage = lang;
                if (lang === 'english') {
                    englishBtn.classList.add('active');
                    urduBtn.classList.remove('active');
                    body.classList.remove('urdu');
                } else {
                    urduBtn.classList.add('active');
                    englishBtn.classList.remove('active');
                    body.classList.add('urdu');
                }

                const translatableElements = document.querySelectorAll('[data-english]');
                translatableElements.forEach(element => {
                    if (lang === 'english') {
                        element.textContent = element.getAttribute('data-english');
                    } else {
                        element.textContent = element.getAttribute('data-urdu');
                    }
                });
            }

            englishBtn.addEventListener('click', () => switchLanguage('english'));
            urduBtn.addEventListener('click', () => switchLanguage('urdu'));

            // Scroll animations
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.animate-on-scroll, .stagger-animation');
                elements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementVisible = 150;
                    if (elementTop < window.innerHeight - elementVisible) {
                        element.classList.add('animated');
                    }
                });
            };
            animateOnScroll();
            window.addEventListener('scroll', animateOnScroll);

            // Animate stats counter
            const animateValue = (obj, start, end, duration) => {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            };

            const startCounterAnimation = () => {
                const statNumbers = document.querySelectorAll('.stat-number');
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.getAttribute('data-count'));
                    animateValue(stat, 0, target, 2000);
                });
            };

            const statsSection = document.querySelector('.stats-section');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCounterAnimation();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            if (statsSection) observer.observe(statsSection);
        });
    </script>
@endpush   