<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Stockify</title>

    @vite([
        'resources/css/app.css'
    ])
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200 flex items-center justify-center px-4">

<div class="w-full max-w-md">

    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-10">

        {{-- BRAND --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-indigo-600 flex items-center justify-center shadow-md">
                <span class="text-white text-2xl font-bold">S</span>
            </div>

            <h1 class="text-2xl font-bold text-gray-800">Stockify</h1>
            <p class="text-gray-500 text-sm mt-1">
                Sistem Manajemen Stok Modern
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-red-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 
                        0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 
                        0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                </svg>

                <span class="text-sm text-red-600 font-medium">
                    {{ $errors->first() }}
                </span>
            </div>
        @endif

        {{-- FORM --}}
        <form class="space-y-5" method="POST" action="/login">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <input 
                    type="email" 
                    name="email"
                    id="email"
                    class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 p-3 rounded-xl transition"
                    placeholder="Email"
                    required>
            </div>

            {{-- PASSWORD --}}
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>

                <input 
                    type="password" 
                    name="password"
                    id="password"
                    class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 p-3 pr-12 rounded-xl transition"
                    placeholder="••••••••"
                    required>

                <button 
                    type="button"
                    onclick="togglePassword('password', this)"
                    class="absolute right-3 top-[42px] text-gray-400 hover:text-indigo-600 transition">

                    <!-- Eye (show) -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 eye-open"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1 1 0 010-.644C3.423 7.51 
                            7.36 4.5 12 4.5c4.638 0 8.575 3.01 
                            9.964 7.178a1 1 0 010 .644C20.577 
                            16.49 16.64 19.5 12 19.5c-4.638 
                            0-8.575-3.01-9.964-7.178z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>

                    <!-- Eye Slash (hide) -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 eye-closed hidden"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3l18 18" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.58 10.58A3 3 0 0112 9a3 3 0 013 3 
                            2.99 2.99 0 01-.58 1.42M6.53 
                            6.53A9.94 9.94 0 002.04 12c1.39 
                            4.17 5.33 7.5 9.96 7.5 1.82 
                            0 3.53-.45 5.03-1.24" />
                    </svg>

                </button>
            </div>

            {{-- ERROR --}}
            <p id="errorMsg" class="text-red-500 text-sm text-center hidden"></p>

                    {{-- BUTTON --}}
        <button 
            type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold shadow-sm transition duration-200">
            Login
        </button>

        {{-- DIVIDER --}}
        <div class="flex items-center my-4">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="px-3 text-xs text-gray-400">atau</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        {{-- REGISTER --}}
        <a 
            href="/register"
            class="block w-full text-center border border-indigo-600 text-indigo-600 hover:bg-indigo-50 py-3 rounded-xl font-semibold transition duration-200">
            Buat Akun Baru
        </a>

        </form>
        

    </div>

    {{-- FOOTER --}}
    <p class="text-center text-xs text-gray-400 mt-6">
        © {{ date('Y') }} Stockify. All rights reserved.
    </p>

</div>
<script>
    const ADMIN_DASHBOARD_URL = "{{ route('admin.dashboard') }}";
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
</body>
</html>