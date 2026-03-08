<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="flex flex-col md:flex-row justify-between items-center bg-white shadow-sm rounded-lg p-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Hasil Diagnosis Bisnis AI</h1>
                    <p class="text-gray-500 mt-1">Berdasarkan 5 Pilar Sistem Bisnis Exprosa</p>
                </div>
                <div class="mt-4 md:mt-0 text-right">
                    <h2 class="text-sm text-gray-500 uppercase tracking-wide">Total Skor</h2>
                    <p class="text-4xl font-extrabold text-indigo-600">{{ $evaluation->total_score }} <span
                            class="text-lg text-gray-400">/ 250</span></p>
                    <div class="mt-2">
                        Status:
                        <span class="px-3 py-1 rounded-full text-sm font-bold
                            @if($evaluation->business_health == 'Kritis (Critical)') bg-red-100 text-red-800
                            @elseif($evaluation->business_health == 'Rentan (Weak)') bg-yellow-100 text-yellow-800
                            @elseif($evaluation->business_health == 'Stabil (Stable)') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ $evaluation->business_health }}
                        </span>
                    </div>
                </div>
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
