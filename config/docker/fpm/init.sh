rm -rf /var/www/html/web/core
if [ -d "/var/www/build/web/core" ]; then
cp -r /var/www/build/web/core /var/www/html/web/core
fi

rm -rf /var/www/html/web/libraries
if [ -d "/var/www/build/web/libraries" ]; then
cp -r /var/www/build/web/libraries /var/www/html/web/libraries
fi

rm -rf /var/www/html/web/modules/contrib
if [ -d "/var/www/build/web/modules/contrib" ]; then
cp -r /var/www/build/web/modules/contrib /var/www/html/web/modules/contrib
fi

rm -rf /var/www/html/web/profiles/contrib
if [ -d "/var/www/build/web/profiles/contrib" ]; then
cp -r /var/www/build/web/profiles/contrib /var/www/html/web/profiles/contrib
fi

rm -rf /var/www/html/web/themes/contrib
if [ -d "/var/www/build/web/themes/contrib" ]; then
cp -r /var/www/build/web/themes/contrib /var/www/html/web/themes/contrib
fi


php-fpm