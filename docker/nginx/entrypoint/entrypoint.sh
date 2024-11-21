#!/usr/bin/env sh

#Генерируем site.conf и запускаем nginx
envsubst '\$COMPOSE_PROJECT_NAME \$APP_ENTRY_POINT \$APP_ROOT_DIRECTORY \$APP_ENV_NAME ' < "/etc/nginx/conf.d/site.conf.dist" > "/etc/nginx/conf.d/site.conf"
chown -R nginx:nginx /var/cache/nginx/proxy_cache
nginx -g 'daemon off;'
