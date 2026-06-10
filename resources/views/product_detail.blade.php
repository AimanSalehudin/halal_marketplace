<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Local'z+</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-950 text-gray-100 font-sans min-h-screen selection:bg-orange-500 selection:text-white">

    <div class="bg-orange-600 text-black text-xs font-semibold py-2 px-6 flex justify-between items-center tracking-wide">
        <div>📞 +60 11 3456 7890 &nbsp;|&nbsp; 📍 Selangor, Malaysia</div>
        <div class="hidden md:block">All products are 100% Halal Certified & Shariah-Compliant</div>
        <div>Free delivery on orders above RM50</div>
    </div>

    <nav class="border-b border-gray-900 bg-gray-950/80 backdrop-blur-md sticky top-0 z-50 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <a href="/" class="text-2xl font-bold tracking-tight text-white">
                Local'z<span class="text-orange-500 font-light">+</span>
            </a>
            <span class="text-xs text-gray-500 font-mono hidden sm:inline-block">by theWebberz</span>
        </div>
        
        <div class="hidden md:flex space-x-8 text-sm font-medium">
            <a href="/" class="text-orange-500 border-b-2 border-orange-500 pb-1">Home</a>
            <a href="#" class="text-gray-400 hover:text-white transition">Browse Menu</a>
            <a href="#" class="text-gray-400 hover:text-white transition">Restaurants</a>
        </div>

        <a href="/" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold px-5 py-2 rounded-xl transition shadow-lg shadow-orange-950/30">
            My Account
        </a>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 bg-gray-900/30 p-8 rounded-3xl border border-gray-900/60 backdrop-blur-sm">
            
            <div class="space-y-4">
                <div class="aspect-[4/3] w-full bg-gray-900 rounded-2xl overflow-hidden flex items-center justify-center border border-gray-800/60 group shadow-2xl shadow-black">
                    <img src="{{ asset('images/products/' . ($product->image ?? 'placeholder.jpg')) }}" 
                         alt="{{ $product->name }}" 
                         class="object-cover w-full h-full transition duration-500 group-hover:scale-105"
                         onerror="this.src='https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&q=80&w=800'">
                </div>
            </div>

            <div class="flex flex-col justify-between space-y-8">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-950/40 text-orange-400 border border-orange-900/40 tracking-wide mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 mr-2"></span>
                        100% Halal Certified & Shariah-Compliant
                    </span>
                    
                    <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl mt-2">
                        {{ $product->name }}
                    </h1>
                    
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-mono">
                        Category: {{ $product->category }}
                    </p>

                    <div class="mt-4 flex items-baseline space-x-2">
                        <span class="text-3xl font-black text-orange-500">RM {{ number_format($product->price, 2) }}</span>
                    </div>

                    <div class="mt-6 border-t border-gray-900 pt-6">
                        <h3 class="text-sm font-bold text-gray-300 tracking-wide">Description</h3>
                        <p class="mt-2 text-sm text-gray-400 leading-relaxed font-light">
                            Experience premium local selection prepared under strict clean standards. Authenticated by local authorities and freshly batched by our verified vendors.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-950/80 p-6 rounded-2xl border border-gray-900 shadow-inner">
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        <div class="flex items-center justify-between border-b border-gray-900 pb-3">
                            <span class="text-xs font-semibold text-gray-400 tracking-wider">Availability</span>
                            @if($product->stock > 0)
                                <span class="text-xs font-bold text-orange-400 bg-orange-950/20 px-2.5 py-1 rounded-lg border border-orange-900/30">
                                    In Stock ({{ $product->stock }} left)
                                </span>
                            @else
                                <span class="text-xs font-bold text-red-500 bg-red-950/20 px-2.5 py-1 rounded-lg border border-red-900/30">
                                    Out of Stock
                                </span>
                            @endif
                        </div>

                        <div>
                            <label for="quantity" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Quantity</label>
                            <select id="quantity" name="quantity" class="w-full bg-gray-900 border border-gray-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                                @if($product->stock > 0)
                                    @for ($i = 1; $i <= min($product->stock, 10); $i++)
                                        <option value="{{ $i }}">{{ $i }} Unit{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                @else
                                    <option value="0">0 Units available</option>
                                @endif
                            </select>
                        </div>

                        <div class="pt-2">
                            <button type="submit" @disabled($product->stock <= 0) class="w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-3.5 px-4 rounded-xl transition shadow-lg shadow-orange-950/40 disabled:opacity-40 disabled:cursor-not-allowed transform active:scale-[0.99]">
                                Add To Order Bag
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <h2 class="text-xl font-black text-white tracking-tight mb-6">Other Fresh Recommendations</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="/product/{{ $related->id }}" class="group bg-gray-900/10 border border-gray-900 p-4 rounded-2xl hover:border-gray-800 transition block shadow-lg">
                            <div class="aspect-square w-full bg-gray-900 rounded-xl mb-4 overflow-hidden border border-gray-800/30">
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&q=80&w=300" alt="" class="w-full h-full object-cover opacity-70 group-hover:opacity-90 transition duration-300">
                            </div>
                            <h3 class="text-sm font-semibold text-gray-200 group-hover:text-orange-400 truncate transition">{{ $related->name }}</h3>
                            <p class="text-sm text-orange-500 font-extrabold mt-1">RM {{ number_format($related->price, 2) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

</body>
</html>