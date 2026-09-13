<x-guest-layout>
    <div x-data="{ role: 'customer', showPass: false, showPassConfirm: false }">

        {{-- Header Form --}}
        <div class="mb-8">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                Daftar Akun Baru
            </h2>
            <p class="text-sm text-slate-400 mt-2">
                Pilih jenis akun dan mulai perjalanan bertransaksi Anda di Lapak Kita.
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- Selector Role (Customer / Seller) --}}
            {{-- <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">
                    Daftar Sebagai
                </label>
                <div class="grid grid-cols-2 gap-3 p-1.5 bg-slate-900 border border-slate-800 rounded-2xl">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="customer" x-model="role" class="peer hidden">
                        <div
                            class="flex items-center justify-center gap-2 py-3 px-4 text-xs font-bold rounded-xl text-slate-400 peer-checked:bg-emerald-600 peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-emerald-600/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Pembeli
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="seller" x-model="role" class="peer hidden">
                        <div
                            class="flex items-center justify-center gap-2 py-3 px-4 text-xs font-bold rounded-xl text-slate-400 peer-checked:bg-emerald-600 peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-emerald-600/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Buka Toko
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-1" />
            </div> --}}

            {{-- Nama Lengkap --}}
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-300 mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        placeholder="Contoh: Budi Santoso"
                        class="w-full pl-10 pr-4 py-3 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all" />
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <input id="email" type="email" name="email" :value="old('email')" required
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

            {{-- Password Grid (2 Kolom agar Hemat Tempat Satu Layar) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                {{-- Password --}}
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <input id="password" :type="showPass ? 'text' : 'password'" name="password" required
                            placeholder="••••••••"
                            class="w-full pl-9 pr-8 py-3 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all" />
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <button type="button" @click="showPass = !showPass"
                            class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-slate-500 hover:text-slate-300">
                            <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.025 10.025 0 012.122-.128c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m-8.919-8.919a3 3 0 104.243 4.243M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation"
                        class="block text-xs font-semibold text-slate-300 mb-1.5">Konfirmasi Sandi</label>
                    <div class="relative">
                        <input id="password_confirmation" :type="showPassConfirm ? 'text' : 'password'"
                            name="password_confirmation" required placeholder="••••••••"
                            class="w-full pl-9 pr-8 py-3 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all" />
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <button type="button" @click="showPassConfirm = !showPassConfirm"
                            class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-slate-500 hover:text-slate-300">
                            <svg x-show="!showPassConfirm" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassConfirm" class="w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.025 10.025 0 012.122-.128c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m-8.919-8.919a3 3 0 104.243 4.243M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full py-3.5 px-4 mt-2 inline-flex justify-center items-center gap-2 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white transition-all text-sm shadow-lg shadow-emerald-600/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-950">
                <span>Buat Akun Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>

            {{-- Link to Login --}}
            <div class="pt-4 text-center text-xs text-slate-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-emerald-400 font-bold hover:underline">
                    Masuk ke Akun
                </a>
            </div>
        </form>

    </div>
</x-guest-layout>
