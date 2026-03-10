<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-2xl font-light text-zinc-900 tracking-tight">Registrasi Akses</h2>
        <p class="text-sm text-zinc-500 mt-2 leading-relaxed">Daftarkan profil perusahaan Anda untuk mengakses instrumen
            diagnostik kami.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-zinc-700 mb-2">Nama Lengkap / Perwakilan</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="block w-full border border-zinc-300 focus:border-zinc-900 focus:ring-0 text-sm py-3 px-4 rounded-none transition-colors bg-zinc-50 focus:bg-white placeholder-zinc-400"
                placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-zinc-700 mb-2">Alamat Email Korporat</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="block w-full border border-zinc-300 focus:border-zinc-900 focus:ring-0 text-sm py-3 px-4 rounded-none transition-colors bg-zinc-50 focus:bg-white placeholder-zinc-400"
                placeholder="nama@perusahaan.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <label for="whatsapp_number" class="block text-sm font-medium text-zinc-700 mb-2">Nomor WhatsApp
                Aktif</label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-4 border border-r-0 border-zinc-300 bg-zinc-100 text-zinc-500 sm:text-sm font-medium rounded-none">
                    +62
                </span>
                <input id="whatsapp_number" type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}"
                    required
                    class="block w-full border border-zinc-300 focus:border-zinc-900 focus:ring-0 text-sm py-3 px-4 rounded-none transition-colors bg-zinc-50 focus:bg-white placeholder-zinc-400"
                    placeholder="81234567890" />
            </div>
            <x-input-error :messages="$errors->get('whatsapp_number')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-zinc-700 mb-2">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="block w-full border border-zinc-300 focus:border-zinc-900 focus:ring-0 text-sm py-3 px-4 rounded-none transition-colors bg-zinc-50 focus:bg-white"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 mb-2">Konfirmasi Kata
                Sandi</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password"
                class="block w-full border border-zinc-300 focus:border-zinc-900 focus:ring-0 text-sm py-3 px-4 rounded-none transition-colors bg-zinc-50 focus:bg-white"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-600" />
        </div>

        <div class="pt-4 flex flex-col gap-4">
            <button type="submit"
                class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-medium text-white bg-zinc-900 hover:bg-zinc-800 transition-colors focus:outline-none focus:ring-0 rounded-none">
                Buat Akun Perusahaan
            </button>

            <p class="text-sm text-zinc-500 text-center mt-2">
                Sudah memiliki akses?
                <a href="{{ route('login') }}" class="font-medium text-zinc-900 hover:underline transition-colors">
                    Masuk di sini.
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
