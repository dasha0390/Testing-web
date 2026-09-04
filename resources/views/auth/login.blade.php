<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — CMS Sekolah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            ink: { 700:'#0F2A3D', 800:'#0B1F2E' }, gold: { 500:'#C79A3E', 600:'#A87E2C' }, paper:'#F6F3EC'
        }, fontFamily: { display:['Fraunces','serif'], body:['Manrope','sans-serif'] } } } }
    </script>
    <style>body{font-family:'Manrope',sans-serif;}</style>
</head>
<body class="bg-ink-800 min-h-screen flex items-center justify-center px-5">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="inline-flex h-14 w-14 rounded-full bg-gold-500 text-ink-800 items-center justify-center font-display text-2xl mb-4">S</span>
            <h1 class="font-display text-2xl text-white">Panel Admin CMS</h1>
            <p class="text-ink-200 text-sm mt-1">Masuk untuk mengelola konten website sekolah</p>
        </div>

        <div class="bg-paper rounded-2xl p-8 shadow-2xl">
            @if($errors->any())
            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="text-sm font-medium text-ink-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required autofocus>
                </div>
                <div>
                    <label class="text-sm font-medium text-ink-700">Kata Sandi</label>
                    <input type="password" name="password" class="mt-1.5 w-full rounded-xl border-ink-200 focus:border-gold-500 focus:ring-gold-500" required>
                </div>
                <label class="flex items-center gap-2 text-sm text-ink-600">
                    <input type="checkbox" name="remember" class="rounded border-ink-300 text-gold-600 focus:ring-gold-500">
                    Ingat saya
                </label>
                <button type="submit" class="w-full rounded-full bg-ink-700 text-white py-3.5 font-semibold hover:bg-gold-600 transition">Masuk</button>
            </form>
        </div>
        <p class="text-center text-ink-300 text-xs mt-6"><a href="{{ route('home') }}" class="hover:text-white">← Kembali ke Website</a></p>
    </div>
</body>
</html>
