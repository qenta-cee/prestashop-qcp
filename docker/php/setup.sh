#!/bin/bash

apache2-foreground > /dev/null 2>&1 &

chmod +x /tmp/wait_for_service.sh
/tmp/wait_for_service.sh ${MYSQL_HOST} 3306

cd /var/www/html 
ls
git clone --depth 1 --branch ${PRESTASHOP_VERSION} https://github.com/PrestaShop/PrestaShop.git

cd PrestaShop


su www-data -c 'composer install' 
make assets


chmod +w -R admin-dev/autoupgrade app/config app/logs app/Resources/translations cache config download img log mails modules themes translations upload var

php install-dev/index_cli.php --db_server=db --db_password=root --db_name=prestashop \
    --name=ExampleShop --country=de --language=de --firstname=Max --lastname=Musterman --password=admin123 --email=admin@admin.com \
      && mv install-dev __install-dev \
      && mv admin* backend

chmod 777 /var/www/html/PrestaShop/*

tail -f /dev/stdout