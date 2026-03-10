<x-app-layout>

    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="flex h-3 w-3 relative">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                </span>
                <span class="text-xs font-bold tracking-widest text-indigo-600 uppercase">AI Engine Active</span>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Executive Dashboard</h1>
            <p class="text-slate-500 mt-1 font-medium">Selamat datang, {{ Auth::user()->name }}. Berikut adalah
                ringkasan diagnostik bisnis Anda.</p>
        </div>
        @if($hasEvaluated)
        <div class="text-right hidden md:block">
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Tingkat Akurasi AI</p>
            <div
                class="text-sm font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full inline-flex items-center gap-1 border border-emerald-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tinggi (Berdasarkan 50 Titik Data)
            </div>
        </div>
        @endif
    </div>

    @if(!$hasEvaluated)
    <div
        class="relative bg-gradient-to-br from-slate-900 to-indigo-900 rounded-3xl p-10 text-center shadow-2xl overflow-hidden border border-slate-700">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-indigo-500 opacity-20 rounded-full blur-2xl">
        </div>

        <div class="relative z-10 max-w-2xl mx-auto">
            <div
                class="mx-auto w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-sm border border-white/20">
                <svg class="w-8 h-8 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                    </path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-4">Evaluasi Bisnis Anda Belum Dimulai</h2>
            <p class="text-indigo-200 mb-8 text-lg">Buka wawasan eksklusif tentang kinerja bisnis Anda. Algoritma kami
                akan membedah 5 pilar utama dan memberikan Anda cetak biru pertumbuhan bisnis.</p>
            <form action="{{ route('evaluation.init') }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-white text-indigo-900 hover:bg-indigo-50 font-bold py-4 px-10 rounded-xl shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] transition-all duration-300 transform hover:-translate-y-1">
                    Mulai Diagnosa Komprehensif
                </button>
            </form>
        </div>
    </div>
    @else

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div
            class="bg-gradient-to-br from-slate-900 to-slate-800 p-6 rounded-3xl shadow-xl border border-slate-700 relative overflow-hidden group">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 opacity-10 rounded-full blur-2xl group-hover:opacity-20 transition-opacity">
            </div>
            <div class="flex justify-between items-start mb-6 relative z-10">
                <div class="text-xs font-bold tracking-widest text-slate-400 uppercase">Business Health Score</div>
                <div class="p-2 bg-slate-800 rounded-lg text-indigo-400 border border-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-end gap-2 relative z-10">
                <div class="text-5xl font-black text-white tracking-tighter">{{ $healthPercentage }}<span
                        class="text-3xl text-slate-400">%</span></div>
            </div>
            <div class="mt-6 w-full bg-slate-700 rounded-full h-2 relative z-10 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full shadow-[0_0_10px_rgba(99,102,241,0.5)]"
                    style="width: {{ $healthPercentage }}%"></div>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 hover:border-indigo-200 hover:shadow-md transition-all">
            <div class="flex justify-between items-start mb-6">
                <div class="text-xs font-bold tracking-widest text-slate-400 uppercase">Status Diagnosa AI</div>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            @php
            $statusConfig = [
            'bg' => 'bg-green-50', 'text' => 'text-green-700', 'border' => 'border-green-200', 'dot' => 'bg-green-500'
            ];
            if ($healthStatus == 'Kritis (Critical)') {
            $statusConfig = ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'border' => 'border-red-200', 'dot' =>
            'bg-red-500'];
            } elseif ($healthStatus == 'Rentan (Weak)') {
            $statusConfig = ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'dot' =>
            'bg-amber-500'];
            } elseif ($healthStatus == 'Stabil (Stable)') {
            $statusConfig = ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'dot' =>
            'bg-blue-500'];
            }
            @endphp

            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl {{ $statusConfig['bg'] }} {{ $statusConfig['border'] }} border">
                <span class="w-2 h-2 rounded-full {{ $statusConfig['dot'] }} animate-pulse"></span>
                <span class="text-lg font-bold {{ $statusConfig['text'] }}">{{ $healthStatus }}</span>
            </div>
            <p class="text-sm text-slate-500 mt-4 font-medium leading-relaxed">Sistem merekomendasikan intervensi pada
                area dengan skor di bawah standar industri.</p>
        </div>

