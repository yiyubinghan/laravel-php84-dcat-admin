#!/bin/sh

# 复制 .env 并修改特定配置
if [ ! -f .env ]; then
    cp .env.example .env

    sed -i 's/APP_NAME=.*/APP_NAME='${APP_NAME}'/' .env && \
    sed -i 's/APP_ENV=.*/APP_ENV='${APP_ENV}'/' .env && \
    sed -i 's/APP_DEBUG=.*/APP_DEBUG='${APP_DEBUG}'/' .env && \
    sed -i 's/DB_CONNECTION=.*/DB_CONNECTION='${DB_CONNECTION}'/' .env && \
    sed -i 's/DB_HOST=.*/DB_HOST='${DB_HOST}'/' .env && \
    sed -i 's/DB_PORT=.*/DB_PORT='${DB_PORT}'/' .env && \
    sed -i 's/DB_DATABASE=.*/DB_DATABASE='${DB_DATABASE}'/' .env && \
    sed -i 's/DB_USERNAME=.*/DB_USERNAME='${DB_USERNAME}'/' .env && \
    sed -i 's/DB_PASSWORD=.*/DB_PASSWORD='${DB_PASSWORD}'/' .env && \
    sed -i 's/REDIS_CLIENT=.*/REDIS_CLIENT='${REDIS_CLIENT}'/' .env && \
    sed -i 's/REDIS_HOST=.*/REDIS_HOST='${REDIS_HOST}'/' .env && \
    sed -i 's/REDIS_PORT=.*/REDIS_PORT='${REDIS_PORT}'/' .env
fi

# 生成应用密钥
php artisan key:generate

# 执行数据库迁移（生产环境建议手动执行）
php artisan migrate

# 配置缓存
php artisan config:cache

# Blade模版缓存
# php artisan view:cache

# 事件和监听器缓存
# php artisan event:cache

# 路由缓存
# php artisan route:cache

# 设置存储目录权限
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

exec "$@"