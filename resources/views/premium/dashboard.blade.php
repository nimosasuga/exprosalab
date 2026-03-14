<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-zinc-900 leading-tight">
            {{ __('Executive Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-zinc-50 min-h-screen font-['Inter']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white border border-zinc-200 p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-light text-zinc-900 mb-2">Fokus Strategis Bulan Ini.</h3>
                        <p class="text-sm text-zinc-500 max-w-2xl leading-relaxed">
                            Berdasarkan hasil diagnostik terakhir, instrumen AI kami telah memprioritaskan daftar
                            inisiatif perbaikan operasional di bawah ini. Eksekusi metrik ini untuk meningkatkan skor
                            perusahaan Anda di kuartal berikutnya.
                        </p>
                    </div>

                    <div class="w-full md:w-64">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-semibold text-zinc-600 uppercase tracking-wider">Progress
                                Eksekusi</span>
                            <span class="text-xs font-bold text-zinc-900">{{ $progress }}%</span>
                        </div>
                        <div class="w-full bg-zinc-100 h-2.5">
                            <div class="bg-zinc-900 h-2.5 transition-all duration-1000 ease-out"
                                style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-zinc-200">
                <div class="px-8 py-6 border-b border-zinc-200 bg-zinc-50/50">
                    <h4 class="text-base font-semibold text-zinc-900 uppercase tracking-wide">Rekomendasi Tindakan
                        (Action Plan)</h4>
                </div>

                <div class="divide-y divide-zinc-200">
                    @forelse($actionPlans as $task)
                    <div
                        class="p-8 flex flex-col sm:flex-row gap-6 items-start hover:bg-zinc-50/50 transition-colors {{ $task->status === 'completed' ? 'opacity-60' : '' }}">

                        <form method="POST" action="{{ route('premium.action-plan.update', $task->id) }}" class="mt-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="flex-shrink-0 w-6 h-6 border-2 flex items-center justify-center transition-colors focus:outline-none {{ $task->status === 'completed' ? 'border-zinc-900 bg-zinc-900' : 'border-zinc-300 hover:border-zinc-500' }}">
                                @if($task->status === 'completed')
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                @endif
                            </button>
                        </form>

                        <div class="flex-grow">
                            <div class="flex items-center gap-3 mb-2">
                                <span
                                    class="px-2.5 py-1 text-[10px] font-semibold tracking-widest uppercase border border-zinc-200 text-zinc-500 bg-white">
                                    {{ $task->category }}
                                </span>
                                @if($task->status === 'completed')
                                <span class="text-xs font-medium text-green-600">Diselesaikan</span>
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
                            Sistem AI kami memerlukan data metrik operasional Anda sebelum dapat merumuskan Rencana Aksi
                            Eksklusif. Silakan
                            selesaikan pengisian instrumen evaluasi terlebih dahulu.
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
</x-app-layout>
