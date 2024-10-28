# Buku Tamu BKPSDM

**Buku Tamu BKPSDM** adalah aplikasi berbasis web yang dikembangkan untuk mempermudah manajemen kebutuhan karyawan di lingkungan Pemerintah Kabupaten Bantul. Aplikasi ini memungkinkan pengguna untuk mengisi buku tamu secara digital dan membantu admin dalam mengelola data tamu yang berkunjung.

## Fitur

### Untuk Pengguna
1. **Pengisian Data Tamu**:
   - Pengguna dapat memasukkan NIK dan mengisi Captcha.
   - Jika NIK pengguna belum terdaftar, form akan kosong. Jika sudah terdaftar, form akan terisi otomatis.
   - Setelah mengisi tujuan kunjungan, pengguna dapat menyimpan data, dan aplikasi akan menampilkan notifikasi bahwa data telah berhasil disimpan.

### Untuk Admin
1. **Login Admin**:
   - Admin dapat mengakses halaman login dengan menambahkan `/login` pada URL aplikasi.
   - Login menggunakan username, password, dan Captcha.

2. **Dashboard Admin**:
   - Setelah login, admin akan diarahkan ke dashboard yang menampilkan data tamu.
   - Admin dapat mengubah status data tamu melalui dropdown dan menyimpan perubahan tersebut.

3. **Manajemen Admin**:
   - Admin dengan peran super admin dapat menambahkan admin baru melalui fitur **Create Admin**.
   - Fitur edit admin memungkinkan perubahan data admin yang sudah ada.
   - Super admin juga memiliki kemampuan untuk menghapus admin selain dirinya.

4. **Logout Admin**:
   - Admin dapat keluar dari aplikasi dengan menekan logo personal di pojok kanan atas dan memilih **Sign Out**.

## Panduan Penggunaan

### Pengguna
1. Buka halaman Buku Tamu BKPSDM.
2. Masukkan NIK dan lengkapi Captcha.
3. Klik **Next** untuk melanjutkan.
   - Jika NIK belum terdaftar, form akan kosong.
   - Jika NIK sudah terdaftar, form akan terisi otomatis.
4. Isi tujuan kunjungan sesuai kebutuhan, lalu klik **Simpan**. Sistem akan menampilkan notifikasi bahwa data berhasil disimpan.

### Admin
1. Buka halaman login admin dengan menambahkan `/login` pada URL.
2. Masukkan username, password, dan Captcha, lalu klik **Sign In**.
3. Setelah login, akan diarahkan ke dashboard untuk melihat data tamu.
4. Untuk mengubah status data tamu, klik bagian status pada data yang diinginkan, pilih status baru pada dropdown, lalu klik **Simpan**.
5. Untuk menambahkan admin baru, klik **Create Admin**, lalu isi form yang muncul dan klik **Create Admin** untuk menyimpan.
6. Untuk mengedit admin, pilih admin yang ingin diubah, klik **Edit**, ubah data, dan klik **Update Admin**.
7. Untuk logout, klik logo personal di pojok kanan atas dan pilih **Sign Out**.

## Teknologi yang Digunakan
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** Laravel (PHP)
- **Database:** MySQL

## Terminal

Untuk menginstal dan menjalankan aplikasi ini di lingkungan lokal, ikuti langkah-langkah berikut:

### 1. Clone Repository
Clone repository ini ke komputer lokal Anda:
```bash
git clone https://github.com/username/repository-name.git
cd repository-name
