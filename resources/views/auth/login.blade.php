<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-2xl font-light text-zinc-900 tracking-tight">Portal Klien</h2>
        <p class="text-sm text-zinc-500 mt-2 leading-relaxed">Masuk untuk melanjutkan proses diagnostik dan melihat
            laporan analitik perusahaan Anda.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-zinc-700 mb-2">Alamat Email Korporat</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username"
                class="block w-full border border-zinc-300 focus:border-zinc-900 focus:ring-0 text-sm py-3 px-4 rounded-none transition-colors bg-zinc-50 focus:bg-white placeholder-zinc-400"
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
                class="block w-full border border-zinc-300 focus:border-zinc-900 focus:ring-0 text-sm py-3 px-4 rounded-none transition-colors bg-zinc-50 focus:bg-white"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 border border-zinc-300 text-zinc-900 focus:ring-0 focus:ring-offset-0 rounded-none bg-zinc-50">
            <label for="remember_me" class="ml-2 text-sm text-zinc-600">Tetap masuk di perangkat ini</label>
        </div>

        <div class="pt-2 flex flex-col gap-4">
            <button type="submit"
                class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent text-sm font-medium text-white bg-zinc-900 hover:bg-zinc-800 transition-colors focus:outline-none focus:ring-0 rounded-none">
                Akses Dashboard
            </button>

            <p class="text-sm text-zinc-500 text-center mt-2">
                Belum bermitra dengan kami?
                <a href="{{ route('register') }}" class="font-medium text-zinc-900 hover:underline transition-colors">
                    Jadwalkan Evaluasi.
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
