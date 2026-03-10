<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-medium text-zinc-900 tracking-tight">Portal Klien</h2>
        <p class="text-sm text-zinc-500 mt-2.5 leading-relaxed">Masuk untuk melanjutkan diagnostik dan melihat laporan
            analitik perusahaan Anda.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-zinc-700 mb-2">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username"
                class="block w-full border-zinc-200 focus:border-zinc-900 focus:ring focus:ring-zinc-900/10 text-sm py-3 px-4 rounded-xl transition-all duration-300 bg-zinc-50/50 focus:bg-white placeholder-zinc-400 shadow-sm"
                placeholder="nama@perusahaan.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-sm font-medium text-zinc-700">Kata Sandi</label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-xs font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
                    Lupa sandi?
                </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full border-zinc-200 focus:border-zinc-900 focus:ring focus:ring-zinc-900/10 text-sm py-3 px-4 rounded-xl transition-all duration-300 bg-zinc-50/50 focus:bg-white placeholder-zinc-400 shadow-sm"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600" />
        </div>

        <div class="flex items-center pt-1">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 border-zinc-300 text-zinc-900 focus:ring-zinc-900/20 rounded shadow-sm transition-colors">
            <label for="remember_me" class="ml-2 text-sm text-zinc-600 font-medium cursor-pointer">Tetap masuk di
                perangkat ini</label>
        </div>

        <div class="pt-4 flex flex-col gap-4">
            <button type="submit"
                class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent text-sm font-medium text-white bg-zinc-900 hover:bg-zinc-800 transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 rounded-xl transform hover:-translate-y-0.5">
                Akses Dashboard
            </button>

            <p class="text-sm text-zinc-500 text-center mt-2">
                Belum bermitra dengan kami?
                <a href="{{ route('register') }}" class="font-semibold text-zinc-900 hover:underline transition-colors">
                    Jadwalkan Evaluasi
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
