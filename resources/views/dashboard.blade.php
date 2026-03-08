<x-app-layout>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Selamat datang, {{ Auth::user()->name ?? 'User' }} 👋</h1>
        <p class="text-slate-500 mt-1">Berikut adalah ringkasan kesehatan bisnis Anda saat ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="text-sm font-medium text-slate-500">Business Health Score</div>
                <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <div class="text-4xl font-extrabold text-slate-900">78</div>
                <span class="text-sm font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">+5%</span>
            </div>
            <div class="mt-4 w-full bg-slate-100 rounded-full h-1.5">
                <div class="bg-indigo-600 h-1.5 rounded-full" style="width: 78%"></div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="text-sm font-medium text-slate-500">Business Status</div>
                <div class="p-2 bg-red-50 rounded-lg text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
            </div>
            <div
                class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                <span class="w-2 h-2 rounded-full bg-red-500 mr-2 animate-pulse"></span>
                Critical
            </div>
            <p class="text-sm text-slate-500 mt-3">Butuh perhatian segera pada sistem inti.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
            <div class="flex justify-between items-start mb-4">
                <div class="text-sm font-medium text-slate-500">Weakest System</div>
                <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-800 mt-1">
                Conversion System
            </div>
            <a href="/insights"
                class="text-sm text-indigo-600 font-medium hover:text-indigo-800 mt-4 inline-flex items-center gap-1">
                Lihat Solusi <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-semibold text-slate-800">Business System Radar</h3>
                <button class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                        </path>
                    </svg>
                </button>
            </div>
            <div
                class="flex-1 min-h-[250px] bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 border-dashed">
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                    [ Radar Chart Area ]
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-semibold text-slate-800">Strategic Recommendations</h3>
                <span class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">3
                    Tasks</span>
            </div>

            <div class="space-y-4">
                <div
                    class="flex items-start gap-4 p-3 hover:bg-slate-50 rounded-xl transition-colors border border-transparent hover:border-slate-100">
                    <div
                        class="mt-1 flex-shrink-0 w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                        1
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Improve offer clarity</h4>
                        <p class="text-sm text-slate-500 mt-1">Buat penawaran Anda lebih jelas dan mudah dipahami oleh
                            target pasar.</p>
                    </div>
                </div>

                <div
                    class="flex items-start gap-4 p-3 hover:bg-slate-50 rounded-xl transition-colors border border-transparent hover:border-slate-100">
                    <div
                        class="mt-1 flex-shrink-0 w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                        2
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Create stronger CTA</h4>
                        <p class="text-sm text-slate-500 mt-1">Perkuat Call-to-Action di setiap materi pemasaran Anda.
                        </p>
                    </div>
                </div>

                <div
                    class="flex items-start gap-4 p-3 hover:bg-slate-50 rounded-xl transition-colors border border-transparent hover:border-slate-100">
                    <div
                        class="mt-1 flex-shrink-0 w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                        3
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800">Build funnel landing page</h4>
                        <p class="text-sm text-slate-500 mt-1">Rancang satu halaman khusus (landing page) untuk
                            menangkap leads baru.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
