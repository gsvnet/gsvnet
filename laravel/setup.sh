#!/usr/bin/env bash

echo "--- Setting up gsv.192.168.33.10.xip.io as servername ---"
sudo vhost -d /vagrant/public -s gsv.192.168.33.10.xip.io
cd /vagrant

echo "--- Setting storage permissions ---"
chmod -R 777 app/storage

# Laravel stuff here, if you want
# -------------------------------
# Set up the database
echo "--- Create database ---"
echo "CREATE DATABASE IF NOT EXISTS gsvnet" | mysql -u root -proot
# Run artisan migrate to setup the database and schema
echo "--- Run artisan migrate ---"

php artisan migrate
echo "--- Seeding the database ---"
php artisan db:seed

echo "--- All set to go! Would you like to play a game? ---"