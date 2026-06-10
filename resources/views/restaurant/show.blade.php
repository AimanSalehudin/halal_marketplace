<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#16171B] text-white">

    <nav class="flex justify-between items-center py-5 px-8 border-b border-white/5">
        <h1 class="text-2xl font-bold text-[#FF7900]">Local'z <span class="text-white text-lg">+</span></h1>
        <a href="/" class="text-gray-300 hover:text-white">Back to Home</a>
    </nav>

    <div class="max-w-7xl mx-auto px-8 py-16">
        <div class="flex flex-col md:flex-row gap-12 items-center">
            <img src="{{ $restaurant->image_url }}" class="w-full md:w-1/3 h-64 object-cover rounded-3xl">
            <div>
                <h2 class="text-5xl font-bold mb-4">{{ $restaurant->name }}</h2>
                <p class="text-xl text-gray-400 mb-4">{{ $restaurant->category }} • ★ {{ $restaurant->rating }}</p>
                <div class="bg-[#FF7900]/10 border border-[#FF7900] text-[#FF7900] px-4 py-2 rounded-full inline-block">
                    100% Halal Verified
                </div>
            </div>
        </div>

        <h3 class="text-2xl font-bold mt-16 mb-8">Menu</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white/5 border border-white/10 p-4 rounded-2xl hover:bg-white/10 transition">
                <img src="{{ $product->image_url }}" class="w-full h-40 object-cover rounded-xl mb-3">
                <h4 class="font-bold text-lg">{{ $product->name }}</h4>
                <div class="flex justify-between items-center mt-3">
                    <span class="text-[#FF7900] font-bold">RM {{ $product->price }}</span>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button class="bg-[#FF7900] px-3 py-1 rounded text-xs font-bold">Add</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>