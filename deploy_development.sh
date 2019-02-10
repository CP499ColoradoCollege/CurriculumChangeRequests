#!/bin/bash

cd "$(dirname "$0")"

echo "deploying to xampp..."
echo "༼ つ ◕_◕ ༽つ"

sudo cp -a config databaseConnection functions images vendor template views ~/../../opt/lampp/htdocs
sudo cp index.php bootstrap.php composer.lock composer.json ~/../../opt/lampp/htdocs
sudo composer install --prefer-source
echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"
