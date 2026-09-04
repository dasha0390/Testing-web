<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin CMS') — Panel Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            ink: { 50:'#EAF0F3', 100:'#CBDBE3', 600:'#173F58', 700:'#0F2A3D', 800:'#0B1F2E' },
            gold: { 50:'#FBF4E4', 400:'#D6AE5C', 500:'#C79A3E', 600:'#A87E2C' }, paper:'#F6F3EC'
        }, fontFamily: { display:['Fraunces','serif'], body:['Manrope','sans-serif'] } } } }
    </script>
    <style>body{font-family:'Manrope',sans-serif;} .font-display{font-family:'Fraunces',serif;}</style>
    @stack('styles')
</head>
<body class="bg-paper text-ink-800" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed lg:static z-40 inset-y-0 left-0 w-64 bg-ink-800 text-ink-100 transition-transform duration-200 flex flex-col">
            <div class="h-20 flex items-center gap-3 px-6 border-b border-white/10">
                <span class="h-9 w-9 rounded-full bg-gold-500 text-ink-800 flex items-center justify-center font-display">S</span>
                <div class="leading-tight">
                    <p class="font-display text-sm text-white">Panel CMS</p>
                    <p class="text-[11px] text-ink-300">Website Sekolah</p>
                </div>
            </div>
            <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 text-sm">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'active' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => '🏠'],
                        ['route' => 'admin.berita.index', 'active' => 'admin.berita.*', 'label' => 'Berita', 'icon' => '📰'],
                        ['route' => 'admin.kategori.index', 'active' => 'admin.kategori.*', 'label' => 'Kategori Berita', 'icon' => '🏷️'],
                        ['route' => 'admin.pengumuman.index', 'active' => 'admin.pengumuman.*', 'label' => 'Pengumuman', 'icon' => '📢'],
                        ['route' => 'admin.galeri.index', 'active' => 'admin.galeri.*', 'label' => 'Galeri', 'icon' => '🖼️'],
                        ['route' => 'admin.guru.index', 'active' => 'admin.guru.*', 'label' => 'Guru & Staff', 'icon' => '👩‍🏫'],
                        ['route' => 'admin.pesan.index', 'active' => 'admin.pesan.*', 'label' => 'Pesan Masuk', 'icon' => '✉️'],
                        ['route' => 'admin.pengaturan.edit', 'active' => 'admin.pengaturan.*', 'label' => 'Pengaturan Situs', 'icon' => '⚙️'],
                    ];
                @endphp
                @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition {{ request()->routeIs($item['active']) ? 'bg-gold-500 text-ink-800 font-semibold' : 'hover:bg-white/10' }}">
                    <span>{{ $item['icon'] }}</span> {{ $item['label'] }}
                </a>
                @endforeach
            </nav>
            <div class="p-4 border-t border-white/10 space-y-2">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-white/10 text-sm">🌐 Lihat Website</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-white/10 text-sm text-left">🚪 Keluar</button>
                </form>
            </div>
        </aside>

        <div class="flex-1 min-w-0">
            {{-- Topbar --}}
            <header class="h-20 bg-white border-b border-ink-100 flex items-center justify-between px-6">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-ink-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="font-display text-xl text-ink-800">@yield('page_title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-full bg-ink-700 text-gold-100 flex items-center justify-center text-sm font-semibold">
                        {{ mb_substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <span class="text-sm text-ink-600 hidden sm:inline">{{ auth()->user()->name ?? '' }}</span>
                </div>
            </header>

            <main class="p-6">
                @if(session('success'))
                <div class="mb-6 rounded-xl bg-green-50 border border-green-200 text-green-700 px-5 py-4 text-sm">
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 text-red-600 px-5 py-4 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
