<x-guest-layout>
    <div x-data="{ showPass: false }">

        {{-- Header Form --}}
        <div class="mb-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                Selamat Datang Kembali!
            </h2>
            <p class="text-sm text-slate-400 mt-2">
                Masuk ke akun Anda untuk mulai berbelanja atau mengelola toko di Lapak Kita.
            </p>
        </div>

        {{-- Session Status (misal pesan sukses reset password) --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- Email Address --}}
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        placeholder="nama@email.com"
                        class="w-full pl-10 pr-4 py-3 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all" />
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            {{-- Password --}}
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold text-slate-300">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-xs font-semibold text-emerald-400 hover:underline">
                            Lupa sandi?
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <input id="password" :type="showPass ? 'text' : 'password'" name="password" required
                        autocomplete="current-password" placeholder="••••••••"
                        class="w-full pl-10 pr-10 py-3 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all" />
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <button type="button" @click="showPass = !showPass"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-300 focus:outline-none">
                        <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.025 10.025 0 012.122-.128c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m-8.919-8.919a3 3 0 104.243 4.243M3 3l18 18" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="w-4 h-4 rounded bg-slate-900 border-slate-800 text-emerald-600 focus:ring-emerald-500 focus:ring-offset-slate-950">
                    <span class="ms-2 text-xs text-slate-400 font-medium">Ingat Saya di Perangkat Ini</span>
                </label>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full py-3.5 px-4 mt-4 inline-flex justify-center items-center gap-2 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white transition-all text-sm shadow-lg shadow-emerald-600/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-950">
                <span>Masuk Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>

            {{-- Link to Register --}}
            <div class="pt-6 text-center text-xs text-slate-400 border-t border-slate-800/80 mt-6">
                Belum memiliki akun di Lapak Kita?
                <a href="{{ route('register') }}" class="text-emerald-400 font-bold hover:underline">
                    Daftar Akun Baru
                </a>
            </div>
        </form>

    </div>
</x-guest-layout>
