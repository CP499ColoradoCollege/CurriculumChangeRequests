#!/usr/bin/env bash

#resynchronize apt package index and install newest versions
sudo apt update
sudo apt upgrade

#clone repo
git clone https://github.com/CP499ColoradoCollege/CurriculumChangeRequests.git

#download and install XAMPP
sudo wget https://www.apachefriends.org/xampp-files/7.3.1/xampp-linux-x64-7.3.1-0-installer.run
sudo chmod 755 xampp-linux-x64-7.3.1-0-installer.run
sudo ./xampp-linux-x64-7.3.1-0-installer.run

#set working directory
cd CurriculumChangeRequests
working_dir=$(pwd)

#download and install java and composer + other dependencies 
sudo sudo apt install openjdk-8-jdk composer php-xml php-zip php-mbstring net-tools
sudo cp html/databaseConnection/*.jar /usr/lib/jvm/java-8-openjdk-amd64/jre/lib/ext
export JAVA_HOME="/usr/lib/jvm/java-8-openjdk-amd64"
export PATH="$PATH:$JAVA_HOME/bin"

#copy files to XAMPP
sudo cp -r resources/composer.json /opt/lampp/htdocs/ 
sudo cp -r html/* html/.htaccess resources/banner.JPG resources/bootstrap.php /opt/lampp/htdocs

#install composer from lock file
sudo cp resources/composer.json resources/composer.lock /opt/lampp/htdocs 
cd /opt/lampp/htdocs 
composer install


#ensure correct permissions to application files  
sudo chmod 755 /opt/lampp/htdocs/

#start xampp and create database.
sudo /opt/lampp/xampp start
/opt/lampp/bin/mysql -u root -e "CREATE DATABASE proposaltoolDB"
/opt/lampp/bin/mysql -u root proposaltoolDB < $working_dir/resources/proposaltoolDB.sql

