#!/bin/sh

# Replace production setup files with local ones 
cp local-setup/local-config/.htaccess .htaccess
cp local-setup/local-config/config.php application/config/config.php
cp local-setup/local-config/database.php application/config/database.php


# Tell git not to track those files
git update-index --assume-unchanged .htaccess
git update-index --assume-unchanged application/config/config.php
git update-index --assume-unchanged application/config/database.php


# Create an Orient database
mysql -uroot -e "CREATE DATABASE DB02Orient;"


# Get Apache and PHP set up
echo "Would you like to OVERWRITE your httpd.conf and php.ini with the files included?"
echo "This is really only advisable if you don't host any other sites on this machine."
read -p "Do it? [y/n]: " yn
case $yn in
 [Yy]*) echo "OK. I'm making backups, just in case." && sudo cp /etc/apache2/httpd.conf /etc/apache2/httpd-backup.conf && sudo cp local-setup/httpd.conf /etc/apache2 && sudo cp /etc/php.ini /etc/php-backup.ini && sudo cp local-setup/php.ini /etc/;;
 * ) echo "OK, I won't. You're on your own to get that working!!";;
esac


# Make an apache vsite
sudo cp ./local-setup/bowdoinorient.conf /etc/apache2/other
sudo ln -s `pwd` /Library/WebServer/Documents

# make bowdoinorient.dev work
sudo sh -c "echo '127.0.0.1 bowdoinorient.dev' >> /etc/hosts"

# restart apache
sudo apachectl -k restart

# give it a go
echo "\nOK, I'm done. Now all you need is an SQL dump and you're good to go."

