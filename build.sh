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
sudo sudo apt install openjdk-8-jdk composer php-xml php-zip php-mbstring
sudo cp html/databaseConnection/*.jar /usr/lib/jvm/java-8-openjdk-amd64/jre/lib/ext
export JAVA_HOME="/usr/lib/jvm/java-8-openjdk-amd64"
export PATH="$PATH:$JAVA_HOME/bin"

#copy files to XAMPP
sudo cp -r html/* html/.htaccess resources/banner.JPG resources/bootstrap.php /opt/lampp/htdocs

#install composer from lock file
composer install

#ensure correct permissions to application files  
sudo chown -R $USER:USER /opt/lampp/htdocs
sudo chmod 755 /opt/lampp/htdocs/

#start xampp and create databases.
sudo /opt/lampp/xampp start
/opt/lampp/bin/mysql -u root -e "CREATE DATABASE proposaltoolDB"
/opt/lampp/bin/mysql -u root -e "CREATE DATABASE testproposaltoolDB"

/opt/lampp/bin/mysql -u root proposaltoolDB < $working_dir/resources/proposaltoolDB.sql
/opt/lampp/bin/mysql -u root proposaltoolDB < $working_dir/tests/_data/testproposaltoolDB.sql
