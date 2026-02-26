<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased">
    <div class="h-screen flex overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-slate-900 text-slate-300 flex flex-col shadow-2xl border-r border-slate-800 z-40">

            <!-- Logo / Header -->
            <div class="h-20 flex items-center justify-center border-b border-slate-800 bg-slate-950 gap-6">
                @if($appSetting && $appSetting->logo)
                    <img src="{{ asset('storage/'.$appSetting->logo) }}"
                        class="h-10 w-auto"
                        alt="Logo">
                @else
                    <span class="font-bold">Logo</span>
                @endif
                <h1 class="text-xl font-bold">
                    {{ $appSetting->app_name ?? 'Stokify' }}
                </h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-2">

                    <li>
                        <a href="/staff/dashboard"
                           class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-800 hover:text-white group">
                            <i class="fas fa-tachometer-alt mr-3 text-slate-400 group-hover:text-indigo-400 transition"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="/staff/stocks"
                           class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-800 hover:text-white group">
                            <i class="fas fa-warehouse mr-3 text-slate-400 group-hover:text-indigo-400 transition"></i>
                            Stocks
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer Sidebar -->
            <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
                © {{ date('Y') }} Stockify
            </div>
        </aside>


        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col ml-64 w-full">

            <!-- NAVBAR -->
            <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-8 shrink-0">

                <!-- Left -->
                <div>
                    <h1 class="text-base font-semibold text-gray-700 tracking-wide">
                        Welcome back,
                        <span class="text-indigo-600">Staff</span>
                    </h1>
                </div>

                <!-- Right -->
                <div class="flex items-center space-x-4">

                    <button class="relative p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition duration-200">
                        <i class="fas fa-bell text-gray-600"></i>
                    </button>

                    <a href="#"
                        id="logoutButton"
                        class="text-sm font-medium text-gray-500 hover:text-red-500 transition duration-200">
                        Logout
                    </a>

                </div>
            </header>


            <!-- CONTENT -->
            <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
                @yield('content')
            </main>

        </div>
    </div>
    @vite('resources/js/logout.js')
</body>
</html>