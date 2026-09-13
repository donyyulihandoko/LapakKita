<x-guest-layout>
    <div>

        {{-- Header Form --}}
        <div class="mb-8">
            <div
                class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-4 border border-emerald-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                Verifikasi Email Anda
            </h2>
            <p class="text-sm text-slate-400 mt-2 leading-relaxed">
                Terima kasih telah mendaftar di <span class="text-emerald-400 font-semibold">Lapak Kita</span>! Sebelum
                memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan.
            </p>
        </div>

        {{-- Status Pesan Tautan Baru Berhasil Dikirim --}}
        @if (session('status') == 'verification-link-sent')
            <div
                class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold flex items-start gap-2.5">
                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda daftarkan.</span>
            </div>
        @endif

        <div class="space-y-4">
            {{-- Form Kirim Ulang Email Verifikasi --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3.5 px-4 inline-flex justify-center items-center gap-2 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white transition-all text-sm shadow-lg shadow-emerald-600/25 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-950">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Kirim Ulang Email Verifikasi</span>
                </button>
            </form>

            {{-- Form Logout --}}
            <div class="pt-4 text-center border-t border-slate-800/80">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-xs text-slate-400 hover:text-slate-200 font-semibold transition-colors underline">
                        Keluar dari Akun
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-guest-layout>
