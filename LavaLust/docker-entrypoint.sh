#!/bin/sh
set -eu

PORT="${PORT:-10000}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

if [ -n "${DB_SSL_CA:-}" ] && [ -f "$DB_SSL_CA" ]; then
	cp "$DB_SSL_CA" /tmp/aiven-ca.pem
	chmod 0444 /tmp/aiven-ca.pem
	export DB_SSL_CA=/tmp/aiven-ca.pem
fi

exec apache2-foreground