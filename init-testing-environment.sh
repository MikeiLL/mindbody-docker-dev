#!/bin/bash
cd /var/www/html/

./bin/install-wp-tests.sh $WORDPRESS_DB_NAME $WORDPRESS_DB_USER $WORDPRESS_DB_PASSWORD $WORDPRESS_DB_HOST latest true

#5. execute the entrypoint of the parent image
bash docker-entrypoint.sh "$@"
