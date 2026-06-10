<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard - Local'z</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body { font-family: 'Inter', sans-serif; }
        html { 
            scroll-behavior: smooth; 
            scroll-padding-top: 80px; 
        }

        /* Highlight state for active links */
        .active-link { 
            color: #FF7900 !important; 
            border-bottom: 2px solid #FF7900; 
        }

        /* Footer Fix for ScrollSpy */
        footer#about-section {
            min-height: 200px;
        }

        /* Header link hover state */
        .nav-link {
            padding-bottom: 4px;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body id="top" class="bg-[#16171B] text-white min-h-screen flex flex-col">

    <div class="bg-[#FF7900] text-white text-xs py-2 px-8 flex justify-between items-center hidden md:flex">
        <div class="flex items-center gap-4">
            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> +60 11 3456 7890</span>
            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Selangor, Malaysia</span>
        </div>
        <div class="flex gap-6">
            <span>All products are 100% Halal Certified & Shariah-Compliant</span>
            <span>|</span>
            <span>Free delivery on orders above RM50</span>
        </div>
    </div>

    <nav class="sticky top-0 z-50 flex justify-between items-center py-5 px-8 bg-[#16171B]/90 backdrop-blur-md border-b border-white/5">

        <div>
            <h1 class="text-2xl font-bold text-[#FF7900] flex items-center gap-1">
                Local'z <span class="text-white text-lg">+</span>
            </h1>
            <p class="text-[10px] text-gray-400 -mt-1">by theWebberz</p>
        </div>


        <div class="hidden lg:flex items-center gap-8 text-sm text-gray-300">
            <a href="#top" id="link-home" class="nav-link">Home</a>
            <a href="#restaurants-section" id="link-restaurants" class="nav-link">Restaurants</a>            
            <a href="#products-section" id="link-products" class="nav-link">Browse Menu</a>
            <a href="#about-section" id="link-about" class="nav-link">About Us</a>
        </div>

    <div class="flex items-center gap-6">
    <a href="{{ route('cart.index') }}" class="relative text-gray-300 hover:text-white transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        @if(session('cart') && count(session('cart')) > 0)
            <span class="absolute -top-2 -right-2 bg-[#FF7900] text-[10px] font-bold text-white px-1.5 rounded-full">
                {{ count(session('cart')) }}
            </span>
        @endif
    </a>

    <a href="{{ route('profile.show') }}" class="bg-[#FF7900] hover:bg-orange-600 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
        My Account
    </a>
</div>
    </nav>

    <div class="max-w-7xl mx-auto px-8 pt-16 pb-24 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative">
        
        <div class="absolute top-1/2 left-1/4 w-96 h-96 bg-[#FF7900]/10 rounded-full blur-3xl -z-10 transform -translate-y-1/2"></div>

        <div>
            <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-4 py-1.5 text-xs text-orange-200 mb-6">
                <span class="bg-[#FF7900] w-2 h-2 rounded-full"></span>
                100% Halal Certified & Shariah-Compliant
            </div>
            
            <h2 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                <span class="text-[#FF7900]">Local'z</span><br>
                Your Digital Halal<br>
                Food & Grocery<br>
                Marketplace
            </h2>
            
            <p class="text-gray-400 text-lg mb-8 max-w-md">
                Discover fresh groceries and restaurant meals from verified halal vendors near you. All Shariah-compliant. All trusted.
            </p>

            <form action="{{ route('search.results') }}" method="GET" class="flex bg-white p-1.5 rounded-full mb-8 max-w-lg">
                <div class="flex items-center pl-4 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="q" placeholder="Search food, groceries, or restaurants..." class="flex-1 bg-transparent border-none focus:ring-0 text-gray-800 px-3 py-2 outline-none w-full" required>
                <button type="submit" class="bg-[#FF7900] hover:bg-orange-600 text-white px-8 py-3 rounded-full font-medium transition">
                    Search
                </button>
            </form>


            <div class="flex flex-wrap gap-3 mb-12">
                <a href="{{ route('search.results') }}?q=Halal Burger" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-[#FF7900] transition">Halal Burger</a>
                <a href="{{ route('search.results') }}?q=Biryani" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-[#FF7900] transition">Biryani</a>
                <a href="{{ route('search.results') }}?q=Lamb Chops" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-[#FF7900] transition">Lamb Chops</a>
                <a href="{{ route('search.results') }}?q=Dates" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-[#FF7900] transition">Dates</a>
                <a href="{{ route('search.results') }}?q=Shawarma" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-[#FF7900] transition">Shawarma</a>
            </div>

            <div class="flex gap-12">
                <div>
                    <h4 class="text-[#FF7900] text-3xl font-bold mb-1">500+</h4>
                    <p class="text-gray-400 text-xs uppercase tracking-wider">Halal Vendors</p>
                </div>
                <div>
                    <h4 class="text-[#FF7900] text-3xl font-bold mb-1">10k+</h4>
                    <p class="text-gray-400 text-xs uppercase tracking-wider">Products Listed</p>
                </div>
                <div>
                    <h4 class="text-[#FF7900] text-3xl font-bold mb-1">100%</h4>
                    <p class="text-gray-400 text-xs uppercase tracking-wider">Certified Halal</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 h-[500px]">
            <div class="relative rounded-2xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=600&q=80" alt="Halal Burgers" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <h3 class="absolute bottom-4 left-4 font-semibold text-lg">Halal Burgers</h3>
            </div>
            <div class="relative rounded-2xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1633945274405-b6c8069047b0?auto=format&fit=crop&w=600&q=80" alt="Biryani" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <h3 class="absolute bottom-4 left-4 font-semibold text-lg">Biryani</h3>
            </div>

        </div>
    </div>

<div id="restaurants-section" class="bg-white text-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-8">
            <h2 class="text-2xl font-bold mb-8">Featured Restaurants</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($restaurants as $restaurant)
                <a href="/restaurant/{{ $restaurant->id }}" class="group block rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <img src="{{ $restaurant->image_url }}" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="p-4 bg-white">
                        <h3 class="font-bold text-gray-800">{{ $restaurant->name }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

<div id="products-section" class="bg-gray-50 text-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">Browse Products</h2>
                <span class="text-gray-500 text-sm">{{ $products->count() }} items found</span>
            </div>

            <div class="flex flex-wrap gap-3 mb-10">
                <a href="/?category=Burgers" class="px-4 py-1.5 rounded-full text-sm border transition-all duration-300 hover:bg-[#FF7900] hover:text-white hover:border-[#FF7900] {{ request('category') == 'Burgers' ? 'bg-[#FF7900] text-white' : 'bg-white border-gray-300' }}">Burgers</a>
                <a href="/?category=Rice Dishes" class="px-4 py-1.5 rounded-full text-sm border transition-all duration-300 hover:bg-[#FF7900] hover:text-white hover:border-[#FF7900] {{ request('category') == 'Rice Dishes' ? 'bg-[#FF7900] text-white' : 'bg-white border-gray-300' }}">Rice Dishes</a>
                <a href="/" class="px-4 py-1.5 rounded-full text-sm border transition-all duration-300 hover:bg-[#FF7900] hover:text-white hover:border-[#FF7900] {{ !request('category') ? 'bg-[#FF7900] text-white' : 'bg-white border-gray-300' }}">All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white border border-gray-200 p-4 rounded-2xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <img src="{{ $product->image_url }}" class="w-full h-40 object-cover rounded-xl mb-3">
                    <h3 class="font-bold text-gray-800">{{ $product->name }}</h3>
                    <div class="flex items-center text-yellow-400 text-xs my-1">
                        <span>★</span> <span>{{ $product->rating ?? '4.5' }}</span>
                    </div>
                    <div class="flex justify-between items-center mt-3">
                        <span class="text-[#FF7900] font-bold">RM {{ $product->price }}</span>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-[#FF7900] text-white px-4 py-2 rounded-lg text-xs font-bold transition hover:bg-orange-700">
                                Add
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
<script>

    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('#products-section, #restaurants-section, #about-section');

    // 1. Smooth Scroll Handling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            // Specifically handle Home/Top
            const target = href === '#top' ? document.body : document.querySelector(href);
            
            target.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // 2. Highlighting using Intersection Observer
    // rootMargin: 'top right bottom left'. 
    // We set top to -100px to account for the sticky header height.
    const observerOptions = {
        root: null, 
        rootMargin: '-100px 0px -50% 0px', 
        threshold: 0
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Remove active class from all links
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('text-[#FF7900]', 'border-b-2', 'border-[#FF7900]');
                });
                
                // Add active class to the corresponding link
                const id = entry.target.getAttribute('id');
                const activeLink = document.querySelector(`a[href="#${id}"]`);
                if (activeLink) {
                    activeLink.classList.add('text-[#FF7900]', 'border-b-2', 'border-[#FF7900]');
                }
            }
        });
    }, observerOptions);

    // Observe your sections
    document.querySelectorAll('#products-section, #restaurants-section, #about-section').forEach(section => {
    observer.observe(section);
});

    // Handle "Home" highlighting when at the top
    window.addEventListener('scroll', () => {
        if (window.scrollY < 150) {
            navLinks.forEach(link => link.classList.remove('text-[#FF7900]', 'border-b-2', 'border-[#FF7900]'));
            document.getElementById('link-home').classList.add('text-[#FF7900]', 'border-b-2', 'border-[#FF7900]');
        }
    });
</script>

<footer id="about-section" class="bg-[#0f1013] border-t border-white/5 py-16 px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
        <div>
            <h1 class="text-2xl font-bold text-[#FF7900] mb-4">Local'z <span class="text-white text-lg">+</span></h1>
            <p class="text-gray-400 text-sm">Connecting you to the best halal local eateries with ease.</p>
        </div>

        <div>
            <h4 class="font-bold mb-4">About Us</h4>
            <ul class="text-gray-400 text-sm space-y-2">
                <li>Our Story</li>
                <li>How it Works</li>
                <li>Partner with Us</li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold mb-4">Legal</h4>
            <ul class="text-gray-400 text-sm space-y-2">
                <li>Privacy Policy</li>
                <li>Terms of Service</li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold mb-4">Follow Us</h4>
            <div class="flex gap-4">
                <a href="#" class="text-gray-400 hover:text-[#FF7900]">Instagram</a>
                <a href="#" class="text-gray-400 hover:text-[#FF7900]">Facebook</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>