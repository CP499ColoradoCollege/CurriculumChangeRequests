#!/usr/bin/env bash

#resynchronize apt package index and install newest versions
sudo apt update
sudo apt upgrade

#clone repo
git clone https://github.com/CP499ColoradoCollege/CurriculumChangeRequests.git

#set working directory
cd CurriculumChangeRequests
working_dir=$(pwd)
user=$USER

#download and install XAMPP
sudo wget https://www.apachefriends.org/xampp-files/8.0.1/xampp-linux-x64-8.0.1-1-installer.run
sudo chmod 755 xampp-linux-x64-8.0.1-1-installer.run
sudo ./xampp-linux-x64-8.0.1-1-installer.run

#download and install java and composer + other dependencies 
sudo sudo apt install openjdk-14-jdk composer php-xml php-zip php-mbstring net-tools
export JAVA_HOME="/usr/lib/jvm/java-14-openjdk-amd64"
export PATH="$PATH:$JAVA_HOME/bin"
sudo cp html/databaseConnection/*.jar /usr/lib/jvm/java-8-openjdk-amd64/jre/lib/ext

#set composer requirements
sudo composer require zendframework/zend-escaper zendframework/zend-stdlib phpoffice/phpword phpunit/phpunit

#copy files to XAMPP
sudo cp composer.json /opt/lampp/htdocs/ 
sudo cp html/* html/.htaccess resources/banner.JPG resources/bootstrap.php /opt/lampp/htdocs

#install composer dependencies to localhost
cd /opt/lampp/htdocs
composer install

#ensure correct permissions to application files  
sudo chmod 755 /opt/lampp/htdocs/

#start xampp and create database.
sudo /opt/lampp/xampp start
/opt/lampp/bin/mysql -u root -e "CREATE DATABASE proposaltoolDB"
/opt/lampp/bin/mysql -u root proposaltoolDB < $working_dir/resources/proposaltoolDB.sql

