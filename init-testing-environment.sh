#!/bin/bash

cd /var/www/html/

#1. check if wordpress is already installed/configured
if (wp core is-installed --allow-root)
then

	#2. check if the database is ready
	#f ! (wp db check --allow-root)
	#hen
	#	# wait a moment for the database container
	#	sleep 1
	#	exit 1;
	#i

	#3. init the testing instance
	wp scaffold plugin-tests $WP_PLUGIN_FOLDER --force --allow-root
	cd wp-content/plugins/$WP_PLUGIN_FOLDER && bash -c "./bin/install-wp-tests.sh $WORDPRESS_DB_NAME $WORDPRESS_DB_USER $WORDPRESS_DB_PASSWORD $WORDPRESS_DB_HOST latest true"

fi

#4. back to the root WP folder
cd /var/www/html/

#5. execute the entrypoint of the parent image
bash docker-entrypoint.sh "$@"
