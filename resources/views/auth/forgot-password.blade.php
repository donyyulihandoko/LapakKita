<x-guest-layout>
    <div>

        {{-- Header Form --}}
        <div class="mb-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                Lupa Kata Sandi?
            </h2>
            <p class="text-sm text-slate-400 mt-2 leading-relaxed">
                Jangan khawatir. Masukkan alamat email yang terdaftar pada akun Anda, dan kami akan mengirimkan tautan
                untuk mengatur ulang kata sandi.
            </p>
        </div>

        {{-- Session Status (Pesan Berhasil Kirim Email) --}}
        <x-auth-session-status
            class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold"
            :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full py-3.5 px-4 mt-2 inline-flex justify-center items-center gap-2 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white transition-all text-sm shadow-lg shadow-emerald-600/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-950">
                <span>Kirim Tautan Reset Password</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>

            {{-- Back to Login --}}
            <div class="pt-6 text-center text-xs text-slate-400 border-t border-slate-800/80 mt-6">
                Ingat kata sandi Anda?
                <a href="{{ route('login') }}"
                    class="text-emerald-400 font-bold hover:underline inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>
        </form>

    </div>
</x-guest-layout>
