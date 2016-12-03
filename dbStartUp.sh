#!/usr/bin/env bash

sudo p /vagrant/*.php /var/www/
if [ -f /var/www/index.html];
then
   sudo rm /var/www/index.html
fi
if [ ! -f /var/log/databasesetup];
then
   echo "CREATE DATABASE cpsc471" | mysql -uroot -prootpass

   if [ -f /vagrant/cpsc471.spl ];
   then
      mysql -u root -p rootpass cpsc471 < /vagrant/cpsc471.sql
   fi
fi
