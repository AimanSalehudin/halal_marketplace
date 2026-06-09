<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Overview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* CSS Pie Chart Magic */
        .pie-chart {
            background: conic-gradient(
                #FF8A00 0% 35%, 
                #FFB347 35% 60%, 
                #FFCC80 60% 80%, 
                #FFE0B2 80% 92%, 
                #FFF3E0 92% 100%
            );
            border-radius: 50%;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex h-screen overflow-hidden">

    <aside class="w-64 bg-[#141A29] text-gray-300 flex flex-col">
        <div class="p-6">
            <h1 class="text-white text-xl font-bold">Admin Portal</h1>
            <p class="text-xs text-gray-400 mt-1 mb-8">Shariah-Compliant System</p>
            
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 bg-[#FF7900] text-white px-4 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard Overview
                </a>
                <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    User Management
                </a>
                <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Compliance Audit
                </a>
                <a href="#" class="flex items-center gap-3 hover:bg-white/10 px-4 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    System Settings
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center sticky top-0 z-20">
            <div class="flex items-center gap-4">
                <h2 class="text-xl font-bold text-gray-800">Administrator Dashboard</h2>
                <span class="bg-green-50 text-green-600 border border-green-200 text-xs font-medium px-2.5 py-1 rounded-full flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    System Health: Operational
                </span>
            </div>
            
            <div class="relative">
                <button class="relative hover:text-gray-700 text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-[#FF7900] rounded-full border-2 border-white"></span>
                </button>
                
                <div class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100 z-50">
                    <div class="px-4 py-3 border-b border-gray-100 font-semibold text-sm">New Notifications</div>
                    <div class="p-2 space-y-1">
                        <div class="bg-orange-50/50 p-3 rounded-lg text-sm cursor-pointer">
                            <p class="text-gray-800 font-medium">New Halal certificate submission from Al-Barakah Food...</p>
                            <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                        </div>
                        <div class="hover:bg-gray-50 p-3 rounded-lg text-sm cursor-pointer">
                            <p class="text-gray-800 font-medium">Content reported by user #4521</p>
                            <p class="text-xs text-gray-400 mt-1">15 minutes ago</p>
                        </div>
                        <div class="bg-orange-50/50 p-3 rounded-lg text-sm cursor-pointer">
                            <p class="text-gray-800 font-medium">Vendor verification pending review</p>
                            <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm relative">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-orange-50 p-3 rounded-xl text-[#FF7900]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Total Users</p>
                        <p class="text-4xl font-bold text-gray-800">2,847</p>
                        <p class="text-sm text-green-500 font-medium mt-2">+12% from last month</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm relative">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-orange-50 p-3 rounded-xl text-[#FF7900]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Pending Halal Verifications</p>
                        <p class="text-4xl font-bold text-gray-800">23</p>
                        <p class="text-sm text-gray-500 font-medium mt-2">5 new today</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                    <h3 class="font-bold text-gray-800 mb-6">User Growth Trend</h3>
                    <div class="relative h-48 w-full border-l border-b border-gray-200">
                        <div class="absolute -left-10 top-0 text-xs text-gray-400">1000</div>
                        <div class="absolute -left-8 top-1/4 text-xs text-gray-400">750</div>
                        <div class="absolute -left-8 top-2/4 text-xs text-gray-400">500</div>
                        <div class="absolute -left-8 top-3/4 text-xs text-gray-400">250</div>
                        <div class="absolute -left-4 bottom-0 text-xs text-gray-400">0</div>
                        
                        <div class="absolute w-full top-1/4 border-b border-dashed border-gray-200"></div>
                        <div class="absolute w-full top-2/4 border-b border-dashed border-gray-200"></div>
                        <div class="absolute w-full top-3/4 border-b border-dashed border-gray-200"></div>
                        
                        <svg class="absolute inset-0 h-full w-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                            <polyline fill="none" stroke="#4ADE80" stroke-width="1.5" points="0,80 25,65 50,55 75,35 100,20" />
                            <circle cx="0" cy="80" r="1.5" fill="white" stroke="#4ADE80" stroke-width="1"/>
                            <circle cx="25" cy="65" r="1.5" fill="white" stroke="#4ADE80" stroke-width="1"/>
                            <circle cx="50" cy="55" r="1.5" fill="white" stroke="#4ADE80" stroke-width="1"/>
                            <circle cx="75" cy="35" r="1.5" fill="white" stroke="#4ADE80" stroke-width="1"/>
                            <circle cx="100" cy="20" r="1.5" fill="white" stroke="#4ADE80" stroke-width="1"/>
                        </svg>

                        <div class="absolute -bottom-6 left-0 text-xs text-gray-400">Jan</div>
                        <div class="absolute -bottom-6 left-1/4 text-xs text-gray-400">Feb</div>
                        <div class="absolute -bottom-6 left-2/4 text-xs text-gray-400">Mar</div>
                        <div class="absolute -bottom-6 left-3/4 text-xs text-gray-400">Apr</div>
                        <div class="absolute -bottom-6 right-0 text-xs text-gray-400">May</div>
                    </div>
                    
                    <div class="flex justify-center items-center gap-6 mt-8">
                        <div class="flex items-center gap-2 text-xs text-gray-500"><span class="w-2 h-2 rounded-full bg-[#FF7900]"></span> Buyers</div>
                        <div class="flex items-center gap-2 text-xs text-gray-500"><span class="w-2 h-2 rounded-full bg-green-400 border border-green-500"></span> Vendors</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col">
                    <h3 class="font-bold text-gray-800 mb-6">Marketplace Category Distribution</h3>
                    <div class="flex-1 flex justify-center items-center relative">
                        <div class="w-48 h-48 pie-chart relative border border-white">
                            <div class="absolute inset-0 bg-transparent" style="background-image: conic-gradient(transparent 99%, white 100%);"></div>
                        </div>
                        
                        <span class="absolute top-4 right-12 text-[#FF7900] font-semibold text-sm">Halal Meat 35%</span>
                        <span class="absolute left-8 top-1/2 text-[#FFB347] font-semibold text-sm">Products 25%</span>
                        <span class="absolute bottom-8 left-16 text-[#FFCC80] font-semibold text-sm">Snacks 20%</span>
                        <span class="absolute bottom-8 right-16 text-[#FFE0B2] font-semibold text-sm">Beverages 12%</span>
                        <span class="absolute right-8 top-1/2 text-gray-400 font-semibold text-sm">Other 8%</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-6">Halal Certification Verification Status</h3>
                <div class="relative h-40 w-full border-l border-b border-gray-200 flex items-end justify-around pb-0">
                    
                    <div class="absolute -left-6 top-0 text-xs text-gray-400">24</div>
                    <div class="absolute -left-6 top-1/4 text-xs text-gray-400">18</div>
                    <div class="absolute -left-6 top-2/4 text-xs text-gray-400">12</div>
                    <div class="absolute -left-4 top-3/4 text-xs text-gray-400">6</div>
                    
                    <div class="absolute w-full top-1/4 border-b border-dashed border-gray-200"></div>
                    <div class="absolute w-full top-2/4 border-b border-dashed border-gray-200"></div>
                    <div class="absolute w-full top-3/4 border-b border-dashed border-gray-200"></div>

                    <div class="w-12 bg-red-500 h-[30%] z-10 mx-2"></div>
                    <div class="w-12 bg-red-500 h-[45%] z-10 mx-2"></div>
                    <div class="w-12 bg-red-500 h-[60%] z-10 mx-2"></div>
                    <div class="w-12 bg-red-500 h-[90%] z-10 mx-2"></div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>