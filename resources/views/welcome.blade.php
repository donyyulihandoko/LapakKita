<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lapak Kita - Marketplace Safe & Fast</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-['Plus_Jakarta_Sans',sans-serif] antialiased bg-slate-950 text-slate-100 selection:bg-emerald-500 selection:text-white">

    {{-- Background Glow Effects & Grid --}}
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div
            class="absolute -top-40 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-gradient-to-tr from-emerald-600/20 via-teal-600/10 to-transparent blur-[120px] rounded-full">
        </div>
        <div class="absolute top-1/3 -right-40 w-[600px] h-[400px] bg-emerald-900/15 blur-[100px] rounded-full"></div>
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-20">
        </div>
    </div>

    {{-- NAVIGATION BAR --}}
    <nav class="sticky top-0 z-50 backdrop-blur-xl bg-slate-950/80 border-b border-slate-800/80 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 group">
                <div
                    class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center text-slate-950 font-black text-xl shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                    LK
                </div>
                <span class="text-2xl font-black tracking-tight text-white">
                    Lapak<span class="text-emerald-400">Kita</span>
                </span>
            </a>

            {{-- Navigation Links (Middle) --}}
            <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-400">
                <a href="#fitur" class="hover:text-emerald-400 transition-colors">Fitur Unggulan</a>
                <a href="#kategori" class="hover:text-emerald-400 transition-colors">Kategori</a>
                <a href="#keunggulan" class="hover:text-emerald-400 transition-colors">Mengapa Kami</a>
            </div>

            {{-- Auth Conditionals (@auth / @guest) --}}
            <div class="flex items-center gap-3">
                @auth
                    {{-- Tombol Khusus Admin jika User Memiliki Role Admin/Super-Admin --}}
                    @if (auth()->user()->hasAnyRole(['admin', 'super-admin']))
                        <a href="/admin"
                            class="px-4 py-2.5 rounded-xl text-xs font-bold bg-slate-800 hover:bg-slate-700 text-amber-400 border border-amber-500/30 transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Admin Panel
                        </a>
                    @endif

                    {{-- Tombol Dashboard Utama --}}
                    <a href="{{ route('dashboard') }}"
                        class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-500 text-white shadow-lg shadow-emerald-600/25 transition-all flex items-center gap-2">
                        <span>Dashboard</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    {{-- Form Logout Ringkas --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" title="Keluar"
                            class="p-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                @else
                    {{-- Tampilan Jika Belum Login --}}
                    <a href="{{ route('login') }}"
                        class="px-4 py-2.5 rounded-xl text-sm font-bold text-slate-300 hover:text-white hover:bg-slate-900 transition-all">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-500 text-white shadow-lg shadow-emerald-600/25 transition-all">
                        Daftar Akun
                    </a>
                @endguest
            </div>

        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="relative pt-12 pb-20 md:pt-20 md:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

            {{-- Badge Info --}}
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-900 border border-slate-800 text-emerald-400 text-xs font-bold mb-8">
                <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                Platform Marketplace Multi-Vendor Terpercaya
            </div>

            {{-- Main Headline --}}
            <h1
                class="text-4xl sm:text-6xl lg:text-7xl font-black text-white tracking-tight leading-tight max-w-4xl mx-auto mb-6">
                Pusat Belanja & Tempat <br class="hidden sm:inline">
                <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">
                    Tumbuh Toko Online Anda.
                </span>
            </h1>

            <p class="text-slate-400 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed mb-10">
                Temukan ribuan produk pilihan dari penjual terpercaya di seluruh Indonesia, atau mulai buka toko online
                Anda sendiri hari ini tanpa kendala.
            </p>

            {{-- Call To Action Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="w-full sm:w-auto px-8 py-4 rounded-2xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white text-base shadow-xl shadow-emerald-600/30 transition-all flex items-center justify-center gap-2">
                        <span>Masuk ke Dashboard</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto px-8 py-4 rounded-2xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white text-base shadow-xl shadow-emerald-600/30 transition-all flex items-center justify-center gap-2">
                        <span>Mulai Sekarang - Gratis</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto px-8 py-4 rounded-2xl font-bold bg-slate-900 hover:bg-slate-800 text-slate-200 border border-slate-800 text-base transition-all">
                        Sudah Punya Akun?
                    </a>
                @endguest
            </div>

            {{-- Stats Grid --}}
            <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-sm">
                    <div class="text-3xl font-black text-emerald-400 mb-1">10rb+</div>
                    <div class="text-xs font-semibold text-slate-400">Pengguna Aktif</div>
                </div>
                <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-sm">
                    <div class="text-3xl font-black text-teal-300 mb-1">2.500+</div>
                    <div class="text-xs font-semibold text-slate-400">Toko Terverifikasi</div>
                </div>
                <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-sm">
                    <div class="text-3xl font-black text-cyan-300 mb-1">99,8%</div>
                    <div class="text-xs font-semibold text-slate-400">Transaksi Sukses</div>
                </div>
                <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800/80 backdrop-blur-sm">
                    <div class="text-3xl font-black text-amber-400 mb-1">24/7</div>
                    <div class="text-xs font-semibold text-slate-400">Dukungan Sistem</div>
                </div>
            </div>

        </div>
    </section>

    {{-- FEATURE HIGHLIGHTS SECTION --}}
    <section id="fitur" class="py-20 bg-slate-900/50 border-y border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Dirancang untuk Pembeli & Penjual</h2>
                <p class="text-slate-400 text-sm mt-3">Nikmati kemudahan fitur modern di platform Lapak Kita.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Card 1 --}}
                <div
                    class="p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 transition-all group">
                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Multi-Vendor Marketplace</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Belanja dari berbagai toko independen dalam satu
                        platform terpadu dengan garansi transaksi aman.</p>
                </div>

                {{-- Card 2 --}}
                <div
                    class="p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 transition-all group">
                    <div
                        class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-300 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Keamanan Terjamin</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Sistem otentikasi ketat, log aktivitas aman,
                        serta perlindungan saldo pembeli dan seller.</p>
                </div>

                {{-- Card 3 --}}
                <div
                    class="p-8 rounded-3xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 transition-all group">
                    <div
                        class="w-12 h-12 rounded-2xl bg-cyan-500/10 text-cyan-300 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Proses Serba Cepat</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Proses pemrosesan pesanan, update status resi,
                        dan penarikan saldo toko berjalan secara serba cepat.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="py-12 bg-slate-950 border-t border-slate-900">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div
                    class="w-8 h-8 rounded-xl bg-emerald-600 flex items-center justify-center text-slate-950 font-black text-sm">
                    LK
                </div>
                <span class="text-lg font-bold text-white">Lapak<span class="text-emerald-400">Kita</span></span>
            </div>

            <p class="text-xs text-slate-500 text-center md:text-left">
                &copy; {{ date('Y') }} Lapak Kita Platform. Seluruh Hak Cipta Dilindungi.
            </p>

            <div class="flex gap-6 text-xs text-slate-500">
                <a href="#" class="hover:text-slate-300 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-slate-300 transition-colors">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-slate-300 transition-colors">Pusat Bantuan</a>
            </div>
        </div>
    </footer>

</body>

</html>
