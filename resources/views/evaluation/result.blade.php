<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-2 text-sm text-indigo-600 font-bold">
                        <a href="{{ route('evaluation.index') }}" class="hover:underline flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Hub
                        </a>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-900">Laporan Hasil Evaluasi</h1>

                    <div
                        class="mt-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Tanggal Evaluasi: {{ $evaluation->created_at->format('d M Y - H:i') }}
                    </div>
                </div>

                @if(isset($histories) && $histories->count() > 1)
                <div class="bg-white p-3 rounded-xl border border-slate-200 shadow-sm min-w-[260px]">
                    <label for="history_selector"
                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Lihat
                        Riwayat Lainnya</label>
                    <select id="history_selector" onchange="window.location.href=this.value"
                        class="block w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-slate-50 cursor-pointer">
                        @foreach($histories as $history)
                        <option value="{{ route('evaluation.result', $history->id) }}" {{ $evaluation->id ===
                            $history->id ?
                            'selected' : '' }}>
                            {{ $history->created_at->format('d M Y') }} (Skor: {{ $history->total_score }}%)
                        </option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                @foreach (['Market' => 'market', 'Visibility' => 'visibility', 'Conversion' => 'conversion',
                'Monetization' => 'monetization', 'System' => 'system'] as $label => $key)
                <div
                    class="bg-white p-6 rounded-lg shadow-sm text-center border-b-4 border-indigo-500 hover:shadow-md transition">
                    <span class="text-gray-500 text-sm font-medium uppercase tracking-wide">{{ $label }}</span>
                    <h2 class="text-3xl font-bold text-gray-800 mt-2">{{ $scores[$key] }}</h2>
                    <p class="text-xs text-gray-400 mt-1">Maks: 50</p>
                </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col items-center justify-center">
                    <h3 class="text-lg font-bold text-gray-800 w-full mb-4">Peta Kekuatan Bisnis</h3>
                    <div class="w-full max-w-md">
                        <canvas id="businessChart"></canvas>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6 border-l-4 border-indigo-500">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Rekomendasi Strategis AI
                    </h3>

                    <ul class="space-y-4">
                        @foreach($diagnosis as $item)
                        <li class="flex items-start bg-indigo-50 p-4 rounded-lg">
                            <span class="text-indigo-600 mr-3 mt-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="text-gray-700 leading-relaxed">{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('businessChart');

        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Market', 'Visibility', 'Conversion', 'Monetization', 'System'],
                datasets: [{
                    label: 'Skor Anda',
                    data: [
                        {{ $scores['market'] }},
                        {{ $scores['visibility'] }},
                        {{ $scores['conversion'] }},
                        {{ $scores['monetization'] }},
                        {{ $scores['system'] }}
                    ],
                    fill: true,
                    backgroundColor: 'rgba(79, 70, 229, 0.2)', // Indigo 600 dengan opacity
                    borderColor: 'rgb(79, 70, 229)',
                    pointBackgroundColor: 'rgb(79, 70, 229)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(79, 70, 229)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        angleLines: { display: true },
                        suggestedMin: 0,
                        suggestedMax: 50,
                        ticks: { stepSize: 10 }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</x-app-layout>
