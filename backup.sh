#!/bin/sh

DATE=`date +"%y-%m-%d"`

# Use a local copy of virtualenv, because medved won't let us install it globally
source /home/orientweb/bowdoinorient.com/htdocs/python-env/bin/activate

# Dump the database
mysqldump -u$DBUSER -p$DBPW $DBDB | gzip > $DBDB-$DATE.sql.gz

# Rsync the database to S3
boto-rsync -a $AWS_BONUS_ACCESS_KEY -s $AWS_BONUS_SECRET_KEY $DBDB-$DATE.sql.gz s3://orient-backup

# Remove the local backup
rm $DBDB-$DATE.sql.gz

# Rsync the images to S3 as well
boto-rsync -a $AWS_BONUS_ACCESS_KEY -s $AWS_BONUS_SECRET_KEY images/ s3://orient-backup/images