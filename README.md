# Buku Tamu BKPSDM

Buku Tamu BKPSDM adalah aplikasi berbasis web yang dirancang untuk membantu dalam pengelolaan kebutuhan administrasi karyawan di lingkungan Pemerintah Kabupaten Bantul. Aplikasi ini mempermudah pencatatan dan pengelolaan data tamu serta berbagai keperluan administrasi lainnya.

## 🚀 Fitur Utama 

- **Pencatatan Data Tamu**: Memungkinkan pengguna untuk mencatat data tamu secara efektif dan efisien.
- **Pengelolaan Informasi**: Admin dapat mengakses dan mengelola informasi tamu yang sudah masuk.
- **Sistem Login Admin**: Admin memiliki akses khusus dengan sistem login untuk mengelola aplikasi.
- **Status Kehadiran**: Fitur untuk mengubah status kehadiran atau kebutuhan administrasi lainnya.
- **Pengaturan Admin**: Admin superuser dapat menambah dan mengedit informasi admin lainnya.

## 💻 Teknologi yang Digunakan
- **Frontend**:HTML,CSS,Javascript,AdminLTE
- **Backend**:PHP(Laravel 11)
- **Database**:MySQL
- **Package**:
    - **Axios**
    - **Bootstrap**
    - **Laravel**
    - **Popper.js**
    - **Vite**

## 📋 Prasyarat
Sebelum memulai, pastikan telah terinstall:
- **PHP >= 8.1**
- **Composer**
- **MySQL**
- **Git**
- **Docker**

## 🔧 Instalasi & Penggunaan

1. **Mengakses Website Buku Tamu**  
   ```
    git clone https://github.com/Thiraf/BukuTamuBKPSDM.git
    cd BukuTamuBKPSDM
    ```

2. **Install dependencies**  
   ```
   composer install
   ```

3. **Setup environment**  
    ```
    cp .env.example .env
    php artisan key:generate
    ```

4. **Konfigurasi database di file .env**  
   ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=bkpsdm
    DB_USERNAME=root
    DB_PASSWORD=
    ```
5. **Jalankan migration dan seeder**
    ```
    php artisan migrate
    php artisan db:seed
    ```

6. **Jalankan Server**
    ```
    php artisan serve
    ```
    
## 🛜 Setup Docker

1. **Pastikan sudah menginstall docker compose**
    ```
    sudo apt install docker-ce docker-ce-cli containerd.io
    ```

2. **Menjalankan Docker Compose**
    ```
    docker-compose up -d
    ```
3. **Verifikasi Layanan**
    ```
    docker-compose ps
    ```
    

## 🔍 Fitur Detail 

1. **Update Status**
    - Mengubah Status data pengisi buku tamu
    - Menampilkan perubahan pada detail updatenya
    
2. **Filter Data**
    -  Menyaring data menurut parameter tanggal,bulan,tahun,jam, dan status
    
3. **Search data**
    - Mencari data berdasarkan semua parameter

4. **Create Admin**
    - Membuat admin ada 2 tipe role : Admin dan Superadmin
    - Menghapus data admin
    - Mengedit data admin 

## 🔐 Validasi & Batasan 
1. **Captcha**
    - Input pola captcha harus sesuai dengan yang ditampilkan untuk mengakses aplikasi

2. **Admin**
    - Hanya role Super Admin saja yang bisa mengakses fitur Create Admin
    - Hanya ID Admin 1 saja yang dapat mengedit dirinya sendiri
    - ID Admin 1 tidak bisa dihapus




