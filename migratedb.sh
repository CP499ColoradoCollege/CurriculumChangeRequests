#!/bin/bash

cd "$(dirname "$0")"

if [ $# -lt 2 ]; then
echo "Usage: ./migratedb.sh <CC userneame> .sql file"
exit 1
fi

echo "Migrating local Xampp DB to virtual server..."
echo "Continue? y/n"
read continue_text

if [ $continue_text != "y" ]; then
exit 1
fi

echo "Migrating files."
echo "༼ つ ◕_◕ ༽つ"

echo "Please enter password again to migrate"



mkdir deploy 

cp -r config databaseConnection functions images template views deploy/
cp index.php deploy/
sftp $1@proposal-tool.coloradocollege.edu <<EOF
put -r deploy/
exit
EOF

rm -r deploy/



ssh $1@proposal-tool.coloradocollege.edu <<EOF
cp deploy ../../var/www/html 
exit
EOF
echo "*"
echo "*"
echo "(^_^)------Done------(^_^)"