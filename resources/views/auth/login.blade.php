<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Local'z</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#16171B] text-white flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white/5 backdrop-blur-lg border border-white/10 p-8 rounded-2xl shadow-xl">
        
        <!-- ✅ TOP NAV -->
        <div class="flex justify-between items-center mb-6">
            
        <!-- LEFT: Logo -->
        <a href="/" class="block">
            <h1 class="text-xl font-bold text-[#FF7900] leading-tight">
                Local'z <span class="text-white">+</span>
            </h1>
            <p class="text-[10px] text-gray-400 -mt-1">
                by theWebberz
            </p>
        </a>
            <!-- RIGHT: Home -->
            <a href="/" class="text-gray-400 hover:text-white text-sm">
                Home
            </a>

        </div>

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center text-[#FF7900] mb-6">
            Welcome Back
        </h2>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label class="text-sm text-gray-400">Email</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="w-full mt-1 p-3 rounded-lg bg-white/10 border border-white/10 focus:outline-none focus:border-[#FF7900]"
                    required>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="text-sm text-gray-400">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 p-3 rounded-lg bg-white/10 border border-white/10 focus:outline-none focus:border-[#FF7900]"
                    required>
            </div>

            <!-- ✅ Remember + Forgot -->
            <div class="flex justify-between items-center mt-4 text-sm">

                <label class="flex items-center gap-2 text-gray-400">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-gray-400 hover:text-white">
                        Forgot password?
                    </a>
                @endif

            </div>

            <!-- ✅ Register + Button -->
            <div class="flex justify-between items-center mt-6">

                <a href="{{ route('register') }}"
                   class="text-gray-400 hover:text-white text-sm">
                    Don't have an account?
                </a>

                <button type="submit"
                    class="bg-[#FF7900] hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold">
                    Log in
                </button>

            </div>

        </form>
    </div>

</body>
</html>
