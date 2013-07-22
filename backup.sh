#!/bin/sh

# lalala security IDGAF
DATE=`date +"%y-%m-%d"`
ACCESS_KEY=AKIAJCJ7UQVOTIBRMJEQ
SECRET_KEY=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

# Use a local copy of virtualenv, because medved won't let us install it globally
source virtualenv-1.9/myVE/bin/activate

# Dump the database
mysqldump -uorientdba -pbgtyhn768594 DB02Orient | gzip > DB02Orient-$DATE.sql.gz

# Rsync the database to S3
boto-rsync -a $ACCESS_KEY -s $SECRET_KEY DB02Orient-$DATE.sql.gz s3://orient-backup

# Remove the local backup
rm DB02Orient-$DATE.sql.gz

# Rsync the images to S3 as well
boto-rsync -a $ACCESS_KEY -s $SECRET_KEY images/ s3://orient-backup/images