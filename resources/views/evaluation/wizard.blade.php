<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex justify-between text-sm font-medium text-gray-600 mb-2">
                    <span>Langkah {{ $step }} dari {{ $totalCategories }}</span>
                    <span>{{ round($progress) }}% Selesai</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-indigo-600 h-2.5 rounded-full transition-all duration-500"
                        style="width: {{ $progress }}%"></div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kategori: {{ $category->name }}</h2>

                    <form action="{{ route('evaluation.saveStep', $step) }}" method="POST">
                        @csrf
                        <input type="hidden" name="evaluation_id" value="{{ $evaluation->id }}">

                        <div class="space-y-8">
                            @foreach ($category->questions as $index => $question)
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                                <p class="text-lg text-gray-700 font-medium mb-4">{{ $index + 1 }}. {{
                                    $question->question_text }}</p>

                                <div class="grid grid-cols-5 gap-4">
                                    @for ($i = 1; $i <= 5; $i++) <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $i }}"
                                            class="peer sr-only" required>
                                        <div
                                            class="text-center p-3 rounded-md border-2 border-gray-200 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 hover:bg-gray-100 transition">
                                            <span class="block text-xl font-bold text-gray-700">{{ $i }}</span>
                                            <span class="text-xs text-gray-500">
                                                @if($i == 1) Sangat Lemah @endif
                                                @if($i == 3) Rata-rata @endif
                                                @if($i == 5) Sangat Baik @endif
                                            </span>
                                        </div>
                                        </label>
                                        @endfor
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition duration-300">
                                {{ $step == $totalCategories ? 'Selesaikan Evaluasi' : 'Simpan & Lanjut' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
