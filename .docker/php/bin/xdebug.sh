#!/bin/bash

hostip_mac=$(nslookup docker.for.mac.localhost | awk '/^Address: / { print $2 ; exit }')
hostip_other=$(ip route show | awk '/default/ {print $3}')

if [ -z "$hostip_mac" ]; then
    hostip=$hostip_other
else
    hostip=$hostip_mac
fi
echo "HIAR ${XDEBUG_KEY}"
echo "HIAR ${XDEBUG_KEY}"

cat > /etc/php/7.2/mods-available/xdebug.ini <<EOL
[xdebug]
zend_extension=xdebug.so
xdebug.default_enable=1
xdebug.remote_enable=1
xdebug.remote_handler=dbgp
xdebug.remote_host=${hostip}
xdebug.remote_port=9000
xdebug.idekey=${XDEBUG_KEY}
xdebug.remote_connect_back=0
xdebug.remote_autostart=1
EOL
