#!/bin/bash

cd "$(dirname "$0")"

echo "deploying to CC web server..."
if [ $# -lt 1 ]; then
echo "Usage: ./deploy_server.sh <CC userneame>"
exit 1
fi

mkdir deploy 

cp -r config databaseConnection functions vendor images template views deploy/
cp index.php deploy/
sftp $1@proposal-tool.coloradocollege.edu <<EOF
put -r deploy/
exit
EOF

rm -r deploy/

echo "transferred files."
echo "༼ つ ◕_◕ ༽つ"
echo "Please enter password again to move them to the right place"

ssh -t -t $1@proposal-tool.coloradocollege.edu <<EOF
sudo su -
cp -a deploy/. ../../var/www/html 
cd ../../var/www/html
composer install
exit
EOF
echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"
