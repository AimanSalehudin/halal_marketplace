<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard - Local'z</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#16171B] text-white min-h-screen flex flex-col">

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

    <nav class="flex justify-between items-center py-5 px-8 bg-[#16171B] border-b border-white/5">
        <div>
            <h1 class="text-2xl font-bold text-[#FF7900] flex items-center gap-1">
                Local'z <span class="text-white text-lg">+</span>
            </h1>
            <p class="text-[10px] text-gray-400 -mt-1">by theWebberz</p>
        </div>


        <div class="hidden lg:flex items-center gap-8 text-sm text-gray-300">
            <a href="/" class="text-[#FF7900] font-medium border-b-2 border-[#FF7900] pb-1">Home</a>
            <a href="/browse" class="hover:text-white transition-colors">Browse Menu</a>
            <a href="/restaurants" class="hover:text-white transition-colors">Restaurants</a>
            <a href="/track-order" class="hover:text-white transition-colors">Track Order</a>
        </div>

        <a href="/vendor/dashboard" class="bg-[#FF7900] hover:bg-orange-600 text-white px-5 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition">
            My Account
        </a>
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
                Discover fresh groceries and restaurant meals from verified halal vendors near you — all Shariah-compliant, all trusted.
            </p>

            <div class="flex bg-white p-1.5 rounded-full mb-8 max-w-lg">
                <div class="flex items-center pl-4 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" placeholder="Search food, groceries, or restaurants..." class="flex-1 bg-transparent border-none focus:ring-0 text-gray-800 px-3 py-2 outline-none w-full">
                <button class="bg-[#FF7900] hover:bg-orange-600 text-white px-8 py-3 rounded-full font-medium transition">
                    Search
                </button>
            </div>


            <div class="flex flex-wrap gap-3 mb-12">
                <a href="/category/burger" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-white/10 transition">Halal Burger</a>
                <a href="/category/biryani" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-white/10 transition">Biryani</a>
                <a href="/category/lamb-chops" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-white/10 transition">Lamb Chops</a>
                <a href="/category/dates" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-white/10 transition">Dates</a>
                <a href="/category/shawarma" class="bg-white/5 border border-white/10 text-gray-300 px-4 py-1.5 rounded-full text-sm hover:bg-white/10 transition">Shawarma</a>
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

    <div class="bg-[#16171B] py-16">
    <div class="max-w-7xl mx-auto px-8">
        <h2 class="text-3xl font-bold text-white mb-8">Available Products</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white/5 border border-white/10 p-4 rounded-xl hover:border-[#FF7900] transition">
                <h3 class="text-white font-semibold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-400 text-sm">{{ $product->category }}</p>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-[#FF7900] font-bold">${{ $product->price }}</span>
                    <span class="text-gray-400 text-xs">{{ $product->stock }} in stock</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

    <div class="bg-white flex-1 text-gray-800 pt-16 pb-24">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-2xl font-bold flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#FF7900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Featured Restaurants
                    </h2>
                    <p class="text-gray-500 text-sm mt-1">Top-rated halal-certified restaurants</p>
                </div>
                <a href="#" class="text-[#FF7900] font-medium hover:underline flex items-center gap-1 text-sm">
                    View all <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <form action="/search" method="GET" class="flex bg-white p-1.5 rounded-full mb-8 max-w-lg">
            <input type="text" name="query" placeholder="Search..." class="flex-1 ...">
            <button type="submit" class="bg-[#FF7900] ...">Search</button>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="rounded-2xl overflow-hidden relative shadow-sm border border-gray-100 group cursor-pointer">
                    <div class="absolute top-4 right-4 bg-[#FF7900] text-white text-xs font-bold px-3 py-1.5 rounded-full z-10">Up to 20% off</div>
                    <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=600&q=80" alt="Restaurant 1" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="rounded-2xl overflow-hidden relative shadow-sm border border-gray-100 group cursor-pointer">
                    <div class="absolute top-4 right-4 bg-[#FF7900] text-white text-xs font-bold px-3 py-1.5 rounded-full z-10">New</div>
                    <img src="https://images.unsplash.com/photo-1589302168068-964664d93cb0?auto=format&fit=crop&w=600&q=80" alt="Restaurant 2" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="rounded-2xl overflow-hidden relative shadow-sm border border-gray-100 group cursor-pointer">
                    <div class="absolute top-4 right-4 bg-[#FF7900] text-white text-xs font-bold px-3 py-1.5 rounded-full z-10">Popular</div>
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=600&q=80" alt="Restaurant 3" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                </div>
            </div>
        </div>
    </div>

</body>
</html>