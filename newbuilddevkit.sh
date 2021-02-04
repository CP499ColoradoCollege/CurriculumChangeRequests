#!/bin/bash

sudo apt update
sudo apt upgrade

echo "Installing xampp local server"
wget https://www.apachefriends.org/xampp-files/8.0.1/xampp-linux-x64-8.0.1-0-installer.run
chmod 755 xampp-linux-x64-8.0.1-0-installer.run
sudo ./xampp-linux-x64-8.0.1-0-installer.run

sudo apt install nautilus-admin
echo "Type the following text into the prompt"
echo "[Desktop Entry]"
echo "Encoding=UTF-8"
echo "Name=XAMPP Control Panel"
echo "Comment=Start and Stop XAMPP"
echo "Exec=pkexec /opt/lampp/manager-linux-x64.run"
echo "Icon=/opt/lampp/htdocs/favicon.ico"
echo "Categories=Application"
echo "Type=Application"
echo "Terminal=false"
gedit /usr/share/application/xampp-control-panel.desktop

echo "Installing java..."
sudo apt install openjdk-8-jdk
export JAVA_HOME=/usr/lib/jvm/java-8-openjdk-amd64/
export PATH=$PATH:$JAVA_HOME/bin

echo "Done"
echo "Installing php extensions and composer"

sudo apt install php-cli unzip
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

sudo apt install php-xml
sudo apt install php-zip
sudo apt install php-mbstring


