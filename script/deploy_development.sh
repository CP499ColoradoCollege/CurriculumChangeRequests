#!/bin/bash

cd "$(dirname "$0")"

echo "deploying to xampp..."
echo "༼ つ ◕_◕ ༽つ"

cd ../html

sudo cp -a config classes databaseConnection functions tests vendor template views index.php .htaccess /opt/lampp/htdocs
cd ../resources
sudo cp banner.JPG  bootstrap.php composer.json /opt/lampp/htdocs

cd /opt/lampp/htdocs
sudo composer install
echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"
