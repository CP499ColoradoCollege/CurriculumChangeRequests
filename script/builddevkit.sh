f#!/bin/bash
echo "Devkit installation in progress"
echo "Welcome Stranger..."

sudo apt update
sudo apt upgrade

echo "Installing xampp local server..."
echo "."
echo "."
echo "."
echo "Type the following text into gksu prompt"
wget https://www.apachefriends.org/xampp-files/7.3.1/xampp-linux-x64-7.3.1-0-installer.run
chmod 755 xampp-linux-x64-7.3.1-0-installer.run
sudo ./xampp-linux-x64-7.3.1-0-installer.run

sudo apt-get install gksu
echo "Type the following text into gksu prompt"
echo "[Desktop Entry]"
echo "Encoding=UTF-8"
echo "Name=XAMPP Control Panel"
echo "Comment=Start and Stop XAMPP"
echo "Exec=gksudo /opt/lampp/manager-linux-x64.run"
echo "Icon=/opt/lampp/htdocs/favicon.ico"
echo "Categories=Application"
echo "Type=Application"
echo "Terminal=false"

gksu gedit /usr/share/applications/xampp-control-panel.desktop

echo "Installing java..."
sudo apt install openjdk-8-jdk
export JAVA_HOME=/usr/lib/jvm/java-8-openjdk-amd64/
export PATH=$PATH:$JAVA_HOME/bin

echo "Done"
echo "Installing php extensions and composer"

sudo apt install composer
sudo apt install php-xml
sudo apt install php-zip
sudo apt install php-mbstring

composer require zendframework/zend-escaper
composer require zendframework/zend-stdlib
composer require phpoffice/phpword
composer require phpunit/phpunit

chmod +x ./deploy_development.sh
sudo ./deploy_development.sh
cd databaseConnection
sudo cp *.jar ~/../../usr/lib/jvm/java-8-openjdk-amd64/jre/lib/ext
echo "Web files deployed to development xampp server"
echo "Open Firefox and typ localhost:80 to view the web application"
echo "."
echo "."
echo "."
echo "Setup Complete"
echo "Have a nice day!"

