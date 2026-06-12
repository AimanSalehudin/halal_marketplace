<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard - Local'z</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex h-screen overflow-hidden">

    <aside class="w-64 bg-[#232328] text-gray-300 flex flex-col">
        <div class="p-6">
            <h1 class="text-white text-xl font-bold mb-8">Vendor Portal</h1>
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 bg-[#FF7900] text-white px-4 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="#products-list" class="flex items-center gap-3 hover:bg-[#323239] px-4 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    My Products
                </a>
                <a href="#" class="flex items-center gap-3 hover:bg-[#323239] px-4 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Orders
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-bold text-gray-800">Vendor Dashboard</h2>
            <div class="flex items-center gap-6">
                <div class="relative">
                    <input type="text" placeholder="Search inventory..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF7900] focus:border-transparent text-sm w-64">
                </div>
            </div>
        </header>

        <div class="p-8">
            
            <div class="bg-gradient-to-r from-[#16171B] to-[#232328] p-6 rounded-2xl shadow-sm text-white mb-8">
                <p class="text-xs text-gray-400 uppercase tracking-widest font-mono">Connected Store Profile</p>
                <h3 class="text-3xl font-extrabold text-[#FF7900] mt-1">{{ $restaurant->name ?? 'Store Profile Not Linked' }}</h3>
                <p class="text-sm text-gray-300 mt-1 font-light">Manage your products, live inventory listings, and legal Shariah metrics.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-green-500 text-sm font-semibold">+12.5%</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Total Sales Value</p>
                        <p class="text-3xl font-bold text-[#FF7900]">RM {{ number_format($totalSales ?? 0, 2) }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        @if(($lowStockCount ?? 0) > 0)
                            <span class="bg-red-100 text-red-600 text-xs font-semibold px-2.5 py-1 rounded-full">Action Required</span>
                        @else
                            <span class="bg-green-100 text-green-600 text-xs font-semibold px-2.5 py-1 rounded-full">Healthy Stock</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Low Stock Alerts</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $lowStockCount ?? 0 }}</p>
                        <p class="text-sm text-gray-500 mt-1">items need immediate restocking</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Verified</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Halal Compliance Status</p>
                        <p class="text-xl font-bold text-gray-800">Shariah Compliant</p>
                        <p class="text-sm text-gray-500 mt-1">Certificate tracking active</p>
                    </div>
                </div>
            </div>

            <div id="products-list" class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Product Management</h3>
                    <a href="/products/create" class="bg-[#FF7900] hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        + Add New Halal Product
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="px-6 py-4 font-medium">Product Name</th>
                                <th class="px-6 py-4 font-medium">Category</th>
                                <th class="px-6 py-4 font-medium">Unit Price</th>
                                <th class="px-6 py-4 font-medium">Stock Capacity</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $product->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full text-xs">
                                            {{ $product->category ?? 'General' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">RM {{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4">
                                        @if($product->stock <= 5)
                                            <span class="font-bold text-red-500">{{ $product->stock }} units left</span>
                                        @else
                                            <span class="text-gray-600">{{ $product->stock }} units</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-400 font-light">
                                        No halal products listed under this profile yet. Click add item to begin.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>