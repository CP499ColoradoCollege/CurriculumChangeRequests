#!/bin/bash

cd "$(dirname "$0")"

echo "deploying to xampp..."
echo "༼ つ ◕_◕ ༽つ"

cp -r config databaseConnection functions images template views ~/../../opt/lampp/htdocs
cp index.php ~/../../opt/lampp/htdocs

echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"
