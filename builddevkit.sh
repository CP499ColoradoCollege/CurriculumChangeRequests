
echo "Devkit installation in progress"
echo "Welcome Stranger..."

echo "Installing xampp local server..."
wget https://www.apachefriends.org/xampp-files/7.3.1/xampp-linux-x64-7.3.1-0-installer.run
chmod 755 xampp-linux-x64-7.3.1-0-installer.run
sudo ./xampp-linux-x64-7.3.1-0-installer.run

echo "Installing java..."
sudo apt install openjdk-8-jdk
export JAVA_HOME=/usr/lib/jvm/java-8-openjdk-amd64/
export PATH=$PATH:$JAVA_HOME/bin

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
echo "Setup Complete"

