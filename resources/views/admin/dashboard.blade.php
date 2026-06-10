<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard — Halal Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Sidebar nav items */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 150ms ease, color 150ms ease;
            cursor: pointer;
            width: 100%;
            text-align: left;
            background: transparent;
            border: none;
            color: #d1d5db;
            text-decoration: none;
        }
        .nav-item:hover { background-color: rgba(255,255,255,0.1); color: #fff; }
        .nav-item.active { background-color: #FF7900 !important; color: #fff !important; }

        /* Stat cards */
        .stat-card {
            background: #fff;
            border-radius: 0.75rem;
            border: 1px solid #f3f4f6;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        /* Badges */
        .badge-halal {
            display: inline-flex; align-items: center; gap: 0.25rem;
            font-size: 0.75rem; font-weight: 600;
            padding: 0.125rem 0.5rem; border-radius: 9999px;
            background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;
        }
        .badge-pending {
            display: inline-flex; align-items: center; gap: 0.25rem;
            font-size: 0.75rem; font-weight: 600;
            padding: 0.125rem 0.5rem; border-radius: 9999px;
            background: #fffbeb; color: #92400e; border: 1px solid #fde68a;
        }
        .badge-low {
            display: inline-flex; align-items: center; gap: 0.25rem;
            font-size: 0.75rem; font-weight: 600;
            padding: 0.125rem 0.5rem; border-radius: 9999px;
            background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca;
        }

        /* Section visibility */
        .section { display: none; }
        .section.active { display: block; }

        /* Toast */
        .toast {
            position: fixed; bottom: 1.5rem; right: 1.5rem;
            background: #111827; color: #fff;
            font-size: 0.875rem; padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            z-index: 50; display: flex; align-items: center; gap: 0.5rem;
            transition: opacity 300ms ease, transform 300ms ease;
        }

        /* Table row hover */
        tr:hover td { background-color: rgba(255, 121, 0, 0.04); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex h-screen overflow-hidden">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-[#141A29] text-gray-300 flex flex-col flex-shrink-0 h-full">
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3 mb-1">
                <div class="w-8 h-8 rounded-lg bg-[#FF7900] flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
                <div>
                    <h1 class="text-white font-bold text-sm leading-none">Admin Portal</h1>
                    <p class="text-gray-500 text-xs mt-0.5">Halal Marketplace</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <button onclick="showSection('overview')" class="nav-item active w-full text-left" id="nav-overview">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Overview
            </button>
            <button onclick="showSection('products')" class="nav-item w-full text-left" id="nav-products">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Products
                @if($lowStock > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0">{{ $lowStock }}</span>
                @endif
            </button>
            <button onclick="showSection('restaurants')" class="nav-item w-full text-left" id="nav-restaurants">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Restaurants
            </button>
            <button onclick="showSection('halal')" class="nav-item w-full text-left" id="nav-halal">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Halal Compliance
                @php $pendingCount = $products->where('is_halal_certified', false)->count(); @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto bg-amber-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0">{{ $pendingCount }}</span>
                @endif
            </button>
        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 px-2 py-2">
                <div class="w-8 h-8 rounded-full bg-[#FF7900] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">A</div>
                <div class="min-w-0">
                    <p class="text-white text-sm font-medium truncate">Administrator</p>
                    <p class="text-gray-500 text-xs truncate">admin@halalmarket.my</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        {{-- Top Header --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center flex-shrink-0">
            <div>
                <h2 class="text-lg font-bold text-gray-800" id="page-title">Dashboard Overview</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ now()->format('l, d F Y') }}</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="bg-green-50 text-green-700 border border-green-200 text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> System Operational
                </span>
                <a href="/vendor/dashboard" class="text-sm text-gray-500 hover:text-gray-800 font-medium transition-colors">Vendor View →</a>
                <a href="/" class="text-sm text-gray-500 hover:text-gray-800 font-medium transition-colors">Buyer View →</a>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            {{-- ===== SECTION: OVERVIEW ===== --}}
            <div id="section-overview" class="section active">

                {{-- KPI Cards --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-2 bg-orange-50 rounded-lg text-[#FF7900]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Live</span>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }}</p>
                        <p class="text-sm text-gray-500 mt-1">Total Products</p>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-2 bg-green-50 rounded-lg text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-green-600">{{ $totalProducts > 0 ? round(($halalCertified / $totalProducts) * 100) : 0 }}%</span>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $halalCertified }}</p>
                        <p class="text-sm text-gray-500 mt-1">Halal Certified</p>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-2 bg-red-50 rounded-lg text-red-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            @if($lowStock > 0)
                                <span class="text-xs font-medium text-red-600 bg-red-50 px-2 py-0.5 rounded-full">Alert</span>
                            @endif
                        </div>
                        <p class="text-3xl font-bold {{ $lowStock > 0 ? 'text-red-600' : 'text-gray-800' }}">{{ $lowStock }}</p>
                        <p class="text-sm text-gray-500 mt-1">Low Stock Items</p>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-2 bg-orange-50 rounded-lg text-[#FF7900]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-gray-500">{{ $avgRating }}★ avg</span>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalRestaurants }}</p>
                        <p class="text-sm text-gray-500 mt-1">Restaurants</p>
                    </div>
                </div>

                {{-- Charts Row --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                    {{-- Category Distribution --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-1">Product categories</h3>
                        <p class="text-xs text-gray-400 mb-5">Distribution of all listed products</p>
                        <div class="relative" style="height: 240px;">
                            <canvas id="categoryChart" role="img" aria-label="Donut chart showing product category distribution">Product category breakdown</canvas>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-2 mt-4" id="categoryLegend"></div>
                    </div>

                    {{-- Halal vs Non-halal --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-1">Halal compliance rate</h3>
                        <p class="text-xs text-gray-400 mb-5">Certified vs pending across all products</p>
                        <div class="relative" style="height: 240px;">
                            <canvas id="halalChart" role="img" aria-label="Bar chart showing halal certified vs non-certified products">Halal compliance: {{ $halalCertified }} certified, {{ $totalProducts - $halalCertified }} pending</canvas>
                        </div>
                    </div>
                </div>

                {{-- Stock Overview & Recent Products --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- Low Stock Alert --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-800">Low stock alerts</h3>
                            @if($lowStock > 0)
                                <span class="badge-low">{{ $lowStock }} items</span>
                            @else
                                <span class="badge-halal">All stocked</span>
                            @endif
                        </div>
                        @if($lowStockProducts->count() > 0)
                            <div class="space-y-3">
                                @foreach($lowStockProducts as $p)
                                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">{{ $p->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $p->category }}</p>
                                    </div>
                                    <div class="flex items-center gap-3 flex-shrink-0 ml-4">
                                        <div class="w-24 bg-gray-100 rounded-full h-1.5">
                                            <div class="h-1.5 rounded-full {{ $p->stock < 10 ? 'bg-red-500' : 'bg-amber-400' }}" style="width: {{ min(100, ($p->stock / 50) * 100) }}%"></div>
                                        </div>
                                        <span class="text-sm font-semibold {{ $p->stock < 10 ? 'text-red-600' : 'text-amber-600' }} w-8 text-right">{{ $p->stock }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <p class="text-sm">All products are well stocked</p>
                            </div>
                        @endif
                    </div>

                    {{-- Recent Products --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-800">Recently added</h3>
                            <button onclick="showSection('products')" class="text-xs text-[#FF7900] font-medium hover:underline">View all →</button>
                        </div>
                        <div class="space-y-3">
                            @foreach($recentProducts as $p)
                            <div class="flex items-center gap-3 py-2 border-b border-gray-50 last:border-0">
                                @if($p->image_url)
                                    <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0 text-[#FF7900]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate">{{ $p->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $p->category }} · RM {{ number_format($p->price, 2) }}</p>
                                </div>
                                @if($p->is_halal_certified)
                                    <span class="badge-halal flex-shrink-0">✓ Halal</span>
                                @else
                                    <span class="badge-pending flex-shrink-0">Pending</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== SECTION: PRODUCTS ===== --}}
            <div id="section-products" class="section">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-800">All products</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $totalProducts }} products listed on the marketplace</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="text" id="productSearch" placeholder="Search products…" oninput="filterProducts()" class="text-sm border border-gray-200 rounded-lg px-3 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-[#FF7900]">
                        <select id="categoryFilter" onchange="filterProducts()" class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-200">
                            <option value="">All categories</option>
                            @foreach($categoryData->keys() as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                        <select id="halalFilter" onchange="filterProducts()" class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-200">
                            <option value="">All status</option>
                            <option value="1">Halal certified</option>
                            <option value="0">Pending</option>
                        </select>
                        <a href="/products/create" class="bg-[#FF7900] text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">+ Add product</a>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                    <table class="w-full text-sm" id="productsTable">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="text-left font-semibold text-gray-500 px-6 py-3 text-xs uppercase tracking-wide">Product</th>
                                <th class="text-left font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Category</th>
                                <th class="text-right font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Price</th>
                                <th class="text-right font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Stock</th>
                                <th class="text-center font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Halal</th>
                                <th class="text-center font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            @foreach($products as $p)
                            <tr class="border-b border-gray-50 product-row transition-colors"
                                data-name="{{ strtolower($p->name) }}"
                                data-category="{{ $p->category }}"
                                data-halal="{{ $p->is_halal_certified ? '1' : '0' }}"
                                data-id="{{ $p->id }}">
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-3">
                                        @if($p->image_url)
                                            <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-9 h-9 rounded-lg object-cover flex-shrink-0">
                                        @else
                                            <div class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center text-[#FF7900] flex-shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                            </div>
                                        @endif
                                        <span class="font-medium text-gray-800">{{ $p->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $p->category }}</td>
                                <td class="px-4 py-3 text-right font-medium text-gray-800">RM {{ number_format($p->price, 2) }}</td>
                                <td class="px-4 py-3 text-right">
                                    <span class="{{ $p->stock < 10 ? 'text-red-600 font-semibold' : ($p->stock < 20 ? 'text-amber-600 font-semibold' : 'text-gray-700') }}">
                                        {{ $p->stock }}
                                    </span>
                                    @if($p->stock < 10) <span class="text-red-400 text-xs ml-1">⚠</span> @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($p->is_halal_certified)
                                        <span class="badge-halal">✓ Certified</span>
                                    @else
                                        <span class="badge-pending">⏳ Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if(!$p->is_halal_certified)
                                            <button onclick="approveCert({{ $p->id }}, this)" class="text-xs bg-green-50 text-green-700 border border-green-200 font-medium px-2 py-1 rounded-md hover:bg-green-100 transition-colors" title="Approve Halal certification">Approve</button>
                                        @else
                                            <button onclick="revokeCert({{ $p->id }}, this)" class="text-xs bg-amber-50 text-amber-700 border border-amber-200 font-medium px-2 py-1 rounded-md hover:bg-amber-100 transition-colors" title="Revoke Halal certification">Revoke</button>
                                        @endif
                                        <button onclick="deleteProduct({{ $p->id }}, this)" class="text-xs bg-red-50 text-red-600 border border-red-200 font-medium px-2 py-1 rounded-md hover:bg-red-100 transition-colors" title="Delete product">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="noResults" class="hidden text-center py-12 text-gray-400">
                        <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <p class="text-sm">No products match your filter</p>
                    </div>
                </div>

                {{-- Stock visualization --}}
                <div class="mt-6 bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-1">Stock levels</h3>
                    <p class="text-xs text-gray-400 mb-5">Current stock for all products</p>
                    <div style="position: relative; height: {{ max(200, $products->count() * 40) }}px;">
                        <canvas id="stockChart" role="img" aria-label="Horizontal bar chart of product stock levels">Stock levels per product</canvas>
                    </div>
                </div>
            </div>

            {{-- ===== SECTION: RESTAURANTS ===== --}}
            <div id="section-restaurants" class="section">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-800">Restaurant listings</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $totalRestaurants }} restaurants · {{ $avgRating }}★ average rating</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(\App\Models\Restaurant::all() as $r)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden flex">
                        @if($r->image_url)
                            <img src="{{ $r->image_url }}" alt="{{ $r->name }}" class="w-24 h-24 object-cover flex-shrink-0">
                        @else
                            <div class="w-24 h-24 bg-orange-50 flex items-center justify-center flex-shrink-0 text-[#FF7900]">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                        <div class="p-4 flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $r->name }}</h4>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $r->category }}</p>
                                </div>
                                <div class="flex items-center gap-1 bg-amber-50 text-amber-700 text-xs font-semibold px-2 py-1 rounded-lg flex-shrink-0">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    {{ $r->rating }}
                                </div>
                            </div>
                            <div class="mt-3 flex items-center gap-2">
                                <span class="badge-halal">✓ Halal Certified</span>
                                <span class="text-xs text-gray-400">ID #{{ $r->id }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Ratings Chart --}}
                <div class="mt-6 bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-1">Restaurant ratings</h3>
                    <p class="text-xs text-gray-400 mb-5">Customer rating comparison</p>
                    <div style="position: relative; height: 220px;">
                        <canvas id="ratingsChart" role="img" aria-label="Bar chart of restaurant ratings">Restaurant ratings comparison</canvas>
                    </div>
                </div>
            </div>

            {{-- ===== SECTION: HALAL COMPLIANCE ===== --}}
            <div id="section-halal" class="section">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-800">Halal compliance management</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Review and manage Halal certifications for all marketplace products</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-center px-4 py-2 bg-green-50 rounded-lg border border-green-100">
                            <p class="text-lg font-bold text-green-700">{{ $halalCertified }}</p>
                            <p class="text-xs text-green-600">Certified</p>
                        </div>
                        <div class="text-center px-4 py-2 bg-amber-50 rounded-lg border border-amber-100">
                            <p class="text-lg font-bold text-amber-700">{{ $totalProducts - $halalCertified }}</p>
                            <p class="text-xs text-amber-600">Pending</p>
                        </div>
                    </div>
                </div>

                {{-- Compliance Rate Bar --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium text-gray-700">Overall compliance rate</span>
                        <span class="text-sm font-bold text-gray-800">{{ $totalProducts > 0 ? round(($halalCertified / $totalProducts) * 100) : 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3">
                        @php $rate = $totalProducts > 0 ? round(($halalCertified / $totalProducts) * 100) : 0; @endphp
                        <div class="h-3 rounded-full bg-gradient-to-r from-green-400 to-green-600 transition-all duration-700" style="width: {{ $rate }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-2">
                        <span>0%</span>
                        <span>Target: 100%</span>
                    </div>
                </div>

                {{-- Pending Certifications --}}
                @php $pendingProducts = $products->where('is_halal_certified', false); @endphp
                @if($pendingProducts->count() > 0)
                <div class="bg-white rounded-xl border border-amber-200 shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-amber-50 border-b border-amber-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <h4 class="font-semibold text-amber-800 text-sm">Products awaiting certification ({{ $pendingProducts->count() }})</h4>
                    </div>
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="text-left font-semibold text-gray-500 px-6 py-3 text-xs uppercase tracking-wide">Product</th>
                                <th class="text-left font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Category</th>
                                <th class="text-right font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Price</th>
                                <th class="text-center font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingProducts as $p)
                            <tr class="border-b border-gray-50 transition-colors" id="halal-row-{{ $p->id }}">
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-3">
                                        @if($p->image_url)
                                            <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-9 h-9 rounded-lg object-cover">
                                        @endif
                                        <span class="font-medium text-gray-800">{{ $p->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ $p->category }}</td>
                                <td class="px-4 py-3 text-right font-medium">RM {{ number_format($p->price, 2) }}</td>
                                <td class="px-4 py-3 text-center">
                                    <button onclick="approveCert({{ $p->id }}, this, true)" class="bg-green-600 text-white text-xs font-semibold px-4 py-1.5 rounded-lg hover:bg-green-700 transition-colors">✓ Approve Halal</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="bg-green-50 border border-green-200 rounded-xl p-8 text-center mb-6">
                    <svg class="w-12 h-12 mx-auto mb-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h4 class="font-semibold text-green-800">All products are Halal certified!</h4>
                    <p class="text-sm text-green-600 mt-1">Full marketplace compliance achieved.</p>
                </div>
                @endif

                {{-- All certified products --}}
                <div class="bg-white rounded-xl border border-green-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 bg-green-50 border-b border-green-100 flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h4 class="font-semibold text-green-800 text-sm">Certified products ({{ $halalCertified }})</h4>
                    </div>
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="text-left font-semibold text-gray-500 px-6 py-3 text-xs uppercase tracking-wide">Product</th>
                                <th class="text-left font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Category</th>
                                <th class="text-center font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Status</th>
                                <th class="text-center font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products->where('is_halal_certified', true) as $p)
                            <tr class="border-b border-gray-50 transition-colors" id="cert-row-{{ $p->id }}">
                                <td class="px-6 py-3 font-medium text-gray-800">{{ $p->name }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $p->category }}</td>
                                <td class="px-4 py-3 text-center"><span class="badge-halal">✓ Halal Certified</span></td>
                                <td class="px-4 py-3 text-center">
                                    <button onclick="revokeCert({{ $p->id }}, this)" class="text-xs bg-red-50 text-red-600 border border-red-200 font-medium px-3 py-1 rounded-md hover:bg-red-100 transition-colors">Revoke</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    {{-- Toast notification --}}
    <div id="toast" class="toast opacity-0 pointer-events-none" style="transform: translateY(1rem);">
        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span id="toastMsg">Done</span>
    </div>

    <script>
    // ===== SECTION NAVIGATION =====
    function showSection(name) {
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('[id^="nav-"]').forEach(n => n.classList.remove('active'));
        document.getElementById('section-' + name).classList.add('active');
        document.getElementById('nav-' + name).classList.add('active');
        const titles = { overview: 'Dashboard Overview', products: 'Product Management', restaurants: 'Restaurant Listings', halal: 'Halal Compliance' };
        document.getElementById('page-title').textContent = titles[name] || 'Dashboard';
        if (name === 'products' && !window.stockChartBuilt) buildStockChart();
        if (name === 'restaurants' && !window.ratingsChartBuilt) buildRatingsChart();
    }

    // ===== TOAST =====
    function showToast(msg, isError = false) {
        const t = document.getElementById('toast');
        const icon = t.querySelector('svg');
        document.getElementById('toastMsg').textContent = msg;
        icon.classList.toggle('text-green-400', !isError);
        icon.classList.toggle('text-red-400', isError);
        t.style.opacity = '1';
        t.style.transform = 'translateY(0)';
        t.style.pointerEvents = 'auto';
        setTimeout(() => {
            t.style.opacity = '0';
            t.style.transform = 'translateY(1rem)';
            t.style.pointerEvents = 'none';
        }, 3200);
    }

    // ===== CSRF HELPER =====
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ===== PRODUCT FILTER =====
    function filterProducts() {
        const search = document.getElementById('productSearch').value.toLowerCase();
        const cat = document.getElementById('categoryFilter').value;
        const halal = document.getElementById('halalFilter').value;
        let visible = 0;
        document.querySelectorAll('.product-row').forEach(row => {
            const nameMatch = row.dataset.name.includes(search);
            const catMatch = !cat || row.dataset.category === cat;
            const halalMatch = !halal || row.dataset.halal === halal;
            const show = nameMatch && catMatch && halalMatch;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        document.getElementById('noResults').classList.toggle('hidden', visible > 0);
    }

    // ===== APPROVE CERTIFICATION =====
    function approveCert(id, btn, fromHalalTab = false) {
        btn.disabled = true;
        btn.textContent = '…';
        fetch('/admin/products/' + id + '/approve-halal', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('Halal certification approved');
                const row = document.querySelector('[data-id="' + id + '"]');
                if (row) {
                    row.dataset.halal = '1';
                    const badgeCell = row.children[4];
                    if (badgeCell) badgeCell.innerHTML = '<span class="badge-halal">✓ Certified</span>';
                    const actionCell = row.children[5];
                    if (actionCell) {
                        actionCell.innerHTML = '<div class="flex items-center justify-center gap-2"><button onclick="revokeCert(' + id + ', this)" class="text-xs bg-amber-50 text-amber-700 border border-amber-200 font-medium px-2 py-1 rounded-md hover:bg-amber-100 transition-colors">Revoke</button><button onclick="deleteProduct(' + id + ', this)" class="text-xs bg-red-50 text-red-600 border border-red-200 font-medium px-2 py-1 rounded-md hover:bg-red-100 transition-colors">Delete</button></div>';
                    }
                }
                if (fromHalalTab) {
                    const hrow = document.getElementById('halal-row-' + id);
                    if (hrow) hrow.remove();
                }
            } else {
                showToast('Error — try again', true);
                btn.disabled = false;
                btn.textContent = 'Approve';
            }
        })
        .catch(() => { showToast('Network error', true); btn.disabled = false; });
    }

    // ===== REVOKE CERTIFICATION =====
    function revokeCert(id, btn) {
        if (!confirm('Revoke Halal certification for this product?')) return;
        btn.disabled = true;
        fetch('/admin/products/' + id + '/revoke-halal', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('Certification revoked');
                const row = document.querySelector('[data-id="' + id + '"]');
                if (row) {
                    row.dataset.halal = '0';
                    const badgeCell = row.children[4];
                    if (badgeCell) badgeCell.innerHTML = '<span class="badge-pending">⏳ Pending</span>';
                    const actionCell = row.children[5];
                    if (actionCell) {
                        actionCell.innerHTML = '<div class="flex items-center justify-center gap-2"><button onclick="approveCert(' + id + ', this)" class="text-xs bg-green-50 text-green-700 border border-green-200 font-medium px-2 py-1 rounded-md hover:bg-green-100">Approve</button><button onclick="deleteProduct(' + id + ', this)" class="text-xs bg-red-50 text-red-600 border border-red-200 font-medium px-2 py-1 rounded-md hover:bg-red-100">Delete</button></div>';
                    }
                }
            } else {
                showToast('Error — try again', true);
                btn.disabled = false;
            }
        })
        .catch(() => { showToast('Network error', true); btn.disabled = false; });
    }

    // ===== DELETE PRODUCT =====
    function deleteProduct(id, btn) {
        if (!confirm('Permanently delete this product? This cannot be undone.')) return;
        btn.disabled = true;
        fetch('/admin/products/' + id, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('Product deleted');
                const row = document.querySelector('[data-id="' + id + '"]');
                if (row) { row.style.opacity = '0'; row.style.transition = 'opacity 0.3s'; setTimeout(() => row.remove(), 300); }
            } else {
                showToast('Error — try again', true);
                btn.disabled = false;
            }
        })
        .catch(() => { showToast('Network error', true); btn.disabled = false; });
    }

    // ===== CHART DATA FROM BLADE =====
    const categoryLabels = @json($categoryData->keys());
    const categoryValues = @json($categoryData->values());
    const productNames = @json($products->pluck('name'));
    const productStock = @json($products->pluck('stock'));
    const productHalal = @json($products->pluck('is_halal_certified'));
    const restaurantNames = @json(\App\Models\Restaurant::pluck('name'));
    const restaurantRatings = @json(\App\Models\Restaurant::pluck('rating'));
    const halalCertified = {{ $halalCertified }};
    const totalProducts = {{ $totalProducts }};

    const ORANGE_PALETTE = ['#FF7900','#FF9A3E','#FFB567','#FFCF97','#FFE4C4','#FFF0E0','#FFF8F0'];
    const CHART_DEFAULTS = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } }
    };

    // ===== CATEGORY DONUT =====
    const catCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(catCtx, {
        type: 'doughnut',
        data: {
            labels: categoryLabels,
            datasets: [{
                data: categoryValues,
                backgroundColor: ORANGE_PALETTE.slice(0, categoryLabels.length),
                borderWidth: 2,
                borderColor: '#fff',
                hoverBorderWidth: 3
            }]
        },
        options: {
            ...CHART_DEFAULTS,
            cutout: '65%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.label}: ${ctx.parsed} products`
                    }
                }
            }
        }
    });

    // Build custom legend
    const legend = document.getElementById('categoryLegend');
    categoryLabels.forEach((label, i) => {
        const total = categoryValues.reduce((a, b) => a + b, 0);
        const pct = total > 0 ? Math.round((categoryValues[i] / total) * 100) : 0;
        legend.innerHTML += `<span style="display:flex;align-items:center;gap:4px;font-size:12px;color:var(--color-text-secondary, #6b7280);">
            <span style="width:10px;height:10px;border-radius:2px;background:${ORANGE_PALETTE[i]};display:inline-block;"></span>
            ${label} ${pct}%
        </span>`;
    });

    // ===== HALAL COMPLIANCE BAR =====
    const halalCtx = document.getElementById('halalChart').getContext('2d');
    new Chart(halalCtx, {
        type: 'bar',
        data: {
            labels: ['Halal certified', 'Pending certification'],
            datasets: [{
                data: [halalCertified, totalProducts - halalCertified],
                backgroundColor: ['#16a34a', '#f59e0b'],
                borderRadius: 8,
                barThickness: 60
            }]
        },
        options: {
            ...CHART_DEFAULTS,
            scales: {
                y: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { stepSize: 1, font: { size: 11 } } },
                x: { grid: { display: false }, ticks: { font: { size: 12 } } }
            }
        }
    });

    // ===== STOCK CHART (lazy) =====
    window.stockChartBuilt = false;
    function buildStockChart() {
        const ctx = document.getElementById('stockChart').getContext('2d');
        const bgColors = productStock.map(s => s < 10 ? '#ef4444' : s < 20 ? '#f59e0b' : '#FF7900');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Stock',
                    data: productStock,
                    backgroundColor: bgColors,
                    borderRadius: 4,
                    barThickness: 24
                }]
            },
            options: {
                ...CHART_DEFAULTS,
                indexAxis: 'y',
                scales: {
                    x: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { font: { size: 11 } } },
                    y: { grid: { display: false }, ticks: { font: { size: 12 } } }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: ctx => ` ${ctx.parsed.x} units in stock` } }
                }
            }
        });
        window.stockChartBuilt = true;
    }

    // ===== RATINGS CHART (lazy) =====
    window.ratingsChartBuilt = false;
    function buildRatingsChart() {
        const ctx = document.getElementById('ratingsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: restaurantNames,
                datasets: [{
                    label: 'Rating',
                    data: restaurantRatings,
                    backgroundColor: '#FF7900',
                    borderRadius: 8,
                    barThickness: 48
                }]
            },
            options: {
                ...CHART_DEFAULTS,
                scales: {
                    y: { min: 0, max: 5, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false }, ticks: { font: { size: 12 } } }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: ctx => ` ${ctx.parsed.y} / 5.0 stars` } }
                }
            }
        });
        window.ratingsChartBuilt = true;
    }
    </script>
</body>
</html>
