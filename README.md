# Aplikasi Daftar Kegiatan BPSDMP Surabaya

Aplikasi ini adalah sebuah sistem sederhana untuk mengelola daftar kegiatan yang ada di BPSDMP Kominfo Surabaya. Aplikasi ini memiliki dua peran utama, yaitu Admin dan User.

## Fitur

- **Dashboard Admin:**
  - Menambah, mengedit, dan menghapus kegiatan.
  - Melihat daftar kegiatan yang ditambahkan oleh admin.
  - Melihat daftar user.
  
- **Dashboard User:**
  - Melihat daftar kegiatan yang ditambahkan oleh admin.
  - Melihat detail kegiatan.
  - Mengubah profil pengguna (User).

## Teknologi yang Digunakan

- Bahasa Pemrograman: PHP
- Framework: Bootstrap 5
- Database: MySQL

## Cara Penggunaan

1. **Login:**
   - Pengguna harus melakukan login terlebih dahulu menggunakan username dan password.
   - Pengguna dapat memilih peran (Admin/User) saat login.

2. **Dashboard Admin:**
   - Setelah login sebagai admin, Anda dapat menambah, mengedit, atau menghapus kegiatan.
   - Anda juga dapat melihat daftar kegiatan dan daftar user yang terdaftar.

3. **Dashboard User:**
   - Setelah login sebagai user, Anda dapat melihat daftar kegiatan yang ditambahkan oleh admin.
   - Anda dapat mengklik judul kegiatan untuk melihat detailnya.

## Cara Menjalankan Aplikasi

1. Pastikan Anda memiliki server web (seperti XAMPP) yang sudah terinstal di komputer Anda.

2. Clone repositori ini ke dalam direktori web server Anda.

3. Buat database MySQL dengan nama yang sesuai (misalnya `db_kegiatan`).

4. Impor file `database.sql` ke dalam database yang telah Anda buat.

5. Konfigurasi koneksi ke database dengan mengubah informasi di file `koneksi/koneksi.php`.

6. Buka aplikasi melalui web browser dengan mengakses `http://localhost/nama_folder_aplikasi`.

## Kontribusi

Jika Anda ingin berkontribusi untuk meningkatkan aplikasi ini, silakan melakukan pull request dan kami akan dengan senang hati melihatnya.


Dibuat dengan ❤️ oleh dindarosalin
