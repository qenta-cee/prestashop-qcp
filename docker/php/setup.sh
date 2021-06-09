#!/bin/bash

set -xe

apache2-foreground > /dev/null 2>&1 &

chmod +x /tmp/wait_for_service.sh
/tmp/wait_for_service.sh ${MYSQL_HOST} 3306

cd /var/www/html 
git clone --depth 1 --branch ${PRESTASHOP_VERSION} https://github.com/PrestaShop/PrestaShop.git .

chown -R www-data:www-data *
chmod -R 755 *

composer install
npm install
./tools/assets/build.sh

mkdir -p log app/logs

chown -R www-data:www-data *
chmod -R 755 *

runuser -g www-data -u www-data -- php install-dev/index_cli.php --domain="localhost:8080" --db_server=db --db_password=root --db_name=prestashop --name=ExampleShop --country=de --language=de --firstname=Max --lastname=Musterman --password=admin123 --email=admin@admin.com

mv install-dev __install-dev

tail -f /dev/stdout
