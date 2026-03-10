<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upgrade ke Pro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <div class="text-center mb-10">
                <h3 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Pilih Paket yang Tepat untuk Bisnis Anda
                </h3>
                <p class="mt-4 text-xl text-gray-600">
                    Dapatkan akses penuh ke fitur Business Insights dan bawa bisnis Anda ke level selanjutnya.
                </p>
            </div>

            <div class="flex flex-col md:flex-row justify-center items-stretch gap-8">

                <div class="bg-white rounded-lg shadow-lg p-8 w-full md:w-1/3 flex flex-col border border-gray-200">
                    <h4 class="text-2xl font-semibold text-gray-800 mb-4">Paket Gratis</h4>
                    <p class="text-gray-500 mb-6 flex-grow">Mulai evaluasi dasar bisnis Anda tanpa biaya.</p>
                    <div class="text-4xl font-bold text-gray-900 mb-6">Rp 0<span
                            class="text-lg text-gray-500 font-normal">/selamanya</span></div>

                    <ul class="text-gray-600 mb-8 space-y-3 flex-grow">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Akses ke 50 Pertanyaan Evaluasi
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Total Score & Health Status
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Visualisasi Radar Chart
                        </li>
                    </ul>

                    @if(auth()->user()->isFree())
                    <button disabled
                        class="w-full bg-gray-300 text-gray-600 font-bold py-3 px-4 rounded cursor-not-allowed">
                        Paket Anda Saat Ini
                    </button>
                    @endif
                </div>

                <div
                    class="bg-indigo-50 border-2 border-indigo-500 rounded-lg shadow-xl p-8 w-full md:w-1/3 flex flex-col relative">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-indigo-500 text-white px-4 py-1 rounded-full text-sm font-bold tracking-wide uppercase">
                        Paling Populer
                    </div>
                    <h4 class="text-2xl font-semibold text-indigo-900 mb-4">Paket Pro</h4>
                    <p class="text-indigo-700 mb-6 flex-grow">Buka kunci semua fitur analitik dan rekomendasi AI.</p>
                    <div class="text-4xl font-bold text-indigo-900 mb-6">Rp 99.000<span
                            class="text-lg text-indigo-600 font-normal">/bulan</span></div>

                    <ul class="text-indigo-800 mb-8 space-y-3 flex-grow">
                        <li class="flex items-center font-semibold">
                            <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Semua fitur Paket Gratis
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Deteksi Weakest System (Sistem Terlemah)
                        </li>
                        <li class="flex items-center font-bold">
                            <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Akses ke Business Insights
                        </li>
                        <li class="flex items-center font-bold">
                            <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Roadmap Eksekusi (Action Plan AI)
                        </li>
                    </ul>

                    @if(auth()->user()->isPremium())
                    <button disabled
                        class="w-full bg-indigo-500 text-white font-bold py-3 px-4 rounded cursor-not-allowed">
                        Anda adalah Member Pro
                    </button>
                    @else
                    <form action="{{ route('subscription.checkout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded transition duration-150 ease-in-out">
                            Upgrade Sekarang
                        </button>
                    </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
