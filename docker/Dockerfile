FROM wujidadi/nginx-php:2.7

ARG user=user
ARG php_version=8.2

RUN touch /root/.zsh_history;\
    touch /home/${user}/.zsh_history && chown ${user}:${user} /home/${user}/.zsh_history;\
    apt-get update && apt-get upgrade -y;\
    apt-get upgrade -y nodejs;\
    npm install -g npm;\
    apt-get install -y --no-install-recommends nginx php${php_version} php${php_version}-cli php${php_version}-common php${php_version}-fpm php${php_version}-xdebug php${php_version}-pdo php-pear php${php_version}-curl php${php_version}-dev php${php_version}-gd php${php_version}-mbstring php${php_version}-zip php${php_version}-mysql php${php_version}-mysqlnd php${php_version}-opcache php${php_version}-readline php${php_version}-xml php${php_version}-tidy php${php_version}-imagick php${php_version}-gmp php${php_version}-bz2 php${php_version}-soap php${php_version}-bcmath php${php_version}-intl php${php_version}-pgsql php${php_version}-sqlite3 odbc-postgresql;\
    apt-get autoremove -y;\
    apt-get clean;\
    rm -rf /var/lib/apt/lists/*

CMD ["/bin/bash", "-c", "cron start; supervisord -c /etc/supervisor/conf.d/supervisord.conf; php /var/www/html/application/start.php start -d"]
