#!/bin/bash

cd "$(dirname "$0")"

echo "deploying to xampp..."
echo "༼ つ ◕_◕ ༽つ"

sudo cp -a config databaseConnection functions tests images vendor template views ~/../../opt/lampp/htdocs
sudo cp index.php bootstrap.php composer.json ~/../../opt/lampp/htdocs
cd ~/../../opt/lampp/htdocs
sudo composer install
echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"
