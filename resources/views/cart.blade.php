<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#16171B] text-white min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-[#FF7900] mb-8">Your Cart</h1>
        
        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-white/10">
                        <div>
                            <h3 class="font-bold text-lg">{{ $details['name'] }}</h3>
                            <p class="text-gray-400">RM {{ $details['price'] }}</p>
                        </div>
                        <span class="text-[#FF7900] font-bold">RM {{ $details['price'] }}</span>
                    </div>
                @endforeach
                
                <div class="mt-6 flex justify-between items-center text-xl font-bold">
                    <span>Total:</span>
                    <span class="text-[#FF7900]">RM {{ array_sum(array_column(session('cart'), 'price')) }}</span>
                </div>
                
                <form action="/checkout" method="POST">
                    @csrf
                    <button type="submit" class="w-full mt-8 bg-[#FF7900] hover:bg-orange-600 py-3 rounded-xl font-bold transition">
                        Proceed to Checkout
                    </button>
                </form>
            @else
                <p class="text-gray-400">Your cart is empty.</p>
            @endif
        </div>
        <a href="/" class="block mt-6 text-center text-gray-400 hover:text-white">← Continue Shopping</a>
    </div>
</body>
</html>