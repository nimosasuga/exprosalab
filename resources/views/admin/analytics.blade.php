<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Ringkasan Performa Exprosa Lab</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Pantau pertumbuhan pengguna dan hasil evaluasi
                    bisnis secara real-time.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Pengguna</div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">{{ $totalUsers }}</div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Pengguna Premium</div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">{{ $premiumUsers }}</div>
                    <div class="text-xs text-green-500 mt-1">{{ $premiumRatio }}% dari total pengguna</div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-gray-400">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Pengguna Gratis</div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">{{ $freeUsers }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $freeRatio }}% dari total pengguna</div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-emerald-500">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Rata-rata Skor Evaluasi
                    </div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">{{
                        number_format($averageScore, 1) }}</div>
                    <div class="text-xs text-gray-500 mt-1">Dari {{ $totalEvaluations }} evaluasi selesai</div>
                </div>

            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-4">Wawasan Singkat</h4>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Saat ini, <span class="font-bold text-yellow-600">{{ $premiumRatio }}%</span> pengguna Anda
                    berlangganan Premium.
                    Rata-rata bisnis yang dievaluasi mendapatkan skor <span class="font-bold text-emerald-600">{{
                        number_format($averageScore, 1) }}</span>.
                    Ini adalah indikator yang bagus untuk melihat apakah bisnis pengguna berkembang setelah menggunakan
                    *Insight* dari Exprosa Lab.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
