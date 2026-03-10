<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-medium text-zinc-900 tracking-tight">Registrasi Akses</h2>
        <p class="text-sm text-zinc-500 mt-2.5 leading-relaxed">Daftarkan profil perusahaan Anda untuk mengakses
            instrumen diagnostik kami.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-zinc-700 mb-2">Nama Lengkap / Perwakilan</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="block w-full border-zinc-200 focus:border-zinc-900 focus:ring focus:ring-zinc-900/10 text-sm py-3 px-4 rounded-xl transition-all duration-300 bg-zinc-50/50 focus:bg-white placeholder-zinc-400 shadow-sm"
                placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-zinc-700 mb-2">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="block w-full border-zinc-200 focus:border-zinc-900 focus:ring focus:ring-zinc-900/10 text-sm py-3 px-4 rounded-xl transition-all duration-300 bg-zinc-50/50 focus:bg-white placeholder-zinc-400 shadow-sm"
                placeholder="nama@perusahaan.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <label for="whatsapp_number" class="block text-sm font-medium text-zinc-700 mb-2">Nomor WhatsApp
                Aktif</label>
            <div
                class="flex rounded-xl shadow-sm border border-zinc-200 bg-zinc-50/50 focus-within:bg-white focus-within:border-zinc-900 focus-within:ring focus-within:ring-zinc-900/10 transition-all duration-300 overflow-hidden">
                <span
                    class="inline-flex items-center px-4 border-r border-zinc-200 text-zinc-500 sm:text-sm font-semibold bg-transparent">
                    +62
                </span>
                <input id="whatsapp_number" type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}"
                    required
                    class="block w-full border-0 focus:ring-0 text-sm py-3 px-4 bg-transparent placeholder-zinc-400"
                    placeholder="81234567890" />
            </div>
            <x-input-error :messages="$errors->get('whatsapp_number')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-zinc-700 mb-2">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="block w-full border-zinc-200 focus:border-zinc-900 focus:ring focus:ring-zinc-900/10 text-sm py-3 px-4 rounded-xl transition-all duration-300 bg-zinc-50/50 focus:bg-white placeholder-zinc-400 shadow-sm"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 mb-2">Konfirmasi Kata
                Sandi</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password"
                class="block w-full border-zinc-200 focus:border-zinc-900 focus:ring focus:ring-zinc-900/10 text-sm py-3 px-4 rounded-xl transition-all duration-300 bg-zinc-50/50 focus:bg-white placeholder-zinc-400 shadow-sm"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-600" />
        </div>

        <div class="pt-4 flex flex-col gap-4">
            <button type="submit"
                class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-medium text-white bg-zinc-900 hover:bg-zinc-800 transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900 rounded-xl transform hover:-translate-y-0.5">
                Buat Akun Perusahaan
            </button>

            <p class="text-sm text-zinc-500 text-center mt-2">
                Sudah memiliki akses?
                <a href="{{ route('login') }}" class="font-semibold text-zinc-900 hover:underline transition-colors">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
