#!/usr/bin/env bash

sudo cp /vagrant/*.php /var/www/
if [ -f /var/www/index.html ];
then
   sudo rm /var/www/index.html
fi
if [ ! -f /var/log/databasesetup ];
then
   mysql -uroot -prootpass -e "CREATE DATABASE cpsc471"

   touch /var/log/databasesetup

   if [ -f /vagrant/cpsc471.sql ];
   then
      mysql -uroot -prootpass cpsc471 < /vagrant/cpsc471.sql
   fi
fi
