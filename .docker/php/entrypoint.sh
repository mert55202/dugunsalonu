#!/bin/sh
set -e

if [ ! -f .env ]; then
  if [ -f .env.docker ]; then
    cp .env.docker .env
  else
    cp .env.example .env
  fi
fi

if [ ! -d vendor ]; then
  composer install --no-interaction --prefer-dist
fi

until mysql --skip-ssl -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USERNAME}" -p"${DB_PASSWORD}" -e "SELECT 1" >/dev/null 2>&1; do
  echo "MySQL bekleniyor..."
  sleep 2
done

# APP_KEY zaten tanimliysa yeniden uretme
KEY_VAL=$(grep -E '^APP_KEY=' .env | cut -d= -f2- | tr -d '\r' | tr -d '"' || true)
if [ -z "$KEY_VAL" ]; then
  php artisan key:generate --force
fi

php artisan migrate --seed --force
php artisan storage:link --force 2>/dev/null || true
php artisan serve --host=0.0.0.0 --port=8000