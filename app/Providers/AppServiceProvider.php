<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Pengaturan;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pastikan format tanggal (translatedFormat) tampil dalam Bahasa Indonesia
        \Carbon\Carbon::setLocale(config('app.locale'));

        // Bagikan data pengaturan situs ke SEMUA view (layout maupun view anak yang
        // melakukan @extends), supaya nama sekolah/logo selalu tersedia di title, dsb.
        // Di-cache secara statis per request agar tidak query berulang kali.
        View::composer('*', function ($view) {
            static $pengaturan = null;
            $pengaturan ??= Pengaturan::current();
            $view->with('pengaturanGlobal', $pengaturan);
        });
    }
}
