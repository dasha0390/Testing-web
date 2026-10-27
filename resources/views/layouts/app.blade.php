<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $pengaturanGlobal->nama_sekolah ?? 'Website Sekolah')</title>
    <meta name="description" content="@yield('meta_description', $pengaturanGlobal->deskripsi_singkat ?? '')">
    <link rel="icon" href="{{ $pengaturanGlobal->logo ? asset('storage/'.$pengaturanGlobal->logo) : '' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Manrope:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: {
                            DEFAULT: '#0F2A3D',
                            50: '#EAF0F3',
                            100: '#CBDBE3',
                            200: '#9EBCCA',
                            600: '#173F58',
                            700: '#0F2A3D',
                            800: '#0B1F2E',
                            900: '#071620',
                        },
                        gold: {
                            DEFAULT: '#C79A3E',
                            50: '#FBF4E4',
                            100: '#F3E2B8',
                            400: '#D6AE5C',
                            500: '#C79A3E',
                            600: '#A87E2C',
                        },
                        paper: '#F6F3EC',
                    },
                    fontFamily: {
                        display: ['Fraunces', 'serif'],
                        body: ['Manrope', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Manrope', sans-serif; background-color: #F6F3EC; }
        .font-display { font-family: 'Fraunces', serif; }
        .signature-underline { position: relative; display: inline-block; }
        .signature-underline::after {
            content: '';
            position: absolute;
            left: 0; right: 0; bottom: -6px;
            height: 8px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 10'%3E%3Cpath d='M0 5 Q 25 -3 50 5 T 100 5' stroke='%23C79A3E' stroke-width='2.5' fill='none'/%3E%3C/svg%3E") repeat-x;
            background-size: 50px 8px;
        }
        [x-cloak] { display: none !important; }
        ::selection { background-color: #C79A3E; color: #0F2A3D; }
        /* Peta (Google Maps embed) responsif: mengisi kontainer tanpa overflow */
        .maps-embed { position: relative; width: 100%; aspect-ratio: 16 / 9; }
        .maps-embed iframe { position: absolute; inset: 0; width: 100% !important; height: 100% !important; border: 0; }
        img, svg, video { max-width: 100%; height: auto; }
        .fade-up { animation: fadeUp .7s ease both; }
        @keyframes fadeUp { from { opacity:0; transform: translateY(16px);} to {opacity:1; transform:none;} }
    </style>
    @stack('styles')
</head>
<body class="text-ink-800 antialiased">
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')

    {{-- WhatsApp popup --}}
    <div class="fixed bottom-5 left-5 z-[60] flex flex-col items-start gap-3">
        <div id="wa-popup" class="hidden w-[19rem] max-w-[calc(100vw-2.5rem)] overflow-hidden rounded-2xl border border-ink-100 bg-white shadow-2xl">
            <div class="flex items-center gap-3 bg-[#25D366] px-4 py-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-[#25D366]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884a9.82 9.82 0 0 1 6.988 2.896 9.82 9.82 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.8 11.8 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.9 11.9 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.8 11.8 0 0 0-3.48-8.413Z"/></svg>
                </span>
                <div class="leading-tight text-white">
                    <p class="text-sm font-semibold">Ask me!</p>
                    <p class="text-[11px] text-white/80">Biasanya membalas dalam beberapa menit</p>
                </div>
                <button type="button" data-wa-close class="ml-auto p-1 text-white/80 hover:text-white" aria-label="Tutup">&times;</button>
            </div>
            <div class="p-4">
                <div class="rounded-xl bg-ink-50 px-4 py-3 text-sm leading-relaxed text-ink-700">Halo! Ada yang ingin ditanyakan seputar sekolah kami? Chat kami sekarang.</div>
                <a href="https://api.whatsapp.com/message/E7E2FGCAJ3HGI1?autoload=1&amp;app_absent=0&amp;utm_source=ig&amp;utm_medium=social&amp;utm_content=link_in_bio&amp;fbclid=PAZXh0bgNhZW0DMTAwAHBkb2YCc3J0YwZhcHBfaWQPOTM2NjE5NzQzMzkyNDU5AAGn6MPAX1ssfqz2-ThC_-gg4CNu5Ll7oD70YwxRqMPG1rFQ4uBRwf0nr9ALpJM_aem_OlmfzHVHE0Ig37iWcW59_A" target="_blank" rel="noopener" class="mt-3 flex items-center justify-center gap-2 rounded-full bg-[#25D366] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#1ebe5b]">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884a9.82 9.82 0 0 1 6.988 2.896 9.82 9.82 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.8 11.8 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.9 11.9 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.8 11.8 0 0 0-3.48-8.413Z"/></svg>
                    Chat via WhatsApp
                </a>
            </div>
        </div>
        <button type="button" data-wa-toggle class="flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-xl transition hover:scale-105" aria-label="Chat WhatsApp">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884a9.82 9.82 0 0 1 6.988 2.896 9.82 9.82 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.8 11.8 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.9 11.9 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.8 11.8 0 0 0-3.48-8.413Z"/></svg>
        </button>
    </div>
    <script>
        (function () {
            var popup = document.getElementById('wa-popup');
            var toggle = document.querySelector('[data-wa-toggle]');
            var close = document.querySelector('[data-wa-close]');
            if (!popup || !toggle) return;
            function show() { popup.classList.remove('hidden'); }
            function hide() { popup.classList.add('hidden'); try { sessionStorage.setItem('waPopupClosed', '1'); } catch (e) {} }
            toggle.addEventListener('click', function () { popup.classList.contains('hidden') ? show() : hide(); });
            if (close) close.addEventListener('click', hide);
            var dismissed = false;
            try { dismissed = sessionStorage.getItem('waPopupClosed') === '1'; } catch (e) {}
            if (!dismissed) setTimeout(show, 3000);
        })();
    </script>
</body>
</html>
