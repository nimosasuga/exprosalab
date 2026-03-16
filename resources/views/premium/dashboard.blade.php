<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-zinc-900 leading-tight">
            {{ __('Executive Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-zinc-50 min-h-screen font-['Inter']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ================================================================
            SECTION 1: HEADER CARD
            ================================================================ --}}
            <div class="bg-white border border-zinc-200 p-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">

                    <div class="flex-grow">
                        <h3 class="text-2xl font-light text-zinc-900 mb-2">Fokus Strategis.</h3>
                        <p class="text-sm text-zinc-500 max-w-2xl leading-relaxed">
                            Berdasarkan hasil diagnostik yang dipilih, instrumen AI kami telah memprioritaskan
                            daftar inisiatif perbaikan operasional di bawah ini. Eksekusi metrik ini untuk
                            meningkatkan skor perusahaan Anda di kuartal berikutnya.
                        </p>

                        {{-- Dropdown (hanya muncul jika lebih dari 1 riwayat) --}}
                        @if(isset($histories) && $histories->count() > 1)
                        <div class="mt-5 flex items-center gap-3">
                            <label
                                class="text-xs font-semibold text-zinc-400 uppercase tracking-widest whitespace-nowrap">
                                Pilih Laporan:
                            </label>
                            <form action="{{ route('premium.dashboard') }}" method="GET" id="historyForm">
                                <select name="evaluation_id" onchange="document.getElementById('historyForm').submit()"
                                    class="text-sm border-zinc-200 focus:border-zinc-900 focus:ring-0 rounded-lg py-1.5 pl-3 pr-10 transition-all bg-zinc-50 font-medium cursor-pointer">
                                    @foreach($histories as $history)
                                    <option value="{{ $history->id }}" {{ isset($selectedEvaluationId) &&
                                        $selectedEvaluationId==$history->id ? 'selected' : '' }}>
                                        {{ $history->created_at->format('d M Y') }} (Skor: {{ $history->total_score }})
                                    </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        @elseif(isset($histories) && $histories->count() === 1)
                        <div
                            class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $histories->first()->created_at->format('d M Y') }} (Skor: {{
                            $histories->first()->total_score }})
                        </div>
                        @endif
                    </div>

                    {{-- Progress Bar --}}
                    <div class="w-full md:w-64 flex-shrink-0">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-semibold text-zinc-600 uppercase tracking-wider">
                                Progress Eksekusi
                            </span>
                            <span class="text-xs font-bold text-zinc-900">{{ $progress }}%</span>
                        </div>
                        <div class="w-full bg-zinc-100 h-2.5">
                            <div class="bg-zinc-900 h-2.5 transition-all duration-1000 ease-out"
                                style="width: {{ $progress }}%">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ================================================================
            SECTION 2: PERFORMANCE TREND CHART (Elemen HTML yang sempat terhapus)
            ================================================================ --}}
            @if($showChart)
            <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-zinc-900">Performance Trend</h3>
                    <p class="text-sm text-zinc-500 mt-1">
                        Pergerakan skor kesehatan bisnis Anda dari waktu ke waktu.
                    </p>
                </div>
                <div class="relative h-72 w-full">
                    <canvas id="scoreChart"></canvas>
                </div>
            </div>

            @elseif($showOneTip)
            <div class="bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-zinc-900">Performance Trend</h3>
                    <p class="text-sm text-zinc-500 mt-1">
                        Pergerakan skor kesehatan bisnis Anda dari waktu ke waktu.
                    </p>
                </div>
                <div
                    class="h-32 flex flex-col items-center justify-center bg-zinc-50 rounded-xl border border-dashed border-zinc-200">
                    <svg class="w-8 h-8 text-zinc-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <p class="text-sm text-zinc-400 font-medium text-center px-4">
                        Lakukan minimal <span class="font-bold text-zinc-600">2 kali evaluasi</span>
                        untuk melihat tren performa Anda.
                    </p>
                </div>
            </div>
            @endif

            {{-- ================================================================
            SECTION 3: ACTION PLAN TABLE (Matriks Prioritas)
            ================================================================ --}}
            <div class="space-y-6">

                {{-- KELOMPOK 1: QUICK WINS --}}
                <div class="bg-white border border-zinc-200 shadow-sm">
                    <div class="px-8 py-5 border-b border-zinc-200 bg-zinc-900 flex items-center justify-between">
                        <div>
                            <h4
                                class="text-base font-semibold text-white uppercase tracking-wide flex items-center gap-2">
                                <svg class="w-5 h-5 text-zinc-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Matriks 1: Quick Wins
                            </h4>
                            <p class="text-xs text-zinc-400 mt-1 font-light">Tindakan prioritas tinggi dengan rasio
                                Effort rendah.
                                Eksekusi minggu ini.</p>
                        </div>
                        <span class="bg-zinc-800 text-zinc-300 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $quickWins->where('status', 'completed')->count() }} / {{ $quickWins->count() }} Selesai
                        </span>
                    </div>

                    <div class="divide-y divide-zinc-200">
                        @forelse($quickWins as $task)
                        @include('premium.partials.task-row', ['task' => $task])
                        @empty
                        <div class="p-8 text-center text-sm text-zinc-500">Tidak ada Quick Wins untuk evaluasi ini.
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- KELOMPOK 2: STRATEGIC INITIATIVES --}}
                <div class="bg-white border border-zinc-200 shadow-sm mt-8">
                    <div class="px-8 py-5 border-b border-zinc-200 bg-zinc-50 flex items-center justify-between">
                        <div>
                            <h4
                                class="text-base font-semibold text-zinc-900 uppercase tracking-wide flex items-center gap-2">
                                <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                Matriks 2: Strategic Initiatives
                            </h4>
                            <p class="text-xs text-zinc-500 mt-1 font-light">Fondasi sistemik untuk kuartal ini. Dampak
                                fundamental
                                jangka panjang.</p>
                        </div>
                        <span class="bg-zinc-200 text-zinc-600 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $strategicTasks->where('status', 'completed')->count() }} / {{ $strategicTasks->count()
                            }} Selesai
                        </span>
                    </div>

                    <div class="divide-y divide-zinc-200">
                        @forelse($strategicTasks as $task)
                        @include('premium.partials.task-row', ['task' => $task])
                        @empty
                        <div class="p-8 text-center text-sm text-zinc-500">Selesaikan kuesioner evaluasi untuk
                            mendapatkan inisiatif
                            strategis.</div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- ================================================================
    CHART SCRIPT (Hanya satu blok, diletakkan paling bawah)
    ================================================================ --}}
    @if($showChart)
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var chartLabels = {!! json_encode($chartLabels) !!};
            var chartScores = {!! json_encode($chartScores) !!}.map(Number); // Perbaikan variabel

            var canvas = document.getElementById('scoreChart');
            if (!canvas || chartLabels.length === 0) return;

            new Chart(canvas.getContext('2d'), {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Total Score',
                        data: chartScores,
                        borderColor: '#3f3f46',
                        backgroundColor: 'rgba(63, 63, 70, 0.1)',
                        borderWidth: 2,
                        pointBackgroundColor: '#18181b',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#18181b',
                            titleColor: '#e4e4e7',
                            bodyColor: '#e4e4e7',
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    return 'Score: ' + context.parsed.y;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 250,
                            border: { display: false },
                            grid: {
                                color: '#f4f4f5',
                                drawTicks: false,
                            },
                            ticks: {
                                color: '#71717a',
                                padding: 10,
                                font: { family: "'Inter', sans-serif", size: 12 }
                            }
                        },
                        x: {
                            border: { display: false },
                            grid: { display: false },
                            ticks: {
                                color: '#71717a',
                                padding: 10,
                                font: { family: "'Inter', sans-serif", size: 12 }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endif
</x-app-layout>
