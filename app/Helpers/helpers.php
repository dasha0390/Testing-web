<?php

use Illuminate\Support\HtmlString;

if (!function_exists('linkify')) {
    /**
     * Ubah URL (http/https/www) di dalam teks menjadi tautan yang bisa diklik.
     * Teks tetap di-escape dulu agar aman dari XSS, lalu hanya URL yang diubah
     * menjadi tag <a> buatan kita sendiri.
     */
    function linkify(?string $text): string
    {
        if (empty($text)) {
            return '';
        }

        $escaped = htmlspecialchars($text, ENT_HTML5, 'UTF-8', false);

        $pattern = '~(https?://[^\s<]+|www\.[^\s<]+)~i';

        $escaped = preg_replace_callback($pattern, function ($matches) {
            $url = $matches[0];
            $href = preg_match('/^https?:\/\//i', $url) ? $url : 'https://' . $url;

            return '<a href="' . $href . '" target="_blank" rel="noopener noreferrer" '
                . 'class="text-gold-600 underline decoration-gold-400 hover:text-gold-500 break-words">'
                . $url . '</a>';
        }, $escaped);

        return $escaped;
    }
}
