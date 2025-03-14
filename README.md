# Buku Tamu BKPSDM

Buku Tamu BKPSDM adalah aplikasi berbasis web yang dirancang untuk membantu dalam pengelolaan kebutuhan administrasi karyawan di lingkungan Pemerintah Kabupaten Bantul. Aplikasi ini mempermudah pencatatan dan pengelolaan data tamu serta berbagai keperluan administrasi lainnya.

## 🚀 Fitur Utama 

- **Pencatatan Data Tamu**: Memungkinkan pengguna untuk mencatat data tamu secara efektif dan efisien.
- **Pengelolaan Informasi**: Admin dapat mengakses dan mengelola informasi tamu yang sudah masuk.
- **Sistem Login Admin**: Admin memiliki akses khusus dengan sistem login untuk mengelola aplikasi.
- **Status Kehadiran**: Fitur untuk mengubah status kehadiran atau kebutuhan administrasi lainnya.
- **Pengaturan Admin**: Admin superuser dapat menambah dan mengedit informasi admin lainnya.

## 💻 Teknologi yang Digunakan
- **Frontend**:HTML, CSS, Javascript, AdminLTE
- **Backend**:PHP (Laravel 11)
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

1. **Clone Repository**  
   ```
    git clone https://github.com/Thiraf/BukuTamuBKPSDM.git
    cd BukuTamuBKPSDM
    ```

2. **Install dependencies**  
   ```
   composer install
   ```
    
## 🛜 Setup Docker

1. **Pastikan sudah menginstall docker compose**
    ```
    sudo apt install docker-ce docker-ce-cli containerd.io
    ```

2. **Menjalankan Docker Compose**
    ```
    docker-compose up --build -d
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

5. **History**
    - Mengecek siapa yang melakukan perubahan status

## 🔐 Validasi & Batasan 
1. **Captcha**
    - Input pola captcha harus sesuai dengan yang ditampilkan untuk mengakses aplikasi

2. **Admin**
    - Hanya role Super Admin saja yang bisa mengakses fitur Create Admin
    - Hanya ID Admin 1 saja yang dapat mengedit dirinya sendiri
    - ID Admin 1 tidak bisa dihapus




