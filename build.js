const fs = require('fs');
const path = require('path');

const DATA_DIR = path.join(__dirname, 'dist', 'data');
const DIST_DIR = path.join(__dirname, 'dist');

function readJSON(file) {
  return JSON.parse(fs.readFileSync(path.join(DATA_DIR, file), 'utf8'));
}

function slugify(text) {
  return text.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
}

function formatDate(dateStr) {
  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  const d = new Date(dateStr);
  return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

function getKategori(id, kategoris) {
  const k = kategoris.find(k => k.id === id);
  return k ? k.nama : '';
}

function truncate(str, len) {
  if (!str) return '';
  const clean = str.replace(/<[^>]*>/g, '');
  return clean.length > len ? clean.substring(0, len) + '...' : clean;
}

function linkify(text) {
  if (!text) return '';
  const urlRegex = /(https?:\/\/[^\s<]+)/g;
  return text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(urlRegex, '<a href="$1" target="_blank" class="text-gold-600 underline">$1</a>').replace(/\n/g, '<br>');
}

const HEAD = `<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{TITLE}}</title>
    <meta name="description" content="{{DESCRIPTION}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: { DEFAULT: '#0F2A3D', 50: '#EAF0F3', 100: '#CBDBE3', 200: '#9EBCCA', 600: '#173F58', 700: '#0F2A3D', 800: '#0B1F2E', 900: '#071620' },
                        gold: { DEFAULT: '#C79A3E', 50: '#FBF4E4', 100: '#F3E2B8', 400: '#D6AE5C', 500: '#C79A3E', 600: '#A87E2C' },
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
        .signature-underline::after { content: ''; position: absolute; left: 0; right: 0; bottom: -6px; height: 8px; background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 10'%3E%3Cpath d='M0 5 Q 25 -3 50 5 T 100 5' stroke='%23C79A3E' stroke-width='2.5' fill='none'/%3E%3C/svg%3E") repeat-x; background-size: 50px 8px; }
        [x-cloak] { display: none !important; }
        ::selection { background-color: #C79A3E; color: #0F2A3D; }
        .maps-embed { position: relative; width: 100%; aspect-ratio: 16 / 9; }
        .maps-embed iframe { position: absolute; inset: 0; width: 100% !important; height: 100% !important; border: 0; }
        img, svg, video { max-width: 100%; height: auto; }
        .fade-up { animation: fadeUp .7s ease both; }
        @keyframes fadeUp { from { opacity:0; transform: translateY(16px);} to {opacity:1; transform:none;} }
        .no-scrollbar::-webkit-scrollbar{display:none}.no-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
    </style>
</head>
<body class="text-ink-800 antialiased">`;

function navbar(pengaturan) {
  return `<header x-data="{ open: false }" class="sticky top-0 z-50 bg-paper/90 backdrop-blur border-b border-ink-100">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="index.html" class="flex items-center gap-3">
                ${pengaturan.logo ? `<img src="${pengaturan.logo}" alt="Logo" class="h-11 w-11 rounded-full object-cover">` : `<img src="eagle.jpg" alt="Logo" class="h-11 w-11 rounded-full object-cover">`}
                <div class="leading-tight">
                    <p class="font-display text-lg text-ink-800">${pengaturan.singkatan || 'Sekolah Kita'}</p>
                    <p class="text-[11px] tracking-widest uppercase text-ink-600/70">Berprestasi &amp; Berkarakter</p>
                </div>
            </a>
            <nav class="hidden lg:flex items-center gap-8 text-sm font-medium text-ink-700">
                <a href="index.html" class="hover:text-gold-600 transition" id="nav-home">Beranda</a>
                <a href="profil.html" class="hover:text-gold-600 transition" id="nav-profil">Profil Sekolah</a>
                <a href="berita.html" class="hover:text-gold-600 transition" id="nav-berita">Berita</a>
                <a href="pengumuman.html" class="hover:text-gold-600 transition" id="nav-pengumuman">Pengumuman</a>
                <a href="galeri.html" class="hover:text-gold-600 transition" id="nav-galeri">Galeri</a>
                <a href="guru.html" class="hover:text-gold-600 transition" id="nav-guru">Guru &amp; Staff</a>
                <a href="kontak.html" class="ml-2 inline-flex items-center rounded-full bg-ink-700 text-white px-5 py-2.5 hover:bg-gold-600 transition">Kontak</a>
            </nav>
            <button @click="open = !open" class="lg:hidden p-2 text-ink-700" aria-label="Buka menu">
                <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <nav x-show="open" x-cloak class="lg:hidden pb-5 flex flex-col gap-4 text-sm font-medium text-ink-700">
            <a href="index.html">Beranda</a>
            <a href="profil.html">Profil Sekolah</a>
            <a href="berita.html">Berita</a>
            <a href="pengumuman.html">Pengumuman</a>
            <a href="galeri.html">Galeri</a>
            <a href="guru.html">Guru &amp; Staff</a>
            <a href="kontak.html" class="inline-flex w-fit items-center rounded-full bg-ink-700 text-white px-5 py-2.5">Kontak</a>
        </nav>
    </div>
</header>`;
}

function footer(pengaturan) {
  const year = new Date().getFullYear();
  return `<footer class="bg-ink-800 text-ink-100 mt-24">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-16 grid gap-10 md:grid-cols-4">
        <div class="md:col-span-2">
            <p class="font-display text-2xl text-white">${pengaturan.nama_sekolah || 'Nama Sekolah'}</p>
            <p class="mt-3 text-sm text-ink-200 max-w-sm leading-relaxed">${pengaturan.deskripsi_singkat || ''}</p>
            <div class="mt-5 flex gap-3">
                ${pengaturan.facebook ? `<a href="${pengaturan.facebook}" target="_blank" class="h-9 w-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold-500 hover:text-ink-800 transition text-sm">FB</a>` : ''}
                ${pengaturan.instagram ? `<a href="${pengaturan.instagram}" target="_blank" class="h-9 w-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold-500 hover:text-ink-800 transition text-sm">IG</a>` : ''}
                ${pengaturan.youtube ? `<a href="${pengaturan.youtube}" target="_blank" class="h-9 w-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-gold-500 hover:text-ink-800 transition text-sm">YT</a>` : ''}
            </div>
        </div>
        <div>
            <p class="text-xs uppercase tracking-widest text-gold-500 mb-4">Navigasi</p>
            <ul class="space-y-2 text-sm text-ink-200">
                <li><a href="profil.html" class="hover:text-white">Profil Sekolah</a></li>
                <li><a href="berita.html" class="hover:text-white">Berita</a></li>
                <li><a href="pengumuman.html" class="hover:text-white">Pengumuman</a></li>
                <li><a href="galeri.html" class="hover:text-white">Galeri</a></li>
                <li><a href="guru.html" class="hover:text-white">Guru &amp; Staff</a></li>
            </ul>
        </div>
        <div>
            <p class="text-xs uppercase tracking-widest text-gold-500 mb-4">Kontak</p>
            <ul class="space-y-2 text-sm text-ink-200 leading-relaxed">
                <li>${pengaturan.alamat || ''}</li>
                <li>${pengaturan.telepon || ''}</li>
                <li>${pengaturan.email || ''}</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10 py-5 text-center text-xs text-ink-300">
        &copy; ${year} ${pengaturan.nama_sekolah || 'Sekolah'}. Seluruh hak cipta dilindungi.
    </div>
</footer>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body></html>`;
}

function generateIndex(pengaturan, berita, pengumuman, galeri, guru) {
  const years = pengaturan.tahun_berdiri ? new Date().getFullYear() - pengaturan.tahun_berdiri : 0;
  let html = HEAD.replace('{{TITLE}}', `${pengaturan.nama_sekolah} — Beranda`).replace('{{DESCRIPTION}}', pengaturan.deskripsi_singkat || '');
  html += navbar(pengaturan);
  html += `<main>`;

  // Hero
  html += `<section class="relative overflow-hidden bg-ink-800">
    <div class="absolute inset-0 opacity-[0.07]" style="background-image: radial-gradient(circle at 20% 20%, white 1px, transparent 1px); background-size: 22px 22px;"></div>
    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-20 lg:py-28 grid lg:grid-cols-5 gap-12 items-center relative">
        <div class="lg:col-span-3 fade-up">
            <span class="inline-flex items-center gap-2 text-gold-400 text-xs tracking-[0.2em] uppercase font-semibold">
                <span class="h-px w-8 bg-gold-400"></span> Sejak ${pengaturan.tahun_berdiri || '—'}
            </span>
            <h1 class="mt-5 font-display text-4xl sm:text-5xl lg:text-6xl text-white leading-[1.08]">
                Membangun Generasi Pemimpin,<br class="hidden sm:block"> <span class="signature-underline text-gold-400">Berwawasan Global, Terampil</span> & Berjiwa Pengusaha.
            </h1>
            <p class="mt-6 text-ink-100/90 text-lg max-w-xl leading-relaxed">${pengaturan.deskripsi_singkat || ''}</p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="profil.html" class="rounded-full bg-gold-500 text-ink-800 font-semibold px-7 py-3.5 hover:bg-gold-400 transition">Kenali Sekolah Kami</a>
                <a href="kontak.html" class="rounded-full border border-white/30 text-white px-7 py-3.5 hover:bg-white/10 transition">Hubungi Kami</a>
            </div>
        </div>
        <div class="lg:col-span-2 fade-up" style="animation-delay:.15s">
            <div class="bg-paper rounded-2xl shadow-2xl p-7 rotate-1 hover:rotate-0 transition-transform duration-300">
                <p class="text-xs uppercase tracking-widest text-ink-600/60 mb-4">Ikhtisar Sekolah</p>
                <dl class="divide-y divide-ink-100">
                    <div class="flex items-center justify-between py-3"><dt class="text-ink-700">Siswa Aktif</dt><dd class="font-display text-2xl text-ink-800">${(pengaturan.jumlah_siswa || 0).toLocaleString('id-ID')}+</dd></div>
                    <div class="flex items-center justify-between py-3"><dt class="text-ink-700">Tenaga Pendidik</dt><dd class="font-display text-2xl text-ink-800">${(pengaturan.jumlah_guru || 0).toLocaleString('id-ID')}+</dd></div>
                    <div class="flex items-center justify-between py-3"><dt class="text-ink-700">Prestasi Diraih</dt><dd class="font-display text-2xl text-ink-800">${(pengaturan.jumlah_prestasi || 0).toLocaleString('id-ID')}+</dd></div>
                    <div class="flex items-center justify-between py-3"><dt class="text-ink-700">Tahun Pengalaman</dt><dd class="font-display text-2xl text-ink-800">${years}</dd></div>
                </dl>
            </div>
        </div>
    </div>
</section>`;

  // Pengumuman ticker
  if (pengumuman.length > 0) {
    html += `<div class="bg-gold-500 text-ink-800 overflow-hidden">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-2.5 flex items-center gap-4 text-sm font-medium">
        <span class="shrink-0 uppercase tracking-widest text-xs font-bold bg-ink-800 text-gold-400 px-3 py-1 rounded-full">Pengumuman</span>
        <div class="flex gap-10 overflow-x-auto no-scrollbar whitespace-nowrap">
            ${pengumuman.map(p => `<a href="pengumuman-${p.slug}.html" class="hover:underline">${p.judul}</a>`).join('')}
        </div>
    </div>
</div>`;
  }

  // Berita terbaru
  html += `<section class="max-w-7xl mx-auto px-5 sm:px-8 py-20">
    <div class="flex items-end justify-between mb-10">
        <div>
            <span class="text-xs uppercase tracking-widest text-gold-600 font-semibold">Kabar Terkini</span>
            <h2 class="font-display text-3xl sm:text-4xl text-ink-800 mt-2">Berita &amp; Kegiatan</h2>
        </div>
        <a href="berita.html" class="hidden sm:inline-flex text-sm font-semibold text-ink-700 hover:text-gold-600">Lihat semua berita &rarr;</a>
    </div>
    <div class="grid md:grid-cols-3 gap-8">`;
  const beritaList = berita.filter(b => b.status === 'published').slice(0, 3);
  for (const b of beritaList) {
    const excerpt = truncate(b.konten, 150);
    html += `<a href="berita-${b.slug}.html" class="group block bg-white rounded-2xl overflow-hidden border border-ink-100 hover:shadow-xl transition">
        <div class="aspect-[4/3] bg-ink-100 overflow-hidden">
            ${b.thumbnail ? `<img src="${b.thumbnail}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="${b.judul}">` : `<div class="w-full h-full flex items-center justify-center text-ink-300 font-display text-4xl">Aa</div>`}
        </div>
        <div class="p-6">
            ${b.kategori_id ? `<span class="text-xs uppercase tracking-wider text-gold-600 font-semibold">${getKategori(b.kategori_id, readJSON('kategori.json'))}</span>` : ''}
            <h3 class="mt-2 font-display text-xl text-ink-800 leading-snug group-hover:text-gold-600 transition">${b.judul}</h3>
            <p class="mt-2 text-sm text-ink-600 line-clamp-2">${excerpt}</p>
            <p class="mt-4 text-xs text-ink-400">${formatDate(b.tanggal_publish)}</p>
        </div>
    </a>`;
  }
  html += `</div></section>`;

  // Galeri preview
  if (galeri.length > 0) {
    html += `<section class="bg-ink-700 py-20">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Dokumentasi</span>
                <h2 class="font-display text-3xl sm:text-4xl text-white mt-2">Momen di Sekolah Kami</h2>
            </div>
            <a href="galeri.html" class="hidden sm:inline-flex text-sm font-semibold text-white hover:text-gold-400">Lihat galeri lengkap &rarr;</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            ${galeri.slice(0, 8).map(g => `<div class="aspect-square rounded-xl overflow-hidden bg-white/10"><img src="${g.gambar}" class="w-full h-full object-cover hover:scale-110 transition duration-500" alt="${g.judul}"></div>`).join('')}
        </div>
    </div>
</section>`;
  }

  // Guru unggulan
  const guruFeatured = guru.sort((a, b) => a.urutan - b.urutan).slice(0, 4);
  if (guruFeatured.length > 0) {
    html += `<section class="max-w-7xl mx-auto px-5 sm:px-8 py-20">
    <div class="mb-10">
        <span class="text-xs uppercase tracking-widest text-gold-600 font-semibold">Tim Pendidik</span>
        <h2 class="font-display text-3xl sm:text-4xl text-ink-800 mt-2">Dibimbing Guru Terbaik</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
        ${guruFeatured.map(g => `<div class="text-center">
            <div class="aspect-square rounded-2xl overflow-hidden bg-ink-100 mb-4">
                ${g.foto ? `<img src="${g.foto}" class="w-full h-full object-cover" alt="${g.nama}">` : `<div class="w-full h-full flex items-center justify-center text-ink-300 font-display text-3xl">${g.nama[0]}</div>`}
            </div>
            <p class="font-display text-lg text-ink-800">${g.nama}</p>
            <p class="text-sm text-gold-600">${g.jabatan}</p>
        </div>`).join('')}
    </div>
</section>`;
  }

  // CTA
  html += `<section class="max-w-7xl mx-auto px-5 sm:px-8 pb-24">
    <div class="rounded-3xl bg-gold-500 px-8 py-14 sm:px-16 text-center">
        <h2 class="font-display text-3xl sm:text-4xl text-ink-800">Tertarik Bergabung dengan Kami?</h2>
        <p class="mt-3 text-ink-800/80 max-w-xl mx-auto">Tim kami siap membantu menjawab pertanyaan seputar pendaftaran dan program sekolah.</p>
        <a href="kontak.html" class="mt-7 inline-flex rounded-full bg-ink-800 text-white px-8 py-3.5 font-semibold hover:bg-ink-700 transition">Hubungi Kami Sekarang</a>
    </div>
</section>`;

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, 'index.html'), html);
  console.log('Generated: index.html');
}

function generateProfil(pengaturan) {
  let html = HEAD.replace('{{TITLE}}', `Profil Sekolah — ${pengaturan.nama_sekolah}`).replace('{{DESCRIPTION}}', pengaturan.deskripsi_singkat || '');
  html += navbar(pengaturan);
  html += `<main>`;

  html += `<section class="bg-ink-800 py-16">
    <div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Tentang Kami</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Profil ${pengaturan.nama_sekolah}</h1>
    </div>
</section>`;

  const misiList = (pengaturan.misi || '').split('\n').filter(m => m.trim()).map(m => `<li>${m.trim()}</li>`).join('');

  html += `<section class="max-w-5xl mx-auto px-5 sm:px-8 py-16 space-y-16">
    <div class="grid md:grid-cols-2 gap-10">
        <div class="bg-white rounded-2xl p-8 border border-ink-100">
            <h2 class="font-display text-2xl text-ink-800 mb-3">Visi</h2>
            <p class="text-ink-600 leading-relaxed">${pengaturan.visi || ''}</p>
        </div>
        <div class="bg-white rounded-2xl p-8 border border-ink-100">
            <h2 class="font-display text-2xl text-ink-800 mb-3">Misi</h2>
            <ul class="text-ink-600 leading-relaxed space-y-2 list-disc list-inside">${misiList}</ul>
        </div>
    </div>
    <div>
        <h2 class="font-display text-3xl text-ink-800 mb-4">Sejarah Singkat</h2>
        <p class="text-ink-600 leading-relaxed whitespace-pre-line">${pengaturan.sejarah || ''}</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
        <div class="bg-ink-50 rounded-2xl py-8"><p class="font-display text-3xl text-ink-800">${(pengaturan.jumlah_siswa || 0).toLocaleString('id-ID')}+</p><p class="text-sm text-ink-600 mt-1">Siswa Aktif</p></div>
        <div class="bg-ink-50 rounded-2xl py-8"><p class="font-display text-3xl text-ink-800">${(pengaturan.jumlah_guru || 0).toLocaleString('id-ID')}+</p><p class="text-sm text-ink-600 mt-1">Guru &amp; Staff</p></div>
        <div class="bg-ink-50 rounded-2xl py-8"><p class="font-display text-3xl text-ink-800">${(pengaturan.jumlah_prestasi || 0).toLocaleString('id-ID')}+</p><p class="text-sm text-ink-600 mt-1">Prestasi</p></div>
        <div class="bg-ink-50 rounded-2xl py-8"><p class="font-display text-3xl text-ink-800">${pengaturan.tahun_berdiri || ''}</p><p class="text-sm text-ink-600 mt-1">Tahun Berdiri</p></div>
    </div>
    ${pengaturan.maps_embed ? `<div class="rounded-2xl overflow-hidden border border-ink-100 maps-embed">${pengaturan.maps_embed}</div>` : ''}
</section>`;

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, 'profil.html'), html);
  console.log('Generated: profil.html');
}

function generateBeritaIndex(pengaturan, berita, kategoris) {
  let html = HEAD.replace('{{TITLE}}', `Berita — ${pengaturan.nama_sekolah}`).replace('{{DESCRIPTION}}', 'Berita dan kegiatan terkini dari sekolah');
  html += navbar(pengaturan);
  html += `<main>`;

  html += `<section class="bg-ink-800 py-16"><div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Kabar Sekolah</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Berita &amp; Kegiatan</h1>
    </div></section>`;

  html += `<section class="max-w-7xl mx-auto px-5 sm:px-8 py-16"><div class="grid md:grid-cols-3 gap-8">`;
  const publishedBerita = berita.filter(b => b.status === 'published');
  for (const b of publishedBerita) {
    const excerpt = truncate(b.konten, 150);
    html += `<a href="berita-${b.slug}.html" class="group block bg-white rounded-2xl overflow-hidden border border-ink-100 hover:shadow-xl transition">
        <div class="aspect-[4/3] bg-ink-100 overflow-hidden">
            ${b.thumbnail ? `<img src="${b.thumbnail}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="${b.judul}">` : `<div class="w-full h-full flex items-center justify-center text-ink-300 font-display text-4xl">Aa</div>`}
        </div>
        <div class="p-6">
            ${b.kategori_id ? `<span class="text-xs uppercase tracking-wider text-gold-600 font-semibold">${getKategori(b.kategori_id, kategoris)}</span>` : ''}
            <h3 class="mt-2 font-display text-xl text-ink-800 leading-snug group-hover:text-gold-600 transition">${b.judul}</h3>
            <p class="mt-2 text-sm text-ink-600 line-clamp-2">${excerpt}</p>
            <p class="mt-4 text-xs text-ink-400">${formatDate(b.tanggal_publish)} &middot; ${b.views} dilihat</p>
        </div>
    </a>`;
  }
  html += `</div></section>`;

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, 'berita.html'), html);
  console.log('Generated: berita.html');
}

function generateBeritaShow(pengaturan, beritaItem, related, kategoris) {
  const excerpt = truncate(beritaItem.konten, 150);
  let html = HEAD.replace('{{TITLE}}', `${beritaItem.judul} — ${pengaturan.nama_sekolah}`).replace('{{DESCRIPTION}}', excerpt);
  html += navbar(pengaturan);
  html += `<main>`;

  html += `<article class="max-w-3xl mx-auto px-5 sm:px-8 py-16">
    <a href="berita.html" class="text-sm text-gold-600 font-semibold">&larr; Kembali ke Berita</a>
    ${beritaItem.kategori_id ? `<span class="inline-block mt-6 text-xs uppercase tracking-wider text-gold-600 font-semibold">${getKategori(beritaItem.kategori_id, kategoris)}</span>` : ''}
    <h1 class="font-display text-3xl sm:text-4xl text-ink-800 mt-3 leading-tight">${beritaItem.judul}</h1>
    <p class="mt-3 text-sm text-ink-400">${formatDate(beritaItem.tanggal_publish)}${beritaItem.penulis ? ` &middot; oleh ${beritaItem.penulis}` : ''} &middot; ${beritaItem.views} dilihat</p>
    ${beritaItem.thumbnail ? `<div class="mt-8 rounded-2xl overflow-hidden"><img src="${beritaItem.thumbnail}" class="w-full object-cover" alt="${beritaItem.judul}"></div>` : ''}
    <div class="mt-8 prose prose-ink max-w-none text-ink-700 leading-relaxed whitespace-pre-line">${linkify(beritaItem.konten)}</div>
</article>`;

  if (related.length > 0) {
    html += `<section class="bg-ink-50 py-16"><div class="max-w-5xl mx-auto px-5 sm:px-8">
        <h2 class="font-display text-2xl text-ink-800 mb-8">Berita Lainnya</h2>
        <div class="grid md:grid-cols-3 gap-6">
            ${related.map(r => `<a href="berita-${r.slug}.html" class="block bg-white rounded-xl p-5 border border-ink-100 hover:shadow-lg transition">
                <h3 class="font-display text-lg text-ink-800">${r.judul}</h3>
                <p class="mt-2 text-xs text-ink-400">${formatDate(r.tanggal_publish)}</p>
            </a>`).join('')}
        </div>
    </div></section>`;
  }

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, `berita-${beritaItem.slug}.html`), html);
  console.log(`Generated: berita-${beritaItem.slug}.html`);
}

function generatePengumumanIndex(pengaturan, pengumumanList) {
  let html = HEAD.replace('{{TITLE}}', `Pengumuman — ${pengaturan.nama_sekolah}`).replace('{{DESCRIPTION}}', 'Pengumuman resmi dari sekolah');
  html += navbar(pengaturan);
  html += `<main>`;

  html += `<section class="bg-ink-800 py-16"><div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Informasi Resmi</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Pengumuman</h1>
    </div></section>`;

  html += `<section class="max-w-3xl mx-auto px-5 sm:px-8 py-16"><div class="space-y-4">`;
  const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  for (const p of pengumumanList.filter(p => p.status === 'published')) {
    const d = new Date(p.tanggal);
    const excerpt = truncate(p.konten, 140);
    html += `<a href="pengumuman-${p.slug}.html" class="flex items-start gap-5 bg-white p-6 rounded-2xl border border-ink-100 hover:shadow-lg transition">
        <div class="shrink-0 w-16 text-center bg-gold-50 rounded-xl py-2">
            <p class="font-display text-xl text-ink-800">${d.getDate()}</p>
            <p class="text-[11px] uppercase text-ink-500">${months[d.getMonth()]} ${d.getFullYear()}</p>
        </div>
        <div>
            <h3 class="font-display text-lg text-ink-800">${p.judul}</h3>
            <p class="mt-1 text-sm text-ink-600 line-clamp-2">${excerpt}</p>
        </div>
    </a>`;
  }
  html += `</div></section>`;

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, 'pengumuman.html'), html);
  console.log('Generated: pengumuman.html');
}

function generatePengumumanShow(pengaturan, item) {
  let html = HEAD.replace('{{TITLE}}', `${item.judul} — ${pengaturan.nama_sekolah}`).replace('{{DESCRIPTION}}', truncate(item.konten, 150));
  html += navbar(pengaturan);
  html += `<main>`;

  html += `<article class="max-w-3xl mx-auto px-5 sm:px-8 py-16">
    <a href="pengumuman.html" class="text-sm text-gold-600 font-semibold">&larr; Kembali ke Pengumuman</a>
    <h1 class="font-display text-3xl sm:text-4xl text-ink-800 mt-6 leading-tight">${item.judul}</h1>
    <p class="mt-3 text-sm text-ink-400">${formatDate(item.tanggal)}</p>
    <div class="mt-8 prose prose-ink max-w-none text-ink-700 leading-relaxed whitespace-pre-line">${linkify(item.konten)}</div>
    ${item.file ? `<a href="${item.file}" target="_blank" class="mt-8 inline-flex items-center gap-2 rounded-full bg-ink-700 text-white px-6 py-3 text-sm font-semibold hover:bg-gold-600 transition">Unduh Lampiran</a>` : ''}
</article>`;

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, `pengumuman-${item.slug}.html`), html);
  console.log(`Generated: pengumuman-${item.slug}.html`);
}

function generateGaleriIndex(pengaturan, galeriList) {
  let html = HEAD.replace('{{TITLE}}', `Galeri — ${pengaturan.nama_sekolah}`).replace('{{DESCRIPTION}}', 'Galeri foto kegiatan sekolah');
  html += navbar(pengaturan);
  html += `<main>`;

  html += `<section class="bg-ink-800 py-16"><div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Dokumentasi</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Galeri Sekolah</h1>
    </div></section>`;

  html += `<section class="max-w-7xl mx-auto px-5 sm:px-8 py-16"><div class="grid grid-cols-2 md:grid-cols-4 gap-5">`;
  for (const g of galeriList) {
    html += `<div class="group relative aspect-square rounded-xl overflow-hidden bg-ink-100">
        <img src="${g.gambar}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="${g.judul}">
        <div class="absolute inset-0 bg-gradient-to-t from-ink-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition flex items-end p-3">
            <div><p class="text-white text-sm font-semibold">${g.judul}</p><p class="text-gold-300 text-xs uppercase tracking-wide">${g.kategori}</p></div>
        </div>
    </div>`;
  }
  html += `</div></section>`;

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, 'galeri.html'), html);
  console.log('Generated: galeri.html');
}

function generateGuruIndex(pengaturan, guruList) {
  let html = HEAD.replace('{{TITLE}}', `Guru & Staff — ${pengaturan.nama_sekolah}`).replace('{{DESCRIPTION}}', 'Daftar guru dan staff sekolah');
  html += navbar(pengaturan);
  html += `<main>`;

  html += `<section class="bg-ink-800 py-16"><div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Tim Kami</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Guru &amp; Staff</h1>
    </div></section>`;

  html += `<section class="max-w-7xl mx-auto px-5 sm:px-8 py-16"><div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">`;
  for (const g of guruList.sort((a, b) => a.urutan - b.urutan)) {
    html += `<div class="text-center">
        <div class="aspect-square rounded-2xl overflow-hidden bg-ink-100 mb-4">
            ${g.foto ? `<img src="${g.foto}" class="w-full h-full object-cover" alt="${g.nama}">` : `<div class="w-full h-full flex items-center justify-center text-ink-300 font-display text-3xl">${g.nama[0]}</div>`}
        </div>
        <p class="font-display text-lg text-ink-800">${g.nama}</p>
        <p class="text-sm text-gold-600">${g.jabatan}</p>
        ${g.mapel && g.mapel !== '-' ? `<p class="text-xs text-ink-500 mt-1">${g.mapel}</p>` : ''}
    </div>`;
  }
  html += `</div></section>`;

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, 'guru.html'), html);
  console.log('Generated: guru.html');
}

