### Run these installers

[Composer](https://getcomposer.org/Composer-Setup.exe)
[XAMPP](https://www.apachefriends.org/xampp-files/8.0.2/xampp-windows-x64-8.0.2-0-VS16-installer.exe)
[Java](https://download.java.net/java/GA/jdk15.0.2/0d1cfde4252546c6931946de8db48ee2/7/GPL/openjdk-15.0.2_windows-x64_bin.zip)

When you're finished, run the XAMPP Control Panel (Start -> XAMPP Control Panel) and click the "start" buttons next to Apache and MySQL.

### Clone the Github repo and place the files in the Apache Document Root

git clone https://github.com/CP499ColoradoCollege/CurriculumChangeRequests.git
move CurriculumChangeRequests\html\* C:\xampp\htdocs

### Initialize the database with our packaged SQL query

1. Open [phpMyAdmin](localhost/phpmyadmin)
2. Click the "new" button on the left of the interface and create a database named proposal-toolDB
3. Click on the newly created database
4. Open the file "proposaltoolDB.sql" (found in the Github repo in the "resources" folder) in a text editor like Notepad
5. Navigate to the "SQL" tab of the interface and copy/paste the SQL query from proposaltoolDB.sql
6. Click the "Go" button in the interface and the database will be constructed.

### Install required Composer dependencies

composer require phpoffice/phpword phpunit/phpunit zendframework/zend-stdlib zendframework/zend-escaper
cd C:\xampp\htdocs
composer install