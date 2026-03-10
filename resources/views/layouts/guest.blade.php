<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Exprosa Lab') }} - Portal Klien</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-['Inter'] text-zinc-900 antialiased bg-zinc-50 selection:bg-zinc-900 selection:text-white flex flex-col min-h-screen">

    <header class="w-full bg-white border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-zinc-900 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="font-semibold text-lg tracking-tight text-zinc-900">Exprosa Lab.</span>
                </a>
                <a href="/" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition">Kembali ke
                    Beranda</a>
            </div>
        </div>
    </header>

    <div class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white border border-zinc-200 p-8 sm:p-10 shadow-sm">
            {{ $slot }}
        </div>
    </div>

    <footer class="py-8 text-center border-t border-zinc-200">
        <p class="text-xs text-zinc-400 font-light">&copy; {{ date('Y') }} Exprosa Lab Business Advisory. Seluruh hak
            cipta dilindungi.</p>
    </footer>

</body>

</html>
