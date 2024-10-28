Buku Tamu BKPSDM
Buku Tamu BKPSDM adalah aplikasi berbasis web yang dirancang untuk membantu dalam pengelolaan kebutuhan administrasi karyawan di lingkungan Pemerintah Kabupaten Bantul. Aplikasi ini mempermudah pencatatan dan pengelolaan data tamu serta berbagai keperluan administrasi lainnya.

Fitur Utama
Pencatatan Data Tamu
Memungkinkan pengguna untuk mencatat informasi tamu dengan mudah dan sistematis.

Validasi NIK
Menggunakan NIK sebagai identifikasi, dengan validasi otomatis yang memastikan data tamu sesuai dengan database pegawai.

Dashboard Admin
Menyediakan dashboard untuk admin dengan fitur manajemen data, termasuk pengaturan status data dan notifikasi untuk setiap perubahan.

Manajemen Akun Admin
Fitur untuk menambah, mengedit, dan menghapus akun admin dengan akses yang disesuaikan.

Keamanan Login
Menggunakan sistem captcha dan autentikasi untuk memastikan keamanan akses ke dashboard admin.

Cara Penggunaan
A. Sebagai Pengguna
Buka aplikasi Buku Tamu BKPSDM melalui browser.
Masukkan NIK dan sesuaikan Captcha yang ditampilkan.
Jika NIK terdaftar, data pengguna akan otomatis terisi; jika tidak, pengguna dapat mengisi form manual.
Pilih Tujuan Informasi sesuai kebutuhan, lalu klik Simpan.
Setelah data tersimpan, pengguna akan diarahkan kembali ke halaman awal dengan notifikasi bahwa data berhasil disimpan.

B. Sebagai Admin
Masuk ke dashboard admin dengan mengakses /login pada URL aplikasi.
Masukkan username, password, dan Captcha untuk masuk.
Setelah login, admin akan diarahkan ke halaman dashboard yang memuat data dan fitur manajemen aplikasi.
Admin dapat mengubah status data, menambah atau mengedit akun admin, dan melihat notifikasi perubahan data.

C. Mengelola Akun Admin
Untuk menambah akun admin baru, pilih menu Create Admin, isi data yang diperlukan, dan klik Create Admin.
Untuk mengedit akun admin, pilih akun yang ingin diubah, lakukan perubahan yang diperlukan, dan klik Update Admin.
Admin dapat logout dengan mengklik ikon profil di pojok kanan atas dan memilih Sign Out.
Teknologi yang Digunakan
Frontend: HTML, CSS, JavaScript (Bootstrap)
Backend: PHP (Laravel Framework)
Database: MySQL
Instalasi
Clone repository ini ke dalam direktori lokal:
bash
Copy code

git clone https://github.com/username/buku-tamu-bkpsdm.git
Masuk ke direktori project dan instal dependensi:
bash
Copy code
cd buku-tamu-bkpsdm
composer install
Konfigurasi file .env untuk koneksi database dan pengaturan lainnya.
Jalankan migrasi database:
bash
Copy code
php artisan migrate
Jalankan server lokal:
bash
Copy code
php artisan serve
