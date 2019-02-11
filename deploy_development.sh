#!/bin/bash

cd "$(dirname "$0")"

echo "deploying to xampp..."
echo "༼ つ ◕_◕ ༽つ"

sudo cp -a config databaseConnection functions vendor template views ~/../../opt/lampp/htdocs
sudo cp .htaccess banner.JPG index.php bootstrap.php composer.json ~/../../opt/lampp/htdocs
composer install --prefer-source
echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"
