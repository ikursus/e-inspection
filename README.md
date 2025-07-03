## About

Demo App - Sistem Inspection

Cara pasang

1) Download sebagai .zip

2) Extract dalam folder local web server. Contoh:
`C:\laragon\www`

3) Buka terminal dan masuk ke folder projek. Contoh:
`cd projek` (akan jadi C:\laragon\www\projek)

4) jalankan arahan di terminal:
`composer update`

5) Semak konfigurasi database di fail `.env`

6) Tetapkan connection database. Jika guna MySQL, semak port default 3306

7) Jalankan arahan di terminal:
`php artisan migrate:fresh --seed` 

8) Jika guna Laragon, pastikan sudah reload Apache untuk vhost creation bagi alamat projek.test

9) Akses ke projek menerusi link:
`projek.test`
dan
`localhost/projek/public`

