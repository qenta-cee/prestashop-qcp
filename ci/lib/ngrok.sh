#!/bin/bash

# Die vorliegende Software ist Eigentum von QENTA Payment CEE GmbH
# und daher vertraulich zu behandeln.
# Jegliche Weitergabe an dritte, in welcher Form auch immer, ist unzulaessig.

# Software & Service Copyright © by
# QENTA Payment CEE GmbH,
# FB-Nr: FN 539960 i, https://www.qenta.com/

# sed because output array is random
function get_ngrok_url() {
  curl --fail -s localhost:4040/api/tunnels | jq -r .tunnels\[0\].public_url | sed 's/^http:/https:/'
}

function wait_for_ngrok() {
  while [[ -z ${RESPONSE} || ${RESPONSE} == 'null' ]]; do
    RESPONSE=$(get_ngrok_url)
    sleep 3;
  done
}

NGROK_TOKEN=${1}

if [[ -z ${NGROK_TOKEN} ]]; then
  echo 'NGROK token missing. Set NGROK_TOKEN env' >&2
  exit 1
fi

/workspace/node_modules/ngrok/bin/ngrok authtoken ${NGROK_TOKEN} >&/dev/null
/workspace/node_modules/ngrok/bin/ngrok http 80 >&/dev/null &
wait_for_ngrok
export NGROK_URL=$(get_ngrok_url)
export NGROK_HOST=$(sed 's/^https...//' <<< ${NGROK_URL})

echo ${NGROK_HOST}
