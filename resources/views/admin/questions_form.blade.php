<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($question) ? 'Edit Pertanyaan' : 'Tambah Pertanyaan Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form
                    action="{{ isset($question) ? route('admin.questions.update', $question->id) : route('admin.questions.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($question))
                    @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">Kategori
                            (Pilar)</label>
                        <select name="category_id" id="category_id"
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $question->category_id ?? '') ==
                                $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="code">Kode Pertanyaan</label>
                        <input type="text" name="code" id="code" value="{{ old('code', $question->code ?? '') }}"
                            placeholder="Contoh: MKT-01"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        <p class="text-xs text-gray-500 mt-1">Gunakan format KATEGORI-ANGKA untuk kerapian (Contoh:
                            MKT-01, VIS-05).</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="question">Teks Pertanyaan</label>
                        <textarea name="question" id="question" rows="4"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>{{ old('question', $question->question ?? '') }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-150">
                            {{ isset($question) ? 'Simpan Perubahan' : 'Tambah Pertanyaan' }}
                        </button>
                        <a href="{{ route('admin.questions.index') }}"
                            class="text-gray-500 hover:text-gray-800 text-sm font-medium">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
