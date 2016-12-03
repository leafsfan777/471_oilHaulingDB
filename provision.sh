#!/usr/bin/env bash

# update / upgrade
sudo apt-get update
#set config options for mysql
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password rootpass"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password rootpass"
#install lamp stack
sudo apt-get install -y lamp-server^

