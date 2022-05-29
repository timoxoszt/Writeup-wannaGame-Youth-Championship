#!/bin/sh

PATH=/sbin:/bin:/usr/sbin:/usr/bin:/usr/local/sbin:/usr/local/bin

# Grant permission
chmod 777 /var/www/html/uploadfiles

# Generate random flag name
RND=$(echo $RANDOM | md5sum | head -c 15)
echo "W1{phake_flag}" > /flag_${RND}.txt

# Start service
php-fpm