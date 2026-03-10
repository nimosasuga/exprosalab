<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exprosa Lab - Cek Kesehatan Usahamu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-figtree antialiased bg-blue-50/50 text-slate-800 selection:bg-blue-500 selection:text-white">

    <header class="fixed w-full top-0 z-50 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div
                        class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-md shadow-blue-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="font-extrabold text-xl text-slate-900 tracking-tight">Exprosa Lab</span>
                </div>

                <nav class="flex items-center gap-4">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm font-bold text-blue-600 hover:text-blue-800 transition">Ke Dashboard Usaha</a>
                    @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-slate-600 hover:text-blue-600 transition hidden sm:block">Masuk</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="text-sm font-bold text-slate-900 bg-amber-400 hover:bg-amber-500 px-5 py-2 rounded-full transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Cek Usaha Gratis
                    </a>
                    @endif
                    @endauth
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <main class="pt-28 pb-16 sm:pt-36 sm:pb-24 lg:pb-32 bg-white rounded-b-[3rem] shadow-sm overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">

            <div class="inline-block px-4 py-1.5 rounded-full bg-blue-100 text-blue-700 text-sm font-bold mb-6">
                🚀 Untuk UMKM & Pebisnis Pemula
            </div>

            <h1
                class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight mb-6 leading-tight max-w-4xl mx-auto">
                Dagangan Laris Manis,<br />
                Tapi <span class="text-blue-600 underline decoration-amber-400 decoration-4 underline-offset-4">Uangnya
                    Nggak Kumpul?</span>
            </h1>

            <p class="text-lg sm:text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                Jangan biarkan usahamu jalan di tempat karena "bocor halus". Jawab beberapa pertanyaan simpel di Exprosa
                Lab, dan temukan cara bikin usahamu makin rapi, untung, dan bisa buka cabang!
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                @auth
                <a href="{{ route('evaluation.index') }}"
                    class="w-full sm:w-auto px-8 py-3.5 text-base font-bold text-slate-900 bg-amber-400 hover:bg-amber-500 rounded-full transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Lanjut Cek Usaha Saya
                </a>
                @else
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-8 py-3.5 text-base font-bold text-slate-900 bg-amber-400 hover:bg-amber-500 rounded-full transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Mulai Cek Sekarang (Gratis)
                </a>
                <a href="#fitur"
                    class="w-full sm:w-auto px-8 py-3.5 text-base font-bold text-blue-600 bg-blue-50 border border-blue-100 hover:bg-blue-100 rounded-full transition">
                    Gimana Caranya?
                </a>
                @endauth
            </div>

            <p class="mt-8 text-sm text-slate-500 font-medium">
                Pengerjaan cuma <span class="text-blue-600 font-bold">5 menit</span>. Aman, rahasia, dan langsung dapat
                hasil.
            </p>
        </div>
    </main>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Cocok banget buat kamu bos-bos:</h2>
            <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                <div
                    class="px-6 py-3 bg-white rounded-full shadow-sm border border-slate-100 font-bold text-slate-600 flex items-center gap-2">
                    🍔 Warung Makan / Kafe
                </div>
                <div
                    class="px-6 py-3 bg-white rounded-full shadow-sm border border-slate-100 font-bold text-slate-600 flex items-center gap-2">
                    👗 Online Shop / Reseller
                </div>
                <div
                    class="px-6 py-3 bg-white rounded-full shadow-sm border border-slate-100 font-bold text-slate-600 flex items-center gap-2">
                    🏪 Toko Kelontong / Grosir
                </div>
                <div
                    class="px-6 py-3 bg-white rounded-full shadow-sm border border-slate-100 font-bold text-slate-600 flex items-center gap-2">
                    🔧 Jasa & Bengkel
                </div>
                <div
                    class="px-6 py-3 bg-white rounded-full shadow-sm border border-slate-100 font-bold text-slate-600 flex items-center gap-2">
                    📦 Produksi Rumahan
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-16 sm:py-24 bg-white rounded-t-[3rem] rounded-b-[3rem] shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mb-4">Apa Aja Sih yang Kita Cek?</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Sistem kami akan kasih pertanyaan seputar 5 hal
                    penting ini buat nyari tahu di mana bagian yang harus diperbaiki.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-blue-50/50 p-8 rounded-3xl border border-blue-100 hover:shadow-md transition">
                    <div
                        class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                        💰
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Pintu Keuangan</h3>
                    <p class="text-slate-600">Biar ketahuan modal kepakai buat apa aja, utang aman atau nggak, dan
                        beneran untung atau cuma perputaran uang doang.</p>
                </div>

                <div class="bg-amber-50/50 p-8 rounded-3xl border border-amber-100 hover:shadow-md transition">
                    <div
                        class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                        📢
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Cara Jualan & Promosi</h3>
                    <p class="text-slate-600">Ngecek seberapa jago kamu narik pembeli baru dan bikin pelanggan lama
                        balik lagi buat belanja terus.</p>
                </div>

                <div class="bg-emerald-50/50 p-8 rounded-3xl border border-emerald-100 hover:shadow-md transition">
                    <div
                        class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                        📦
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Stok & Kegiatan Harian</h3>
                    <p class="text-slate-600">Biar kerjaan nggak berantakan, barang nggak sering basi/hilang, dan
                        orderan pelanggan cepat sampai.</p>
                </div>

                <div class="bg-purple-50/50 p-8 rounded-3xl border border-purple-100 hover:shadow-md transition">
                    <div
                        class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                        👥
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Karyawan & Tim</h3>
                    <p class="text-slate-600">Ngecek cara kamu ngatur anak buah biar pada jujur, rajin kerja, dan nggak
                        gampang keluar-masuk (resign).</p>
                </div>

                <div class="bg-rose-50/50 p-8 rounded-3xl border border-rose-100 hover:shadow-md transition">
                    <div
                        class="w-14 h-14 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center text-2xl mb-6 shadow-sm">
                        🧠
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Mindset Bos (Manajemen)</h3>
                    <p class="text-slate-600">Ngecek seberapa siap kamu sebagai bos buat ngurus izin usaha dan bikin
                        rencana biar usaha bisa buka cabang.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mb-6">Udah Siap Bikin Usahamu Naik Kelas?</h2>
            <p class="text-lg text-slate-600 mb-10">
                Nggak butuh modal besar, cuma butuh kemauan buat berubah. Yuk cari tahu "penyakit" usahamu dan temukan
                obatnya sekarang juga.
            </p>

            @auth
            <a href="{{ route('evaluation.index') }}"
                class="inline-block w-full sm:w-auto px-10 py-4 text-lg font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-full transition shadow-xl transform hover:-translate-y-1">
                Masuk ke Dashboard
            </a>
            @else
            <a href="{{ route('register') }}"
                class="inline-block w-full sm:w-auto px-10 py-4 text-lg font-bold text-slate-900 bg-amber-400 hover:bg-amber-500 rounded-full transition shadow-xl transform hover:-translate-y-1">
                Iya, Saya Mau Cek Usaha Saya!
            </a>
            @endauth
        </div>
    </section>

    <footer class="bg-slate-900 py-10">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="font-extrabold text-xl tracking-tight text-white">Exprosa Lab</span>
            <div class="text-slate-400 text-sm font-medium">
                &copy; {{ date('Y') }} Exprosa Lab. Bantu UMKM Indonesia Naik Kelas.
            </div>
        </div>
    </footer>

</body>

</html>
