<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#16171B] text-white min-h-screen p-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-[#FF7900] mb-8">My Profile</h1>
        
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
            <div class="flex items-center gap-6 mb-8">
                <div class="w-20 h-20 bg-[#FF7900] rounded-full flex items-center justify-center text-3xl font-bold">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-400">University Student</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="text-xs text-gray-500 uppercase">Email Address</label>
                    <p class="text-lg">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Phone Number</label>
                    <p class="text-lg">{{ $user->phone }}</p>
                </div>
                <div>
                    <label class="text-xs text-gray-500 uppercase">Saved Address</label>
                    <p class="text-lg">{{ $user->address }}</p>
                </div>
            </div>

            <div class="mt-10 flex gap-4">
                <button class="bg-[#FF7900] px-6 py-2 rounded-lg font-bold">Edit Profile</button>
                <button class="border border-white/20 px-6 py-2 rounded-lg font-bold hover:bg-white/10">Settings</button>
            </div>
        </div>
        <a href="/" class="block mt-8 text-center text-gray-400 hover:text-white">← Back to Dashboard</a>
    </div>
    <h2 class="text-xl font-bold mt-10 mb-4">Order History</h2>
<div class="bg-white/5 border border-white/10 rounded-2xl p-6">
    @forelse($orders as $order)
    <div class="flex justify-between border-b border-white/10 py-3">
        <span>{{ $order->product_name }}</span>
        <span class="text-[#FF7900]">RM {{ $order->price }}</span>
        <span class="text-gray-400 text-sm">{{ $order->ordered_at }}</span>
    </div>
@empty
    <p class="text-gray-400">No orders yet.</p>
@endforelse
</div>
<div class="mt-12 pt-8 border-t border-white/10">
    <h3 class="text-xs text-gray-500 uppercase tracking-widest mb-4">Development Shortcuts</h3>
    <div class="flex gap-4">
        <a href="/vendor/dashboard" class="text-sm bg-white/5 border border-white/10 px-4 py-2 rounded-lg hover:border-[#FF7900] transition">
            Switch to Vendor Dashboard
        </a>
        <a href="/admin/dashboard" class="text-sm bg-white/5 border border-white/10 px-4 py-2 rounded-lg hover:border-[#FF7900] transition">
            Switch to Admin Dashboard
        </a>
    </div>
</div>
</body>
</html>