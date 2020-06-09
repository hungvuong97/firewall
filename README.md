
# Cấu hình cài đặt


## cài đặt web frontend
```sh
$ cd /var/www/html/
$ mkdir firewall
$ cd firewall
```
- Trong thư mục firewall, tạo repo và pull code xuống
- Có thể tùy chỉnh tên miền trong file /php/config.php
## Cung cấp quyền cho user www-data để đọc dữ liệu từ website

#### Cấu hình Apache2
```sh
sudo cp /var/www/html/firewall/000-default.conf  /etc/apache2/sites-available/ 
```

### Quyền với file log
```sh
$  sudo chown www-data:www-data /var/
$  sudo chown www-data:www-data /var/log/
$  sudo chown www-data:www-data /var/log/kern.log
$  sudo chown www-data:www-data /etc/ipsec*

```
### Quyền chạy lệnh iptables
```sh
$  sudo visudo
```

Tại dòng cuối, thêm

```sh
www-data ALL=NOPASSWD: ALL
```

- Cài đặt bộ lệnh hệ thống linux

```sh
sudo cp network.py /opt/
sudo cp rc.local /etc/
sudo service rc.local restart

sudo apt install python-pip
pip install python-iptables
cd ~
sudo cp .local/lib/python2.7/site-packages /usr/lib/python2.7/dist-packages
sudo cp -r .local/lib/python2.7/site-packages /usr/lib/python2.7/dist-packages

```

# cấu hình chạy chương trình khi không sử dụng apache2 ,nginx
sudo apt-get install php7.3-sqlite3 
sudo apt-get install php -y
sudo apt-get install php-{bcmath,bz2,intl,gd,mbstring,mysql,zip,fpm} -y
php -S 0.0.0.0:8080 
# firewall
# firewall
# firewall
