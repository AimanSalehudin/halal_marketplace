<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#16171B] text-white min-h-screen p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Results for: <span class="text-[#FF7900]">"{{ $query }}"</span></h1>

        <h2 class="text-xl font-bold mb-4">Restaurants</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            @forelse($restaurants as $restaurant)
                <div class="bg-white/5 p-4 rounded-2xl">{{ $restaurant->name }}</div>
            @empty
                <p class="text-gray-400">No restaurants found.</p>
            @endforelse
        </div>

        <h2 class="text-xl font-bold mb-4">Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white/5 p-4 rounded-2xl">{{ $product->name }} - RM{{ $product->price }}</div>
            @empty
                <p class="text-gray-400">No products found.</p>
            @endforelse
        </div>
        
        <a href="/" class="block mt-12 text-center text-[#FF7900] hover:underline">← Back to Home</a>
    </div>
</body>
</html>