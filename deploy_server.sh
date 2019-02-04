#!/bin/bash

cd "$(dirname "$0")"

echo "deploying to CC web server..."
if [ $# -lt 1 ]; then
echo "Usage: ./buildscript <CC userneame>"
exit 1
fi

mkdir deploy 

cp -r config databaseConnection functions images template views deploy/
cp index.php deploy/
sftp $1@proposal-tool.coloradocollege.edu <<EOF
put -r deploy/
exit
EOF

rm -r deploy/

echo "transferred files."
echo "༼ つ ◕_◕ ༽つ"
echo "Please enter password again to move them to the right place"

ssh $1@proposal-tool.coloradocollege.edu <<EOF
cp deploy ../../var/www/html 
exit
EOF
echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"
