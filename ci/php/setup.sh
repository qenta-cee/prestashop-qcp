#!/bin/bash

# INSTALL dependencies
# RUN NGROK
# BUILD assets in background
# SETUP PrestaShop
# SET permissions

set -e

function start_services() {
  # Run webserver
  echo "Starting Apache"
  apache2-foreground > /dev/null 2>&1 &

  # Install NGROK
  echo "Installing NGROK"
  cd /workspace
  npm install

  # Run NGROK
  echo "Starting NGROK"
  PRESTASHOP_NGROK_HOST=$(bash /workspace/ci/lib/ngrok.sh ${PRESTASHOP_NGROK_TOKEN})

  if [[ -z ${PRESTASHOP_NGROK_HOST} ]]; then
    echo "WARNING: PRESTASHOP_NGROK_HOST could not be determined" >&2
    PRESTASHOP_URL="http://localhost:${PRESTASHOP_EXPOSED_PORT}"
  else
    PRESTASHOP_URL="https://${PRESTASHOP_NGROK_HOST}/"
  fi

  # Wait for db connectivity
  bash /workspace/ci/php/wait_for_service.sh ${PRESTASHOP_MYSQL_HOST} 3306
}

function install_shop() {
  if [[ -n $(ls /var/www/html) ]] && [[ ${PRESTASHOP_PERSISTENT} == 'true' ]]; then
    echo "WARNING: Skipping shop installation. Persistent data found in ./data:/var/www/html"
    return
  fi
  
  # if persistent set to false, remove old data
  chown -R www-data:www-data /var/www/html
  chmod -R 755 /var/www/html
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
  } &> /dev/null &
}

start_services
install_shop

echo "############# SHOP URL #############"
echo "${PRESTASHOP_URL}"
echo "Admin User: ${PRESTASHOP_EMAIL}"
echo "Admin Password: ${PRESTASHOP_PASSWORD}"
echo "####################################"

tail -f /dev/stdout
