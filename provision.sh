#!/bin/bash
export DEBIAN_FRONTEND=noninteractive

apt-get update
apt-get install -y apache2 mysql-server php5-mysql php5 libapache2-mod-php5 php5-mcrypt

cp hackers-heaven/apache2/hackers-heaven.conf /etc/apache2/sites-available/hackers-heaven.conf

chmod -R 755 /home/vagrant/hackers-heaven/src

mkdir -p /home/vagrant/hackers-heaven/tmp/templates_c
chown -R www-data:www-data /home/vagrant/hackers-heaven/tmp/templates_c

a2dissite 000-default
a2ensite hackers-heaven.conf

service apache2 restart

mysql < hackers-heaven/mysql/schema.sql