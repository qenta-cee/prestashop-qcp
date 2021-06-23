#!/bin/bash

# INSTALL dependencies
# RUN NGROK
# BUILD assets in background
# SETUP PrestaShop
# SET permissions
# INSTALL module

#set -xe

function start_services() {
  # Run webserver
  echo "Starting Apache"
  apache2-foreground > /dev/null 2>&1 &

  # Install NGROK
  echo "Installing NGROK"
  cd /workspace
  npm install

  if [[ -n ${PRESTASHOP_NGROK_HOST} ]]; then
    echo "NGROK Hostname passed as ENV"
  else
    # Run NGROK
    echo "Starting NGROK"
    PRESTASHOP_NGROK_HOST=$(timeout 20 bash /workspace/ci/lib/ngrok.sh ${PRESTASHOP_NGROK_TOKEN})
  fi

  if [[ -z ${PRESTASHOP_NGROK_HOST} ]]; then
    echo "WARNING: PRESTASHOP_NGROK_HOST could not be determined" >&2
    PRESTASHOP_URL="http://localhost:${PRESTASHOP_EXPOSED_PORT}"
  else
    PRESTASHOP_URL="https://${PRESTASHOP_NGROK_HOST}/"
  fi
}

function install_plugin() {
  echo "Installing plugin ${1}"
  cp -r /workspace/${1} /var/www/html/modules
  chown -R www-data:www-data /var/www/html/modules
  cd /var/www/html/
  runuser -g www-data -u www-data -- php bin/console prestashop:module install ${1}
}

function install_shop() {
  if [[ -n $(ls /var/www/html) ]] && [[ ${PRESTASHOP_PERSISTENT} == 'true' ]]; then
    echo "WARNING: Skipping shop installation. PRESTASHOP_PERSISTENT set to true and data found in ./data:/var/www/html"
    return
  fi
  
  # if persistent set to false, remove old data
  echo "Removing old content"
  rm -rf /var/www/html/{..?*,.[!.]*,*}
  chown -R www-data:www-data /var/www/html
  cd /var/www/html

  git clone --depth 1 --branch ${PRESTASHOP_VERSION} https://github.com/PrestaShop/PrestaShop.git .
  composer install
  mkdir -p log app/logs
  runuser -g www-data -u www-data -- php install-dev/index_cli.php --domain="${PRESTASHOP_NGROK_HOST}" --db_server=${PRESTASHOP_MYSQL_HOST} --db_password=${PRESTASHOP_MYSQL_ROOT_PASSWORD} --db_name=${PRESTASHOP_MYSQL_DATABASE} --name=${PRESTASHOP_NAME} --country=${PRESTASHOP_COUNTRY} --language=${PRESTASHOP_LANGUAGE} --firstname=Max --lastname=Qentaman --password=${PRESTASHOP_PASSWORD} --email=${PRESTASHOP_EMAIL}
  mv install-dev __install-dev

  echo "Building PrestaShop assets in the background"
  {
    npm install
    ./tools/assets/build.sh
    echo "Done building PrestaShop assets"
  } &> /dev/null &

  install_plugin qentaceecheckoutpage
}

start_services
install_shop

echo
echo "############### SHOP URL ###############"
echo "Shop URL: ${PRESTASHOP_URL}"
echo "Admin URL: ${PRESTASHOP_URL}admin-dev/"
echo
echo "Admin User: ${PRESTASHOP_EMAIL}"
echo "Admin Password: ${PRESTASHOP_PASSWORD}"
echo
echo "Consumer User: pub@prestashop.com"
echo "Consumer Password: 123456789"
echo "########################################"

tail -f /dev/stdout
