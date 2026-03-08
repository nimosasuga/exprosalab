<x-app-layout>

    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Selamat datang, {{ Auth::user()->name }} 👋</h1>
            <p class="text-slate-500 mt-1">Berikut adalah ringkasan kesehatan bisnis Anda saat ini.</p>
        </div>

        <a href="{{ route('profile.edit') }}"
            class="group inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 rounded-xl shadow-sm text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-indigo-300 hover:text-indigo-600 transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg class="w-5 h-5 mr-2 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                </path>
            </svg>
            Pengaturan Profil
        </a>
    </div>

    @if(!$hasEvaluated)
    <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-8 text-center shadow-sm">
        <h2 class="text-xl font-bold text-indigo-900 mb-2">Anda Belum Melakukan Evaluasi Bisnis</h2>
        <p class="text-indigo-700 mb-6">Mulai diagnosa AI sekarang untuk menemukan letak kebocoran dan potensi
            pertumbuhan bisnis Anda.</p>
        <form action="{{ route('evaluation.init') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition duration-300">
                Mulai Evaluasi Sekarang
            </button>
        </form>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="text-sm font-medium text-slate-500">Business Health Score</div>
                <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <div class="text-4xl font-extrabold text-slate-900">{{ $healthPercentage }}%</div>
            </div>
            <div class="mt-4 w-full bg-slate-100 rounded-full h-1.5">
                <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $healthPercentage }}%"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="text-sm font-medium text-slate-500">Status Diagnosa</div>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            @php
            $statusColor = 'bg-green-100 text-green-700'; // Default (Strong)
            if ($healthStatus == 'Kritis (Critical)') {
            $statusColor = 'bg-red-100 text-red-700';
            } elseif ($healthStatus == 'Rentan (Weak)') {
            $statusColor = 'bg-yellow-100 text-yellow-700';
            } elseif ($healthStatus == 'Stabil (Stable)') {
            $statusColor = 'bg-blue-100 text-blue-700';
            }
            @endphp

            <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                {{ $healthStatus }}
            </div>
            <p class="text-sm text-slate-500 mt-3">Hasil kalkulasi AI dari 5 pilar sistem bisnis.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="text-sm font-medium text-slate-500">Sistem Terlemah</div>
                <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-800 mt-1 uppercase">
                {{ $weakest }}
            </div>
            <a href="{{ route('insights.index') }}"
                class="text-sm text-indigo-600 font-medium hover:text-indigo-800 mt-4 inline-flex items-center gap-1">
                Lihat Solusi <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-semibold text-slate-800">Business System Radar</h3>
            </div>
            <div class="flex-1 w-full flex items-center justify-center">
                <canvas id="dashboardRadarChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-semibold text-slate-800">Prioritas Perbaikan AI</h3>
                <span class="bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Urgent</span>
            </div>

            <div class="space-y-4">
                <div class="bg-red-50 p-4 rounded-xl border border-red-100">
                    <h4 class="text-sm font-bold text-red-800 mb-1">Masalah Utama ({{ ucfirst($weakest) }})</h4>
                    <p class="text-sm text-red-600">{{ $problem }}</p>
                </div>

                <div class="bg-indigo-50 p-4 rounded-xl border border-indigo-100">
                    <h4 class="text-sm font-bold text-indigo-800 mb-1">Tindakan Disarankan</h4>
                    <p class="text-sm text-indigo-600">{{ $recommendation }}</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('dashboardRadarChart');
                new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: ['Market', 'Visibility', 'Conversion', 'Monetization', 'System'],
                        datasets: [{
                            label: 'Skor Pilar',
                            data: [
                                {{ $scores['market'] ?? 0 }},
                                {{ $scores['visibility'] ?? 0 }},
                                {{ $scores['conversion'] ?? 0 }},
                                {{ $scores['monetization'] ?? 0 }},
                                {{ $scores['system'] ?? 0 }}
                            ],
                            fill: true,
                            backgroundColor: 'rgba(79, 70, 229, 0.2)',
                            borderColor: 'rgb(79, 70, 229)',
                            pointBackgroundColor: 'rgb(79, 70, 229)',
                            pointBorderColor: '#fff',
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: { r: { min: 0, max: 50, ticks: { stepSize: 10 } } },
                        plugins: { legend: { display: false } }
                    }
                });
            });
    </script>
    @endif

</x-app-layout>
