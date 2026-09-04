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
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
</body>
</html>
