apt update
apt upgrade
git clone https://github.com/CP499ColoradoCollege/CurriculumChangeRequests.git
wget https://www.apachefriends.org/xampp-files/8.0.1/xampp-linux-x64-8.0.1-1-installer.run
chmod 755 xampp-linux-x64-8.0.1-1-installer.run
./xampp-linux-x64-8.0.1-1-installer.run
apt install openjdk-14-jdk composer php-xml php-zip php-mbstring
export JAVA_HOME=/usr/lib/jvm/java-14-openjdk-amd64
export PATH=$PATH:$JAVA_HOME/bin
composer require zendframework/zend-escaper zendframework/zend-stdlib phpoffice/phpword phpunit/phpunit
cp composer.json /opt/lammp/htdocs
cd CurriculumChangeRequests
cp -r html/* html/.htaccess resources/banner.JPG resources/bootstrap.php /opt/lampp/htdocs
cd /opt/lampp/htdocs
composer install
/opt/lampp/xampp start
/opt/lampp/bin/mysql -u root -e "CREATE DATABASE proposaltoolDB"
/opt/lampp/bin/mysql -u root proposaltoolDB < ~/CurriculumChangeRequests/resources/proposaltool-DB.sql