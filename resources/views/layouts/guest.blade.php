<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lapak Kita') }}</title>

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap"
        rel="stylesheet" />

    <!-- Alpine.js & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Plus_Jakarta_Sans',sans-serif] antialiased h-full text-slate-100 bg-slate-950 overflow-x-hidden">

    <div class="min-h-screen lg:h-screen w-full flex flex-col lg:flex-row overflow-hidden">

        {{-- SISI KIRI: Branding & Visual Showcase (Terlihat di Desktop LG ke atas) --}}
        <div
            class="hidden lg:flex lg:w-1/2 bg-slate-900 relative flex-col justify-between p-12 overflow-hidden border-r border-slate-800/80">

            {{-- Background Decorative Glows & Grid --}}
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-20 -left-20 w-[500px] h-[500px] bg-emerald-600/20 rounded-full blur-[120px]">
                </div>
                <div class="absolute -bottom-20 -right-20 w-[450px] h-[450px] bg-teal-500/15 rounded-full blur-[100px]">
                </div>
                <div
                    class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:3rem_3rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-20">
                </div>
            </div>

            {{-- Header / Brand Logo --}}
            <div class="relative z-10 flex items-center justify-between">
                <a href="/" class="flex items-center gap-3 group">
                    <div
                        class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center text-slate-950 font-black text-xl shadow-lg shadow-emerald-500/25 group-hover:scale-105 transition-transform">
                        LK
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight text-white">
                        Lapak<span class="text-emerald-400">Kita</span>
                    </span>
                </a>

                <span
                    class="text-xs font-semibold px-3 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Platform Marketplace Verified
                </span>
            </div>

            {{-- Hero Showcase Content --}}
            <div class="relative z-10 my-auto py-8">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700 text-amber-400 text-xs font-semibold mb-6">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    E-Commerce Multi-Vendor Terpercaya
                </div>

                <h1 class="text-4xl xl:text-5xl font-black text-white leading-tight tracking-tight mb-4">
                    Jual Beli Mudah, <br>
                    <span
                        class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">
                        Toko Makin Berkembang.
                    </span>
                </h1>

                <p class="text-slate-400 text-base max-w-md leading-relaxed mb-8">
                    Nikmati pengalaman belanja terbaik dari ribuan penjual lokal terpercaya, atau buka toko Anda sendiri
                    dalam hitungan menit.
                </p>

                {{-- Feature Cards / Stat Highlights --}}
                <div class="grid grid-cols-2 gap-4 max-w-md">
                    <div class="p-4 rounded-2xl bg-slate-800/50 border border-slate-700/60 backdrop-blur-sm">
                        <div class="text-2xl font-black text-emerald-400 mb-1">100%</div>
                        <div class="text-xs font-medium text-slate-400">Transaksi Safe & Escrow</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-800/50 border border-slate-700/60 backdrop-blur-sm">
                        <div class="text-2xl font-black text-teal-300 mb-1">Instant</div>
                        <div class="text-xs font-medium text-slate-400">Penarikan Saldo Toko</div>
                    </div>
                </div>
            </div>

            {{-- Footer Info --}}
            <div class="relative z-10 flex items-center justify-between text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} Lapak Kita Platform. All rights reserved.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-slate-300 transition-colors">Bantuan</a>
                    <a href="#" class="hover:text-slate-300 transition-colors">Privasi</a>
                </div>
            </div>

        </div>

        {{-- SISI KANAN: Form Area (Full Screen Height di Desktop) --}}
        <div
            class="w-full lg:w-1/2 bg-slate-950 flex flex-col justify-between p-6 sm:p-12 lg:p-16 h-full overflow-y-auto">

            {{-- Top Navigation Mobile --}}
            <div class="flex lg:hidden justify-between items-center mb-8">
                <a href="/" class="flex items-center gap-2">
                    <div
                        class="w-9 h-9 rounded-xl bg-emerald-600 flex items-center justify-center text-slate-950 font-black text-lg">
                        LK
                    </div>
                    <span class="text-xl font-bold text-white">Lapak<span class="text-emerald-400">Kita</span></span>
                </a>
            </div>

            {{-- Slot Utama (Form Register / Login) --}}
            <div class="my-auto w-full max-w-md mx-auto">
                {{ $slot }}
            </div>

            {{-- Mobile Footer --}}
            <div class="lg:hidden mt-8 text-center text-xs text-slate-600">
                &copy; {{ date('Y') }} Lapak Kita Platform.
            </div>

        </div>

    </div>

</body>

</html>
