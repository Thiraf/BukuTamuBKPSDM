<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['2', '3', '4', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'm', 'n', 'p', 'q', 'r', 't', 'u', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'M', 'N', 'P', 'Q', 'R', 'T', 'U', 'X', 'Y', 'Z'],
    'default' => [
    'length' => 5, // Kurangi panjang teks agar mudah dibaca
    'width' => 200, // Perbesar ukuran untuk meningkatkan keterbacaan
    'height' => 50, // Perbesar tinggi untuk proporsi yang lebih baik
    'quality' => 500, // Kualitas gambar tinggi
    'math' => false, // Tidak menggunakan soal matematika
    'lines' => 0, // Hilangkan garis noise
    'bgColor' => ['#ffffff'], // Latar belakang putih
    'colors' => ['#000000'], // Warna karakter hitam
    'contrast' => -10, // Mengurangi kontras agar lebih mudah dibaca
    'angle' => 0, // Tidak memutar karakter
    'sharpen' => 0, // Tidak ada efek sharpen
    'blur' => 0, // Tidak ada blur
    'invert' => false, // Tidak membalik warna
    'expire' => null, // Tidak ada waktu kadaluarsa
    'encrypt' => false, // Tanpa enkripsi gambar

],

    'math' => [
        'length' => 9,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'math' => true,
    ],

    'flat' => [
        'length' => 4,
        'width' => 200,
        'height' => 50,
        'quality' => 90,
        'lines' => 0,
        'bgImage' => '#ffffff',
        'bgColor' => ['#ffffff'],
        'fontColors' => ['000000'],
        'contrast' => -5,
    ],

    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
    ],

    'inverse' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => true,
        'contrast' => -5,
    ]
];
