<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exprosa Lab - Business Diagnostic</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

    <div x-data="{ sidebarOpen: window.innerWidth >= 1024 }"
        @resize.window="if(window.innerWidth >= 1024) { sidebarOpen = true } else { sidebarOpen = false }"
        class="flex h-screen overflow-hidden">

        <x-sidebar />
        <div class="flex-1 flex flex-col min-w-0 bg-slate-50 relative">

            <header
                class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-8 shadow-sm z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="text-slate-500 hover:text-indigo-600 focus:outline-none transition-colors p-1 rounded-md hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h2 class="text-lg font-semibold text-slate-800 hidden sm:block">
                        Exprosa Business Diagnostic
                    </h2>
                </div>

                <div class="flex items-center gap-4 relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false"
                        class="flex items-center gap-2 cursor-pointer hover:bg-slate-50 p-2 rounded-lg transition-colors focus:outline-none">
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-slate-700 hidden sm:block">
                            {{ Auth::user()->name ?? 'User' }}
                        </span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200"
                            :class="dropdownOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 top-full mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 focus:outline-none z-50"
                        style="display: none;">

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                            ⚙️ Edit Profil & Bisnis
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                🚪 Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6 lg:p-8 overflow-y-auto">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>
</body>

</html>
