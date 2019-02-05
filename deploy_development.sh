#!/bin/bash

cd "$(dirname "$0")"

echo "deploying to xampp..."
echo "༼ つ ◕_◕ ༽つ"

cp -r config databaseConnection functions images vendor template views ~/../../opt/lampp/htdocs
cp index.php composer.json ~/../../opt/lampp/htdocs
composer install
echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"
