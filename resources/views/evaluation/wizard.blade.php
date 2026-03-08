<x-app-layout>

    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                    </path>
                </svg>
                Evaluasi: {{ $category->name }}
            </h1>
            <p class="text-slate-500 text-sm mt-1">Jawablah pertanyaan berikut dengan jujur untuk mendapatkan diagnosis
                AI yang akurat.</p>
        </div>
        <div class="text-right">
            <span
                class="text-sm font-semibold text-indigo-700 bg-indigo-100 px-4 py-1.5 rounded-full border border-indigo-200">
                Langkah {{ $step }} dari {{ $totalCategories }}
            </span>
        </div>
    </div>

    <div class="w-full bg-slate-200 rounded-full h-2 mb-8 shadow-inner overflow-hidden">
        <div class="bg-indigo-600 h-2 rounded-full transition-all duration-700 ease-out"
            style="width: {{ $progress }}%"></div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-10 relative overflow-hidden">
        <div
            class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-50 rounded-full blur-2xl opacity-70 pointer-events-none">
        </div>

        <form action="{{ route('evaluation.saveStep', $step) }}" method="POST">
            @csrf
            <input type="hidden" name="evaluation_id" value="{{ $evaluation->id }}">

            <div class="space-y-10">
                @foreach ($category->questions as $index => $question)
                <div class="border-b border-slate-100 pb-10 last:border-0 last:pb-0 relative z-10">
                    <h3 class="text-lg font-medium text-slate-800 mb-5 flex gap-4 leading-relaxed">
                        <span
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 border border-indigo-100 flex items-center justify-center font-bold text-sm shadow-sm">
                            {{ $index + 1 }}
                        </span>
                        <span>{{ $question->question_text }}</span>
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 pl-0 md:pl-12">
                        @for ($i = 1; $i <= 5; $i++) <label class="cursor-pointer relative group">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $i }}"
                                class="peer sr-only" required>

                            <div
                                class="text-center py-4 px-2 rounded-xl border-2 border-slate-200 bg-white hover:border-indigo-300 hover:bg-indigo-50/50 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 transition-all shadow-sm group-hover:shadow">

                                <span
                                    class="block text-xl font-black text-slate-400 peer-checked:text-indigo-700 transition-colors">
                                    {{ $i }}
                                </span>

                                <span
                                    class="text-xs font-semibold text-slate-500 peer-checked:text-indigo-600 mt-1.5 block transition-colors">
                                    @if($i == 1) Sangat Lemah @endif
                                    @if($i == 2) Kurang @endif
                                    @if($i == 3) Cukup @endif
                                    @if($i == 4) Baik @endif
                                    @if($i == 5) Sangat Kuat @endif
                                </span>
                            </div>

                            <div
                                class="absolute -top-2 -right-2 w-6 h-6 bg-indigo-600 rounded-full text-white flex items-center justify-center opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-200 shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            </label>
                            @endfor
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12 pt-6 border-t border-slate-200 flex items-center justify-between">
                <p class="text-sm text-slate-500 hidden md:block">Pastikan semua pertanyaan telah terisi sebelum
                    melanjutkan.</p>

                <button type="submit"
                    class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                    <span>{{ $step == $totalCategories ? 'Selesaikan & Diagnosa Sekarang' : 'Simpan & Lanjut ke Tahap '
                        . ($step + 1) }}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
