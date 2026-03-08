<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exprosa Lab</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: true }" class="flex h-screen">

        <!-- SIDEBAR -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-0'"
            class="bg-gray-900 text-gray-200 flex flex-col transition-all duration-300 overflow-hidden">

            <div class="h-16 flex items-center px-6 border-b border-gray-800">

                <span class="text-lg font-bold tracking-wide">
                    EXPROSA LAB
                </span>

            </div>

            <nav class="flex-1 p-4 space-y-2 text-sm">

                <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800
{{ request()->is('dashboard') ? 'bg-gray-800 text-white' : '' }}">

                    🏠 Dashboard

                </a>

                <a href="/evaluation" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800">

                    📊 Business Evaluation

                </a>

                <a href="/results" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800">

                    📈 Evaluation Results

                </a>

                <a href="/insights" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800">

                    💡 Business Insights

                </a>

                <a href="/subscription" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800">

                    💳 Subscription

                </a>

                <div class="pt-6 text-xs uppercase text-gray-500 px-4">
                    Admin
                </div>

                <a href="/admin/users" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800">

                    👥 User Management

                </a>

                <a href="/admin/questions" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800">

                    ❓ Evaluation Questions

                </a>

                <a href="/admin/analytics" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800">

                    📊 Platform Analytics

                </a>

            </nav>

        </aside>


        <!-- MAIN -->
        <div class="flex-1 flex flex-col">

            <!-- HEADER -->
            <header class="h-16 bg-white border-b flex items-center justify-between px-8">

                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-black text-xl">

                    ☰

                </button>

                <div class="text-lg font-semibold">
                    Exprosa Business Diagnostic
                </div>

                <div class="text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </div>

            </header>


            <!-- PAGE CONTENT -->
            <main class="flex-1 p-8 overflow-y-auto">

                {{ $slot }}

            </main>

        </div>

    </div>

</body>

</html>
