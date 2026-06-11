
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Local'z</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#16171B] text-white flex items-center justify-center min-h-screen">

    <!-- ✅ CARD -->
    <div class="w-full max-w-md bg-white/5 backdrop-blur-lg border border-white/10 p-8 rounded-2xl shadow-xl">

        <!-- ✅ TOP NAV -->
        <div class="flex justify-between items-start mb-6">

            <!-- LEFT: LOGO -->
            <a href="/">
                <h1 class="text-xl font-bold text-[#FF7900] leading-tight">
                    Local'z <span class="text-white">+</span>
                </h1>
                <p class="text-[10px] text-gray-400 -mt-1">
                    by theWebberz
                </p>
            </a>

            <!-- RIGHT: HOME -->
            <a href="/" class="text-gray-400 hover:text-white text-sm">
                Home
            </a>

        </div>

        <!-- ✅ TITLE -->
        <h2 class="text-2xl font-bold text-center text-[#FF7900] mb-6">
            Create Account
        </h2>

        <!-- ✅ FORM -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label class="text-sm text-gray-400">Name</label>
                <input type="text" name="name"
                    value="{{ old('name') }}"
                    class="w-full mt-1 p-3 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:border-[#FF7900]"
                    required>
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label class="text-sm text-gray-400">Email</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="w-full mt-1 p-3 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:border-[#FF7900]"
                    required>
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <label class="text-sm text-gray-400">Phone Number</label>
                <input type="text" name="phone"
                    value="{{ old('phone') }}"
                    class="w-full mt-1 p-3 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:border-[#FF7900]"
                    required>
            </div>

            <!-- Address -->
            <div class="mt-4">
                <label class="text-sm text-gray-400">Address</label>
                <input type="text" name="address"
                    value="{{ old('address') }}"
                    class="w-full mt-1 p-3 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:border-[#FF7900]"
                    required>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="text-sm text-gray-400">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 p-3 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:border-[#FF7900]"
                    required>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label class="text-sm text-gray-400">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full mt-1 p-3 rounded-lg bg-white/5 border border-white/10 focus:outline-none focus:border-[#FF7900]"
                    required>
            </div>

            <!-- ✅ LOGIN LINK + BUTTON -->
            <div class="flex justify-between items-center mt-6">

                <a href="{{ route('login') }}"
                   class="text-gray-400 hover:text-white text-sm">
                    Already registered?
                </a>

                <button type="submit"
                    class="bg-[#FF7900] hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold">
                    Register
                </button>

            </div>

        </form>
    </div>

</body>
</html>
