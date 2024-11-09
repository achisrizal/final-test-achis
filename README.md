## Step by step Pemasangan di Server

### Install Nginx

```sh
sudo apt update
sudo apt install nginx
```

mengecek status nginx :

```sh
sudo systemctl status nginx
```

### Mengaktifkan UFW (Firewall)

```sh
sudo ufw enable
sudo ufw allow 'Nginx HTTP'
```

mengecek status UFW :

```sh
sudo ufw status
```

### Install PHP

```sh
sudo apt install php8.3 php8.3-fpm php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl php8.3-bcmath php8.3-zip php8.3-mysql php8.3-json php8.3-common -y
```

### Install Composer

```sh
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### Upload Aplikasi ke Server

```sh
cd /var/www
git clone https://github.com/achisrizal/final-test-achis.git
cd final-test-achis
composer install --optimize-autoloader --no-dev
```

setting konfigurasi pada folder aplikasi :

```sh
sudo chown -R www-data:www-data /var/www/final-test-achis/storage /var/www/final-test-achis/bootstrap/cache
sudo chmod -R 775 /var/www/final-test-achis/storage /var/www/final-test-achis/bootstrap/cache
```

### Konfigurasi Nginx untuk Laravel

copy isi dari file nginx.example ke dalam :

```sh
sudo nano /etc/nginx/sites-available/final-test-achis
```

cek konfigurasi sudah benar :

```sh
sudo nginx -t
```

restart nginx :

```sh
sudo systemctl restart nginx
```

akses aplikasi menggunakan domain yg sudah dipasang
