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
                                        $selectedEvaluationId==$history->id ? 'selected' :
                                        '' }}>
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
            CHART SCRIPT
            ================================================================ --}}
            @if($showChart)
            <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
            // Kita gunakan json_encode PHP native agar tidak memicu ParseError di Blade
            var chartLabels = {!! json_encode($chartLabels) !!};
            var chartScores = {!! json_encode($chartScores) !!}.map(Number);

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

            {{-- ================================================================
            SECTION 3: ACTION PLAN TABLE
            ================================================================ --}}
            <div class="bg-white border border-zinc-200">
                <div class="px-8 py-6 border-b border-zinc-200 bg-zinc-50/50">
                    <h4 class="text-base font-semibold text-zinc-900 uppercase tracking-wide">
                        Rekomendasi Tindakan (Action Plan)
                    </h4>
                </div>

                <div class="divide-y divide-zinc-200">
                    @forelse($actionPlans as $task)
                    <div
                        class="p-8 flex flex-col sm:flex-row gap-6 items-start hover:bg-zinc-50/50 transition-colors {{ $task->status === 'completed' ? 'opacity-60' : '' }}">

                        {{-- Toggle Checklist Button --}}
                        <form method="POST" action="{{ route('premium.action-plan.update', $task->id) }}" class="mt-1">
                            @csrf
                            @method('PATCH')
                            @if(isset($selectedEvaluationId))
                            <input type="hidden" name="evaluation_id" value="{{ $selectedEvaluationId }}">
                            @endif
                            <button type="submit"
                                class="flex-shrink-0 w-6 h-6 border-2 flex items-center justify-center transition-colors focus:outline-none {{ $task->status === 'completed' ? 'border-zinc-900 bg-zinc-900' : 'border-zinc-300 hover:border-zinc-500' }}">
                                @if($task->status === 'completed')
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                                @endif
                            </button>
                        </form>

                        {{-- Task Content --}}
                        <div class="flex-grow">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="px-2.5 py-1 text-[10px] font-semibold tracking-widest uppercase border border-zinc-200 text-zinc-500 bg-white">
                                    {{ $task->category }}
                                </span>
                                @if($task->status === 'completed')
                                <span class="text-xs font-medium text-green-600">✓ Diselesaikan</span>
                                @endif
                            </div>
                            <h5
                                class="text-lg font-medium text-zinc-900 mb-2 {{ $task->status === 'completed' ? 'line-through text-zinc-500' : '' }}">
                                {{ $task->title }}
                            </h5>
                            <p
                                class="text-sm text-zinc-500 leading-relaxed {{ $task->status === 'completed' ? 'line-through' : '' }}">
                                {{ $task->description }}
                            </p>
                        </div>
                    </div>

                    @empty
                    <div class="p-12 text-center flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-zinc-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <h5 class="text-lg font-medium text-zinc-900 mb-2">Belum Ada Data Diagnostik</h5>
                        <p class="text-sm text-zinc-500 max-w-md mb-6 leading-relaxed">
                            Sistem AI kami memerlukan data metrik operasional Anda sebelum dapat merumuskan
                            Rencana Aksi Eksklusif. Silakan selesaikan pengisian instrumen evaluasi terlebih dahulu.
                        </p>
                        <a href="{{ route('evaluation.index') }}"
                            class="px-6 py-3 text-sm font-medium text-white bg-zinc-900 hover:bg-zinc-800 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 rounded-xl shadow-sm">
                            Mulai Evaluasi Sekarang
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- ================================================================
    CHART SCRIPT
    PENTING: Tidak menggunakan Alpine.data() karena @json di dalam
    Alpine.data() menyebabkan ParseError "unexpected token ,".
    Solusi: gunakan IIFE vanilla JS biasa — lebih ringan dan aman.
    ================================================================ --}}
    @if($showChart)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function () {
            // Data diinjeksi dari PHP menggunakan json_encode bawaan Blade
            // Cara ini aman karena tidak bergantung pada lifecycle Alpine.js
            var chartLabels = {!! json_encode($chartLabels) !!};
            var chartScores = {!! json_encode($chartLabels) !!};

            function renderChart() {
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
                            backgroundColor: 'rgba(63, 63, 70, 0.05)',
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
                            legend: {
                                display: false
                            },
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
                                max: 250, // Skor maks sistem (50 soal x 5 = 250)
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
            }

            // Pastikan DOM sudah siap sebelum mengakses canvas
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', renderChart);
            } else {
                renderChart();
            }
        })();
    </script>
    @endif

</x-app-layout>
