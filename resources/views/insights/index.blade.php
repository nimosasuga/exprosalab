<x-app-layout>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Business Insights & Action Plan</h1>
        <p class="text-slate-500 mt-2">Rekomendasi strategis AI yang dirancang khusus untuk mengatasi kelemahan terbesar
            bisnis Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-red-50 rounded-2xl p-6 border border-red-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-24 h-24 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-red-800 uppercase tracking-wider mb-2">Fokus Utama Perbaikan</h3>
                <h2 class="text-3xl font-black text-red-900 mb-4 capitalize">{{ $weakest }} System</h2>
                <p class="text-red-700 font-medium leading-relaxed">{{ $problem }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Mengapa ini penting?
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Sistem bisnis ibarat rantai. Kekuatan keseluruhan bisnis Anda hanya sekuat mata rantai terlemahnya.
                    Memperbaiki area <strong>{{ ucfirst($weakest) }}</strong> akan memberikan dampak (leverage) terbesar
                    pada pertumbuhan omzet Anda saat ini.
                </p>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm">
                <h3 class="text-xl font-bold text-slate-900 mb-8 border-b border-slate-100 pb-4">Roadmap Eksekusi AI
                </h3>

                <div
                    class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">

                    @foreach($actionSteps as $index => $step)
                    <div
                        class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-indigo-600 text-white font-bold shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                            {{ $index + 1 }}
                        </div>

                        <div
                            class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-slate-50 hover:bg-indigo-50/50 transition-colors p-5 rounded-xl border border-slate-200 shadow-sm">
                            <h4 class="font-bold text-slate-800 text-lg mb-2">{{ $step['title'] }}</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="mt-10 pt-6 border-t border-slate-100 text-center">
                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-indigo-600/30 transition-all flex items-center justify-center gap-2 mx-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                        </svg>
                        Cetak Action Plan (PDF)
                    </button>
                    <p class="text-xs text-slate-400 mt-3">*Fitur cetak akan segera hadir di update selanjutnya.</p>
                </div>

            </div>
        </div>

    </div>

</x-app-layout>
