<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Stockify</title>

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200 flex items-center justify-center px-4">

<div class="w-full max-w-md">

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-10">

        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-indigo-600 flex items-center justify-center shadow-md">
                <span class="text-white text-2xl font-bold">S</span>
            </div>

            <h1 class="text-2xl font-bold text-gray-800">Buat Akun</h1>
            <p class="text-gray-500 text-sm mt-1">
                Daftar untuk mulai menggunakan Stockify
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama
                </label>
                <input type="text" name="name"
                    placeholder="Username"
                    class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 p-3 rounded-xl transition"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <input type="email" name="email"
                    placeholder="Email"
                    class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 p-3 rounded-xl transition"
                    required>
            </div>

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>

                <input 
                    type="password"
                    name="password"
                    id="password"
                    placeholder="••••••••"
                    class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 p-3 pr-12 rounded-xl transition"
                    required>

                <button 
                    type="button"
                    onclick="togglePassword('password', this)"
                    class="absolute right-3 top-[42px] text-gray-400 hover:text-indigo-600 transition">
                    
                    <!-- Eye Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-5 h-5 eye-open" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor" 
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12s-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>

                    <!-- Eye Slash Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-5 h-5 eye-closed hidden" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor" 
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3l18 18M10.584 10.587A2.25 2.25 0 0012 14.25
                            a2.25 2.25 0 002.25-2.25c0-.492-.158-.948-.426-1.32
                            M6.75 6.75C4.5 8.25 3 12 3 12s3.75 7.5 9.75 7.5
                            c1.757 0 3.348-.438 4.728-1.107" />
                    </svg>
                </button>
            </div>

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password
                </label>

                <input 
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="••••••••"
                    class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 p-3 pr-12 rounded-xl transition"
                    required>

                <button 
                    type="button"
                    onclick="togglePassword('password_confirmation', this)"
                    class="absolute right-3 top-[42px] text-gray-400 hover:text-indigo-600 transition">
                    
                    <!-- Eye Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-5 h-5 eye-open" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor" 
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12s-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>

                    <!-- Eye Slash Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-5 h-5 eye-closed hidden" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor" 
                        stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3l18 18M10.584 10.587A2.25 2.25 0 0012 14.25
                            a2.25 2.25 0 002.25-2.25c0-.492-.158-.948-.426-1.32
                            M6.75 6.75C4.5 8.25 3 12 3 12s3.75 7.5 9.75 7.5
                            c1.757 0 3.348-.438 4.728-1.107" />
                    </svg>
                </button>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold shadow-sm transition duration-200">
                Register
            </button>

            <p class="text-center text-sm text-gray-500 mt-4">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">
                    Login di sini
                </a>
            </p>

        </form>

        <script>
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const eyeOpen = btn.querySelector('.eye-open');
            const eyeClosed = btn.querySelector('.eye-closed');

            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClosed.classList.remove("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClosed.classList.add("hidden");
            }
        }
        </script>
    </div>

    <p class="text-center text-xs text-gray-400 mt-6">
        © {{ date('Y') }} Stockify. All rights reserved.
    </p>

</div>
</body>
</html>