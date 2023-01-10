/usr/bin/env bash
# set -e

echo "Copying default XDEBUG ini"
cp /home/xdebug/xdebug-default.ini /usr/local/etc/php/conf.d/xdebug.ini

echo "xdebug.mode = $MODES" >> /usr/local/etc/php/conf.d/xdebug.ini

# if [[ $MODES == *"profile"* ]]; then
#     echo "Appending profile ini"
#     cat /home/xdebug/xdebug-profile.ini >> /usr/local/etc/php/conf.d/xdebug.ini
# fi

# if [[ $MODES == *"debug"* ]]; then
#     echo "Appending debug ini"
#     cat /home/xdebug/xdebug-debug.ini >> /usr/local/etc/php/conf.d/xdebug.ini

#     echo "Setting Client Host to: $CLIENT_HOST"
#     sed -i -e 's/xdebug.client_host = localhost/xdebug.client_host = '"${CLIENT_HOST}"'/g' /usr/local/etc/php/conf.d/xdebug.ini

#     echo "Setting Client Port to: $CLIENT_PORT"
#     sed -i -e 's/xdebug.client_port = 9003/xdebug.client_port = '"${CLIENT_PORT}"'/g' /usr/local/etc/php/conf.d/xdebug.ini

#     echo "Setting IDE Key to: $IDEKEY"
#     sed -i -e 's/xdebug.idekey = docker/xdebug.idekey = '"${IDEKEY}"'/g' /usr/local/etc/php/conf.d/xdebug.ini
# fi

# if [[ $MODES == *"trace"* ]]; then
#     echo "Appending trace ini"
#     cat /home/xdebug/xdebug-trace.ini >> /usr/local/etc/php/conf.d/xdebug.ini
# fi

# if [[ "off" == $MODES || -z $MODES ]]; then
#     echo "Disabling XDEBUG";
#     cp /home/xdebug/xdebug-off.ini /usr/local/etc/php/conf.d/xdebug.ini
# else
#     echo "Setting XDEBUG mode: $MODES"
#     echo "xdebug.mode = $MODES" >> /usr/local/etc/php/conf.d/xdebug.ini
# fi;