function generateKontak(pengaturan) {
  let html = HEAD.replace('{{TITLE}}', `Kontak — ${pengaturan.nama_sekolah}`).replace('{{DESCRIPTION}}', 'Hubungi kami');
  html += navbar(pengaturan);
  html += `<main>`;

  html += `<section class="bg-ink-800 py-16"><div class="max-w-5xl mx-auto px-5 sm:px-8 text-center">
        <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Kami Siap Membantu</span>
        <h1 class="font-display text-4xl sm:text-5xl text-white mt-3">Hubungi Kami</h1>
    </div></section>`;

  html += `<section class="max-w-6xl mx-auto px-5 sm:px-8 py-16 grid lg:grid-cols-5 gap-12">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-ink-100"><p class="text-xs uppercase tracking-widest text-gold-600 font-semibold mb-2">Alamat</p><p class="text-ink-700">${pengaturan.alamat || ''}</p></div>
        <div class="bg-white p-6 rounded-2xl border border-ink-100"><p class="text-xs uppercase tracking-widest text-gold-600 font-semibold mb-2">Telepon</p><p class="text-ink-700">${pengaturan.telepon || ''}</p></div>
        <div class="bg-white p-6 rounded-2xl border border-ink-100"><p class="text-xs uppercase tracking-widest text-gold-600 font-semibold mb-2">Email</p><p class="text-ink-700">${pengaturan.email || ''}</p></div>
        ${pengaturan.maps_embed ? `<div class="rounded-2xl overflow-hidden border border-ink-100 maps-embed">${pengaturan.maps_embed}</div>` : ''}
    </div>
    <div class="lg:col-span-3">
        <div class="bg-white p-8 rounded-2xl border border-ink-100 space-y-5">
            <div><label class="text-sm font-medium text-ink-700">Nama Lengkap</label><input type="text" class="mt-1.5 w-full rounded-xl border border-ink-200 focus:border-gold-500 focus:ring-gold-500 px-4 py-3"></div>
            <div><label class="text-sm font-medium text-ink-700">Email</label><input type="email" class="mt-1.5 w-full rounded-xl border border-ink-200 focus:border-gold-500 focus:ring-gold-500 px-4 py-3"></div>
            <div><label class="text-sm font-medium text-ink-700">Subjek</label><input type="text" class="mt-1.5 w-full rounded-xl border border-ink-200 focus:border-gold-500 focus:ring-gold-500 px-4 py-3"></div>
            <div><label class="text-sm font-medium text-ink-700">Pesan</label><textarea rows="5" class="mt-1.5 w-full rounded-xl border border-ink-200 focus:border-gold-500 focus:ring-gold-500 px-4 py-3"></textarea></div>
            <button type="button" class="rounded-full bg-ink-700 text-white px-8 py-3.5 font-semibold hover:bg-gold-600 transition">Kirim Pesan</button>
        </div>
    </div>
</section>`;

  html += `</main>`;
  html += footer(pengaturan);
  fs.writeFileSync(path.join(DIST_DIR, 'kontak.html'), html);
  console.log('Generated: kontak.html');
}

// BUILD
console.log('Building static site...\n');

const pengaturan = readJSON('pengaturan.json');
const berita = readJSON('berita.json');
const pengumuman = readJSON('pengumuman.json');
const galeri = readJSON('galeri.json');
const guru = readJSON('guru.json');
const kategoris = readJSON('kategori.json');

generateIndex(pengaturan, berita, pengumuman, galeri, guru);
generateProfil(pengaturan);
generateBeritaIndex(pengaturan, berita, kategoris);
for (const b of berita.filter(b => b.status === 'published')) {
  const related = berita.filter(r => r.id !== b.id && r.status === 'published').slice(0, 3);
  generateBeritaShow(pengaturan, b, related, kategoris);
}
generatePengumumanIndex(pengaturan, pengumuman);
for (const p of pengumuman.filter(p => p.status === 'published')) {
  generatePengumumanShow(pengaturan, p);
}
generateGaleriIndex(pengaturan, galeri);
generateGuruIndex(pengaturan, guru);
generateKontak(pengaturan);

console.log('\nBuild complete!');
