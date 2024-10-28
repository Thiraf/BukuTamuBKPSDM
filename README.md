# Buku Tamu BKPSDM

Buku Tamu BKPSDM adalah aplikasi berbasis web yang dirancang untuk membantu dalam pengelolaan kebutuhan administrasi karyawan di lingkungan Pemerintah Kabupaten Bantul. Aplikasi ini mempermudah pencatatan dan pengelolaan data tamu serta berbagai keperluan administrasi lainnya.

## Fitur Utama

- **Pencatatan Data Tamu**: Memungkinkan pengguna untuk mencatat data tamu secara efektif dan efisien.
- **Pengelolaan Informasi**: Admin dapat mengakses dan mengelola informasi tamu yang sudah masuk.
- **Sistem Login Admin**: Admin memiliki akses khusus dengan sistem login untuk mengelola aplikasi.
- **Status Kehadiran**: Fitur untuk mengubah status kehadiran atau kebutuhan administrasi lainnya.
- **Pengaturan Admin**: Admin superuser dapat menambah dan mengedit informasi admin lainnya.

## Cara Penggunaan

### A. Penggunaan dari Perspektif Pengguna Umum

1. **Mengakses Website Buku Tamu**  
   Buka aplikasi Buku Tamu BKPSDM melalui browser Anda.

2. **Mengisi Data Pengguna**  
   Masukkan **NIK** Anda dan lengkapi Captcha. Jika Captcha yang dimasukkan tidak sesuai, akan muncul notifikasi error.

3. **Validasi NIK**  
   Klik tombol **Next**:
   - Jika **NIK tidak terdaftar**, form akan kosong.
   - Jika **NIK terdaftar**, data akan terisi otomatis sesuai informasi yang sudah ada di sistem.

4. **Mengisi Tujuan Informasi**  
   Setelah validasi, masukkan tujuan informasi yang diperlukan, kemudian klik **Simpan**. Anda akan diarahkan kembali ke halaman awal dengan notifikasi bahwa data berhasil disimpan.

### B. Akses ke Dashboard Admin

1. **Login Admin**  
   Untuk masuk sebagai admin, tambahkan `/login` pada URL, lalu masukkan **username**, **password**, dan **Captcha** untuk masuk.

2. **Dashboard Admin**  
   Setelah login, Anda akan diarahkan ke halaman dashboard yang memuat data tamu dan fungsi administrasi.

### C. Mengubah Status pada Dashboard

1. **Memilih Status**  
   Pilih data tamu yang ingin diubah statusnya, lalu klik pada bagian **Status**.

2. **Mengubah Status**  
   Akan muncul jendela dengan dropdown untuk memilih status baru. Pilih status yang diinginkan, kemudian klik **Simpan**.

### D. Menambah Admin Baru

1. **Akses Menu Create Admin**  
   Pilih menu **Create Admin** dari dashboard.

2. **Mengisi Formulir Admin Baru**  
   Isi form untuk menambahkan admin baru, lalu klik **Create Admin**. Admin baru akan segera tersedia dalam sistem.

### E. Mengedit Admin yang Sudah Ada

1. **Memilih Admin yang Ingin Diedit**  
   Pilih admin yang ingin diubah datanya, lalu klik tombol **Edit**.

2. **Memperbarui Data Admin**  
   Ubah data yang diperlukan dan klik **Update Admin** untuk menyimpan perubahan.

### F. Logout Admin

1. **Logout**  
   Untuk keluar dari aplikasi, klik ikon profil di pojok kanan atas, lalu pilih **Sign Out**.

---

Aplikasi ini dikembangkan untuk mempermudah proses administrasi dan pencatatan data tamu di lingkungan BKPSDM, membantu memastikan kelancaran operasional dan keteraturan administrasi di Pemerintah Kabupaten Bantul.
