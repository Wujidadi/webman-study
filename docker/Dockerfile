FROM wujidadi/nginx-php:2.8

ARG user=user
ARG php_version=8.2

RUN touch /root/.zsh_history;\
    touch /home/${user}/.zsh_history && chown ${user}:${user} /home/${user}/.zsh_history;

CMD ["/bin/bash", "-c", "cron start; supervisord -c /etc/supervisor/conf.d/supervisord.conf; php /var/www/html/application/start.php start -d"]
