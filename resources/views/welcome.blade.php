<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard Prototype</title>
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
                <a href="#" class="flex items-center gap-3 hover:bg-[#323239] px-4 py-3 rounded-lg font-medium transition-colors">
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
            <h2 class="text-2xl font-semibold text-gray-800">McDonald's</h2>
            
            <div class="flex items-center gap-6">
                <div class="relative">
                    <input type="text" placeholder="Search inventory..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF7900] focus:border-transparent text-sm w-64">
                </div>
            </div>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-green-500 text-sm font-semibold">+12.5%</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Total Sales</p>
                        <p class="text-3xl font-bold text-[#FF7900]">$48,392</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-red-100 text-red-600 text-xs font-semibold px-2.5 py-1 rounded-full">Action Required</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Low Stock Alerts</p>
                        <p class="text-3xl font-bold text-gray-800">1</p>
                        <p class="text-sm text-gray-500 mt-1">items need restocking</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Verified</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Halal Status</p>
                        <p class="text-xl font-bold text-gray-800">Shariah Compliant</p>
                        <p class="text-sm text-gray-500 mt-1">Certificate valid until Dec 2026</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Product Management</h3>
                    </div>
                    <!-- Replace your old button with this -->
                    <a href="/products/create" class="bg-[#FF7900] hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        + Add New Halal Product
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="px-6 py-4 font-medium">Product</th>
                                <th class="px-6 py-4 font-medium">Category</th>
                                <th class="px-6 py-4 font-medium">Price</th>
                                <th class="px-6 py-4 font-medium">Stock</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-semibold text-gray-800">Classic Halal Burger</td>
                                <td class="px-6 py-4"><span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full text-xs">Burgers</span></td>
                                <td class="px-6 py-4 text-gray-600">$8.99</td>
                                <td class="px-6 py-4 text-gray-600">45 units</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-semibold text-gray-800">Chicken Nuggets</td>
                                <td class="px-6 py-4"><span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full text-xs">Sides</span></td>
                                <td class="px-6 py-4 text-gray-600">$5.49</td>
                                <td class="px-6 py-4 font-semibold text-red-500">8 units</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>