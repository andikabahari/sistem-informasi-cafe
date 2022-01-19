# Sistem Informasi Cafe

## Instalasi

Ikuti langkah berikut ini untuk melakukan instalasi aplikasi.

### Membuat database

Silakan buat database baru untuk aplikasi anda.

### Konfigurasi `.env`

Salin semua isi dari `.env.example` lalu simpan isinya di file baru bernama `.env` yang harus anda buat sendiri. Setelah itu, silakan isi konfigurasi database, mail, dll. sesuai dengan kebutuhan anda di file `.env`.

### Migration

Jalankan perintah berikut untuk melakukan migration.

```
php artisan migrate --path='database\migrations\2022_01_11_172929_create_pengguna_table.php'
php artisan migrate --path='database\migrations\2022_01_11_172930_create_menu_table.php'
php artisan migrate --path='database\migrations\2022_01_11_173052_create_pesanan_table.php'
php artisan migrate --path='database\migrations\2022_01_11_173856_create_detail_pesanan_table.php'
php artisan migrate --path='database\migrations\2022_01_11_174438_create_pembayaran_table.php'
```

### Seeding

Jalankan perintah berikut untuk melakukan database seeding.

```
php artisan db:seed
```

### Storage link (hanya untuk branch `main`)

Jalankan perintah berikut untuk mengaktifkan symbolic link terhadap folder storage.

```
php artisan storage:link
```

### Application key

Jalankan perintah berikut untuk mendapat application key.

```
php artisan key:generate
```

### Menjalankan server

Jalankan perintah berikut untuk menjalankan server.

```
php artisan serve
```