#!/bin/bash

cd "$(dirname "$0")"

echo "Fetching ssl error log..."

ssh $1@proposal-tool.coloradocollege.edu <<EOF
sudo cp ../../var/log/httpd/ssl_error_log ~/
exit
EOF

echo "Transferring file..."

sftp $1@proposal-tool.coloradocollege.edu <<EOF
get ssl_error_log
exit
EOF

echo "(^_^)------Done------(^_^)"