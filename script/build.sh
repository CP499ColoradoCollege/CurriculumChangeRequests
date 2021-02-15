#!/usr/bin/env bash

apt update
apt upgrade

#download and install XAMPP
wget https://www.apachefriends.org/xampp-files/8.0.1/xampp-linux-x64-8.0.1-1-installer.run
chmod 755 xampp-linux-x64-8.0.1-1-installer.run
./xampp-linux-x64-8.0.1-1-installer.run

#download and install java and composer dependencies
apt install openjdk-14-jdk composer php-xml php-zip php-mbstring net-tools mysql-server
export JAVA_HOME=/usr/lib/jvm/java-14-openjdk-amd64
export PATH=$PATH:$JAVA_HOME/bin

#clone repo
git clone https://github.com/CP499ColoradoCollege/CurriculumChangeRequests.git

#set working directory
cd CurriculumChangeRequests
working_dir=$(pwd)

#set composer requirements
composer require zendframework/zend-escaper zendframework/zend-stdlib phpoffice/phpword phpunit/phpunit

#copy files to xampp localhost 
cp composer.json /opt/lampp/htdocs/ 
cp -r -a html/* html/.htaccess resources/banner.JPG resources/bootstrap.php /opt/lampp/htdocs

#install composer dependencies to localhost
cd /opt/lampp/htdocs
composer install

#start xampp and create database.
/opt/lampp/xampp start
sleep 10
/opt/lampp/bin/mysql -u root -e "CREATE DATABASE proposaltoolDB"
/opt/lampp/bin/mysql -u root proposaltoolDB < $working_dir/resources/proposal-toolDB.sql