<div
    class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 hover:border-indigo-200 hover:shadow-md transition-all flex flex-col justify-between">
    <div>
        <div class="flex justify-between items-start mb-2">
            <div class="text-xs font-bold tracking-widest text-slate-400 uppercase">Critical Bottleneck</div>
            <div class="p-2 bg-rose-50 rounded-lg text-rose-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-black text-slate-800 uppercase tracking-tight">
            {{ $weakest }}
        </div>
    </div>

    <div class="mt-4 pt-4 border-t border-slate-100">
        @php
        $hasAccess = auth()->user()->role === 'admin' || auth()->user()->isPremium();
        @endphp
        <a href="{{ $hasAccess ? route('insights.index') : route('subscription.index') }}"
            class="group flex items-center justify-between text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">

            <span>View Solution Blueprint</span>

            <span class="bg-indigo-50 p-1 rounded-md group-hover:bg-indigo-100 transition-colors">
                @if($hasAccess)
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
                @else
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                @endif
            </span>
        </a>
    </div>
</div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        <div
            class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-slate-200 flex flex-col items-center justify-center">
            <h3 class="text-sm font-bold tracking-widest text-slate-400 uppercase w-full text-center mb-4">Pemetaan
                Sistem Bisnis</h3>
            <div class="w-full max-w-[300px] aspect-square relative">
                <canvas id="dashboardRadarChart"></canvas>
            </div>
        </div>

        <div class="lg:col-span-3 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="bg-slate-50 border-b border-slate-100 p-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white rounded-lg shadow-sm border border-slate-200">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg">Laporan Prioritas AI</h3>
                </div>
                <span
                    class="bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Tindakan Mendesak
                </span>
            </div>

            <div class="p-6 flex-1 flex flex-col justify-center space-y-6">
                <div class="relative pl-6 border-l-2 border-rose-400">
                    <div
                        class="absolute -left-[9px] top-0 bg-rose-400 text-white w-4 h-4 rounded-full flex items-center justify-center border-4 border-white shadow-sm">
                    </div>
                    <h4 class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-2">Identifikasi Masalah ({{
                        ucfirst($weakest) }})</h4>
                    <p class="text-slate-800 font-medium text-lg leading-relaxed">{{ $problem }}</p>
                </div>

                <div class="relative pl-6 border-l-2 border-indigo-400">
                    <div
                        class="absolute -left-[9px] top-0 bg-indigo-400 text-white w-4 h-4 rounded-full flex items-center justify-center border-4 border-white shadow-sm">
                    </div>
                    <h4 class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-2">Rekomendasi Strategis
                    </h4>
                    <p class="text-indigo-900 font-medium text-lg leading-relaxed">{{ $recommendation }}</p>
                </div>
            </div>

            <div class="bg-slate-50 p-4 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500 font-medium flex items-center justify-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Untuk rencana aksi 3-langkah yang mendetail, silakan buka menu Business Insights.
                </p>
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
                        backgroundColor: 'rgba(99, 102, 241, 0.15)', // Light Indigo
                        borderColor: 'rgb(79, 70, 229)', // Indigo 600
                        pointBackgroundColor: 'rgb(79, 70, 229)',
                        pointBorderColor: '#ffffff',
                        pointHoverBackgroundColor: '#ffffff',
                        pointHoverBorderColor: 'rgb(79, 70, 229)',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            min: 0,
                            max: 50,
                            ticks: {
                                stepSize: 10,
                                display: false // Menyembunyikan angka di tengah agar lebih bersih
                            },
                            grid: { color: 'rgba(148, 163, 184, 0.2)' }, // Warna jaring laba-laba
                            angleLines: { color: 'rgba(148, 163, 184, 0.2)' },
                            pointLabels: {
                                font: { size: 11, weight: 'bold', family: "'Inter', sans-serif" },
                                color: '#64748b' // Slate 500
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)', // Slate 900
                            titleFont: { size: 13, family: "'Inter', sans-serif" },
                            bodyFont: { size: 14, weight: 'bold', family: "'Inter', sans-serif" },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false
                        }
                    }
                }
            });
        });
    </script>
    @endif

</x-app-layout>
