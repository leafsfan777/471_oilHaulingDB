#!/usr/bin/env bash

#update repo's
sudo apt-get update
#get apache
sudo apt-get install -y apache2
if ! [ -L /var/www ]; then 
   rm -rf /var/www
   ln -fs /vagrant /var/www
fi
#get mysql
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password rootpass'
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password rootpass'
sudo apt-get -y install mysql-server libapache2-mod-auth php5-mysql
#get php
sudo apt-get -y install php5 libapache2-mod-php5 php5-mcrypt


