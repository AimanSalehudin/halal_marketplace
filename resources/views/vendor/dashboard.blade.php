<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $vendorName }} — Vendor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Sidebar nav items — synced with admin dashboard */
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

        /* Badges — synced with admin */
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
        .badge-processing {
            display: inline-flex; align-items: center; gap: 0.25rem;
            font-size: 0.75rem; font-weight: 600;
            padding: 0.125rem 0.5rem; border-radius: 9999px;
            background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe;
        }
        .badge-completed {
            display: inline-flex; align-items: center; gap: 0.25rem;
            font-size: 0.75rem; font-weight: 600;
            padding: 0.125rem 0.5rem; border-radius: 9999px;
            background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;
        }
        .badge-cancelled {
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

        /* Modal backdrop */
        .modal-backdrop {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 40;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 200ms ease;
        }
        .modal-backdrop.open {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-content {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            width: 100%;
            max-width: 32rem;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.95);
            transition: transform 200ms ease;
        }
        .modal-backdrop.open .modal-content {
            transform: scale(1);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex h-screen overflow-hidden">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-[#141A29] text-gray-300 flex flex-col flex-shrink-0 h-full">
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-3 mb-1">
                <div class="w-8 h-8 rounded-lg bg-[#FF7900] flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <h1 class="text-white font-bold text-sm leading-none">Vendor Portal</h1>
                    <p class="text-gray-500 text-xs mt-0.5">{{ $vendorName }}</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <button onclick="showSection('overview')" class="nav-item active w-full text-left" id="nav-overview">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </button>
            <button onclick="showSection('products')" class="nav-item w-full text-left" id="nav-products">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                My Products
                @if($lowStock > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0">{{ $lowStock }}</span>
                @endif
            </button>
            <button onclick="showSection('orders')" class="nav-item w-full text-left" id="nav-orders">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Orders
                @if($pendingOrders > 0)
                    <span class="ml-auto bg-amber-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0">{{ $pendingOrders }}</span>
                @endif
            </button>
        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 px-2 py-2">
                <div class="w-8 h-8 rounded-full bg-[#FF7900] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr($vendor->name ?? 'V', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-white text-sm font-medium truncate">{{ $vendor->name ?? 'Vendor' }}</p>
                    <p class="text-gray-500 text-xs truncate">{{ $vendor->email ?? 'vendor@local.com' }}</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        {{-- Top Header --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center flex-shrink-0">
            <div>
                <h2 class="text-lg font-bold text-gray-800" id="page-title">{{ $vendorName }}'s Dashboard</h2>
                <p class="text-xs text-gray-400 mt-0.5">{{ now()->format('l, d F Y') }}</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="bg-green-50 text-green-700 border border-green-200 text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Store Active
                </span>
                <a href="/admin/dashboard" class="text-sm text-gray-500 hover:text-gray-800 font-medium transition-colors">Admin View →</a>
                <a href="/" class="text-sm text-gray-500 hover:text-gray-800 font-medium transition-colors">Buyer View →</a>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            {{-- ===== SECTION: OVERVIEW ===== --}}
            <div id="section-overview" class="section active">

                {{-- Store Profile Banner --}}
                <div class="bg-gradient-to-r from-[#141A29] to-[#1e2636] p-6 rounded-2xl shadow-sm text-white mb-8 flex items-center gap-6">
                    @if($restaurant && $restaurant->image_url)
                        <img src="{{ $restaurant->image_url }}" alt="{{ $vendorName }}" class="w-20 h-20 rounded-xl object-cover flex-shrink-0 border-2 border-white/20">
                    @else
                        <div class="w-20 h-20 rounded-xl bg-[#FF7900]/20 flex items-center justify-center flex-shrink-0 border-2 border-white/10">
                            <svg class="w-10 h-10 text-[#FF7900]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    @endif
                    <div class="flex-1">
                        <p class="text-xs text-gray-400 uppercase tracking-widest font-mono mb-1">Connected Store Profile</p>
                        <h3 class="text-3xl font-extrabold text-[#FF7900]">{{ $vendorName }}</h3>
                        <p class="text-sm text-gray-300 mt-1 font-light">
                            {{ $restaurant->category ?? 'Halal' }} · ★ {{ $restaurant->rating ?? '0.0' }} rating ·
                            Manage your products, inventory & orders from one place.
                        </p>
                    </div>
                    <div class="flex-shrink-0 text-right">
                        <span class="badge-halal text-sm px-3 py-1">✓ Halal Verified</span>
                    </div>
                </div>

                {{-- KPI Cards --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-2 bg-orange-50 rounded-lg text-[#FF7900]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Revenue</span>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">RM {{ number_format($totalRevenue, 2) }}</p>
                        <p class="text-sm text-gray-500 mt-1">Total Revenue</p>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-blue-600">{{ $totalOrders }} total</span>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalOrders }}</p>
                        <p class="text-sm text-gray-500 mt-1">Total Orders</p>
                    </div>

                    <div class="stat-card">
                        <div class="flex items-start justify-between mb-3">
                            <div class="p-2 bg-green-50 rounded-lg text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Live</span>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }}</p>
                        <p class="text-sm text-gray-500 mt-1">My Products</p>
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
                </div>

                {{-- Charts Row --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

                    {{-- Category Breakdown --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-1">Product categories</h3>
                        <p class="text-xs text-gray-400 mb-5">Your product distribution by category</p>
                        <div class="relative" style="height: 240px;">
                            <canvas id="categoryChart" role="img" aria-label="Donut chart showing product category distribution">Product category breakdown</canvas>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-2 mt-4" id="categoryLegend"></div>
                    </div>

                    {{-- Revenue Breakdown --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-1">Order status breakdown</h3>
                        <p class="text-xs text-gray-400 mb-5">Current status of all your orders</p>
                        <div class="relative" style="height: 240px;">
                            <canvas id="orderStatusChart" role="img" aria-label="Bar chart showing order statuses">Order status distribution</canvas>
                        </div>
                    </div>
                </div>

                {{-- Low Stock & Recent Orders --}}
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

                    {{-- Recent Orders --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-gray-800">Recent orders</h3>
                            <button onclick="showSection('orders')" class="text-xs text-[#FF7900] font-medium hover:underline">View all →</button>
                        </div>
                        @if($orders->count() > 0)
                            <div class="space-y-3">
                                @foreach($orders->take(5) as $o)
                                <div class="flex items-center gap-3 py-2 border-b border-gray-50 last:border-0">
                                    <div class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0 text-[#FF7900]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">{{ $o->product_name }}</p>
                                        <p class="text-xs text-gray-400">{{ $o->customer_name }} · {{ $o->ordered_at ? $o->ordered_at->diffForHumans() : 'N/A' }}</p>
                                    </div>
                                    <div class="text-right flex-shrink-0">
                                        <p class="text-sm font-semibold text-gray-800">RM {{ number_format($o->price * $o->quantity, 2) }}</p>
                                        @if($o->status === 'completed')
                                            <span class="badge-completed">Completed</span>
                                        @elseif($o->status === 'processing')
                                            <span class="badge-processing">Processing</span>
                                        @elseif($o->status === 'pending')
                                            <span class="badge-pending">Pending</span>
                                        @else
                                            <span class="badge-cancelled">Cancelled</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <p class="text-sm">No orders yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ===== SECTION: MY PRODUCTS ===== --}}
            <div id="section-products" class="section">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-800">My products</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $totalProducts }} products listed under {{ $vendorName }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="text" id="productSearch" placeholder="Search products…" oninput="filterProducts()" class="text-sm border border-gray-200 rounded-lg px-3 py-2 w-48 focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-[#FF7900]">
                        <select id="categoryFilter" onchange="filterProducts()" class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-200">
                            <option value="">All categories</option>
                            @foreach($categoryData->keys() as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                        <button onclick="openAddModal()" class="bg-[#FF7900] text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add New Halal Product
                        </button>
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
                                        <div>
                                            <span class="font-medium text-gray-800">{{ $p->name }}</span>
                                            @if($p->description)
                                                <p class="text-xs text-gray-400 truncate max-w-[200px]">{{ $p->description }}</p>
                                            @endif
                                        </div>
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
                                        <button onclick='openEditModal(@json($p))' class="text-xs bg-blue-50 text-blue-700 border border-blue-200 font-medium px-2 py-1 rounded-md hover:bg-blue-100 transition-colors" title="Edit product">Edit</button>
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
                    <p class="text-xs text-gray-400 mb-5">Current stock for your products</p>
                    <div style="position: relative; height: {{ max(200, $products->count() * 40) }}px;">
                        <canvas id="stockChart" role="img" aria-label="Horizontal bar chart of product stock levels">Stock levels per product</canvas>
                    </div>
                </div>
            </div>

            {{-- ===== SECTION: ORDERS ===== --}}
            <div id="section-orders" class="section">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-800">Order management</h3>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $totalOrders }} orders · RM {{ number_format($totalRevenue, 2) }} total revenue</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-center px-4 py-2 bg-amber-50 rounded-lg border border-amber-100">
                            <p class="text-lg font-bold text-amber-700">{{ $pendingOrders }}</p>
                            <p class="text-xs text-amber-600">Pending</p>
                        </div>
                        <div class="text-center px-4 py-2 bg-blue-50 rounded-lg border border-blue-100">
                            <p class="text-lg font-bold text-blue-700">{{ $processingOrders }}</p>
                            <p class="text-xs text-blue-600">Processing</p>
                        </div>
                        <div class="text-center px-4 py-2 bg-green-50 rounded-lg border border-green-100">
                            <p class="text-lg font-bold text-green-700">{{ $orders->where('status', 'completed')->count() }}</p>
                            <p class="text-xs text-green-600">Completed</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="text-left font-semibold text-gray-500 px-6 py-3 text-xs uppercase tracking-wide">Order #</th>
                                <th class="text-left font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Customer</th>
                                <th class="text-left font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Product</th>
                                <th class="text-right font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Qty</th>
                                <th class="text-right font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Total</th>
                                <th class="text-center font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Status</th>
                                <th class="text-left font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Date</th>
                                <th class="text-center font-semibold text-gray-500 px-4 py-3 text-xs uppercase tracking-wide">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $o)
                            <tr class="border-b border-gray-50 transition-colors" id="order-row-{{ $o->id }}">
                                <td class="px-6 py-3">
                                    <span class="font-mono text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">#{{ str_pad($o->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $o->customer_name }}</p>
                                        <p class="text-xs text-gray-400">{{ $o->customer_email }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $o->product_name }}</td>
                                <td class="px-4 py-3 text-right text-gray-700">× {{ $o->quantity }}</td>
                                <td class="px-4 py-3 text-right font-semibold text-gray-800">RM {{ number_format($o->price * $o->quantity, 2) }}</td>
                                <td class="px-4 py-3 text-center" id="order-status-{{ $o->id }}">
                                    @if($o->status === 'completed')
                                        <span class="badge-completed">✓ Completed</span>
                                    @elseif($o->status === 'processing')
                                        <span class="badge-processing">⚙ Processing</span>
                                    @elseif($o->status === 'pending')
                                        <span class="badge-pending">⏳ Pending</span>
                                    @else
                                        <span class="badge-cancelled">✕ Cancelled</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-500 text-xs">{{ $o->ordered_at ? $o->ordered_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <select onchange="updateOrderStatus({{ $o->id }}, this.value, this)"
                                        class="text-xs border border-gray-200 rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-orange-200 bg-white">
                                        <option value="pending" {{ $o->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $o->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $o->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $o->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                                    <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    <p class="text-sm">No orders received yet</p>
                                    <p class="text-xs mt-1">Orders from customers will appear here</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Revenue Summary --}}
                @if($orders->count() > 0)
                <div class="mt-6 bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-1">Revenue by product</h3>
                    <p class="text-xs text-gray-400 mb-5">How much each product contributes to your revenue</p>
                    <div style="position: relative; height: 260px;">
                        <canvas id="revenueChart" role="img" aria-label="Bar chart of revenue per product">Revenue breakdown by product</canvas>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </main>

    {{-- ===== ADD/EDIT PRODUCT MODAL ===== --}}
    <div id="productModal" class="modal-backdrop" onclick="if(event.target===this) closeModal()">
        <div class="modal-content">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800" id="modalTitle">Add New Halal Product</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form id="productForm" onsubmit="submitProduct(event)" class="p-6 space-y-4">
                <input type="hidden" id="editProductId" value="">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" id="productName" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-[#FF7900]" placeholder="e.g. Halal Beef Burger">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                        <select id="productCategory" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-[#FF7900]">
                            <option value="Burgers">Burgers</option>
                            <option value="Rice Dishes">Rice Dishes</option>
                            <option value="Wraps">Wraps</option>
                            <option value="Grills">Grills</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Salads">Salads</option>
                            <option value="Pizzas">Pizzas</option>
                            <option value="Beverages">Beverages</option>
                            <option value="Desserts">Desserts</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price (RM) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" min="0.01" id="productPrice" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-[#FF7900]" placeholder="0.00">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity <span class="text-red-500">*</span></label>
                        <input type="number" min="0" id="productStock" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-[#FF7900]" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                        <input type="url" id="productImageUrl" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-[#FF7900]" placeholder="https://example.com/image.jpg">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="productDescription" rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-[#FF7900] resize-none" placeholder="Describe your product..."></textarea>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
                    <p class="text-xs text-amber-800 flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        New products will be listed as <strong>Pending Halal Certification</strong> until approved by the admin.
                    </p>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2.5 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 font-medium text-sm transition-colors">Cancel</button>
                    <button type="submit" id="submitBtn" class="px-6 py-2.5 bg-[#FF7900] text-white rounded-lg hover:bg-orange-600 font-medium text-sm transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4 hidden" id="submitSpinner" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span id="submitText">Save Product</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Toast notification --}}
    <div id="toast" class="toast opacity-0 pointer-events-none" style="transform: translateY(1rem);">
        <svg class="w-4 h-4 text-green-400" id="toastIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span id="toastMsg">Done</span>
    </div>

    <script>
    // ===== CSRF HELPER =====
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // ===== SECTION NAVIGATION =====
    function showSection(name) {
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('[id^="nav-"]').forEach(n => n.classList.remove('active'));
        document.getElementById('section-' + name).classList.add('active');
        document.getElementById('nav-' + name).classList.add('active');
        const titles = {
            overview: '{{ $vendorName }}\'s Dashboard',
            products: 'My Products',
            orders: 'Order Management'
        };
        document.getElementById('page-title').textContent = titles[name] || 'Dashboard';

        // Lazy-load charts
        if (name === 'products' && !window.stockChartBuilt) buildStockChart();
        if (name === 'orders' && !window.revenueChartBuilt) buildRevenueChart();
    }

    // ===== TOAST =====
    function showToast(msg, isError = false) {
        const t = document.getElementById('toast');
        const icon = document.getElementById('toastIcon');
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

    // ===== PRODUCT FILTER =====
    function filterProducts() {
        const search = document.getElementById('productSearch').value.toLowerCase();
        const cat = document.getElementById('categoryFilter').value;
        let visible = 0;
        document.querySelectorAll('.product-row').forEach(row => {
            const nameMatch = row.dataset.name.includes(search);
            const catMatch = !cat || row.dataset.category === cat;
            const show = nameMatch && catMatch;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        document.getElementById('noResults').classList.toggle('hidden', visible > 0);
    }

    // ===== MODAL MANAGEMENT =====
    function openAddModal() {
        document.getElementById('modalTitle').textContent = 'Add New Halal Product';
        document.getElementById('submitText').textContent = 'Save Product';
        document.getElementById('editProductId').value = '';
        document.getElementById('productForm').reset();
        document.getElementById('productModal').classList.add('open');
    }

    function openEditModal(product) {
        document.getElementById('modalTitle').textContent = 'Edit Product';
        document.getElementById('submitText').textContent = 'Update Product';
        document.getElementById('editProductId').value = product.id;
        document.getElementById('productName').value = product.name;
        document.getElementById('productCategory').value = product.category;
        document.getElementById('productPrice').value = product.price;
        document.getElementById('productStock').value = product.stock;
        document.getElementById('productDescription').value = product.description || '';
        document.getElementById('productImageUrl').value = product.image_url || '';
        document.getElementById('productModal').classList.add('open');
    }

    function closeModal() {
        document.getElementById('productModal').classList.remove('open');
    }

    // ===== SUBMIT PRODUCT (ADD/EDIT) =====
    function submitProduct(e) {
        e.preventDefault();
        const id = document.getElementById('editProductId').value;
        const isEdit = !!id;
        const url = isEdit ? '/vendor/products/' + id : '/vendor/products';
        const method = isEdit ? 'PUT' : 'POST';

        const btn = document.getElementById('submitBtn');
        const spinner = document.getElementById('submitSpinner');
        const text = document.getElementById('submitText');
        btn.disabled = true;
        spinner.classList.remove('hidden');
        text.textContent = isEdit ? 'Updating…' : 'Saving…';

        const body = {
            name: document.getElementById('productName').value,
            category: document.getElementById('productCategory').value,
            price: parseFloat(document.getElementById('productPrice').value),
            stock: parseInt(document.getElementById('productStock').value),
            description: document.getElementById('productDescription').value,
            image_url: document.getElementById('productImageUrl').value || null,
        };

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(body),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast(data.message || (isEdit ? 'Product updated!' : 'Product added!'));
                closeModal();
                // Reload page to reflect changes
                setTimeout(() => location.reload(), 800);
            } else {
                showToast('Error — check your input', true);
                btn.disabled = false;
                spinner.classList.add('hidden');
                text.textContent = isEdit ? 'Update Product' : 'Save Product';
            }
        })
        .catch(() => {
            showToast('Network error — try again', true);
            btn.disabled = false;
            spinner.classList.add('hidden');
            text.textContent = isEdit ? 'Update Product' : 'Save Product';
        });
    }

    // ===== DELETE PRODUCT =====
    function deleteProduct(id, btn) {
        if (!confirm('Delete this product permanently? This cannot be undone.')) return;
        btn.disabled = true;
        btn.textContent = '…';
        fetch('/vendor/products/' + id, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('Product deleted');
                const row = document.querySelector('[data-id="' + id + '"]');
                if (row) {
                    row.style.opacity = '0';
                    row.style.transition = 'opacity 0.3s';
                    setTimeout(() => row.remove(), 300);
                }
            } else {
                showToast('Error — try again', true);
                btn.disabled = false;
                btn.textContent = 'Delete';
            }
        })
        .catch(() => { showToast('Network error', true); btn.disabled = false; btn.textContent = 'Delete'; });
    }

    // ===== UPDATE ORDER STATUS =====
    function updateOrderStatus(id, status, select) {
        select.disabled = true;
        fetch('/vendor/orders/' + id + '/status', {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ status: status }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('Order status updated to ' + status);
                // Update badge
                const cell = document.getElementById('order-status-' + id);
                const badges = {
                    pending: '<span class="badge-pending">⏳ Pending</span>',
                    processing: '<span class="badge-processing">⚙ Processing</span>',
                    completed: '<span class="badge-completed">✓ Completed</span>',
                    cancelled: '<span class="badge-cancelled">✕ Cancelled</span>',
                };
                cell.innerHTML = badges[status] || status;
            } else {
                showToast('Error updating order', true);
            }
            select.disabled = false;
        })
        .catch(() => {
            showToast('Network error', true);
            select.disabled = false;
        });
    }

    // ===== CHART DATA FROM BLADE =====
    const categoryLabels = @json($categoryData->keys());
    const categoryValues = @json($categoryData->values());
    const productNames = @json($products->pluck('name'));
    const productStock = @json($products->pluck('stock'));

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
        legend.innerHTML += `<span style="display:flex;align-items:center;gap:4px;font-size:12px;color:#6b7280;">
            <span style="width:10px;height:10px;border-radius:2px;background:${ORANGE_PALETTE[i]};display:inline-block;"></span>
            ${label} ${pct}%
        </span>`;
    });

    // ===== ORDER STATUS BAR (overview page) =====
    const orderCtx = document.getElementById('orderStatusChart').getContext('2d');
    new Chart(orderCtx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
            datasets: [{
                data: [
                    {{ $pendingOrders }},
                    {{ $processingOrders }},
                    {{ $orders->where('status', 'completed')->count() }},
                    {{ $orders->where('status', 'cancelled')->count() }}
                ],
                backgroundColor: ['#f59e0b', '#3b82f6', '#16a34a', '#ef4444'],
                borderRadius: 8,
                barThickness: 48
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

    // ===== REVENUE CHART (lazy) =====
    window.revenueChartBuilt = false;
    function buildRevenueChart() {
        const canvas = document.getElementById('revenueChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        // Calculate revenue per product from order data
        const orders = @json($orders);
        const revenueMap = {};
        orders.forEach(o => {
            const key = o.product_name;
            if (!revenueMap[key]) revenueMap[key] = 0;
            revenueMap[key] += o.price * o.quantity;
        });
        const labels = Object.keys(revenueMap);
        const values = Object.values(revenueMap);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue (RM)',
                    data: values,
                    backgroundColor: '#FF7900',
                    borderRadius: 8,
                    barThickness: 48
                }]
            },
            options: {
                ...CHART_DEFAULTS,
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { font: { size: 11 }, callback: v => 'RM ' + v.toFixed(0) } },
                    x: { grid: { display: false }, ticks: { font: { size: 12 } } }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: ctx => ` RM ${ctx.parsed.y.toFixed(2)}` } }
                }
            }
        });
        window.revenueChartBuilt = true;
    }
    </script>
</body>
</html>
