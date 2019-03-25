FROM mysql:5.7
RUN chown -R mysql:root /var/lib/mysql/

ARG MYSQL_DATABASE
ARG MYSQL_USER
ARG MYSQL_PASSWORD
ARG MYSQL_ROOT_PASSWORD

ENV MYSQL_DATABASE=$MYSQL_DATABASE
ENV MYSQL_USER=$MYSQL_USER
ENV MYSQL_PASSWORD=$MYSQL_PASSWORD
ENV MYSQL_ROOT_PASSWORD=$MYSQL_ROOT_PASSWORD

ADD config/schema.sql /etc/mysql/schema.sql
RUN sed -E -i -e 's/MYSQL_DATABASE/'$MYSQL_DATABASE'/g' -e 's/DEFINER=`?\w+`?@`?\w+`? //gi' /etc/mysql/schema.sql

RUN /bin/bash -c "/usr/bin/mysqld_safe --skip-grant-tables &" \
    && sleep 5 \
    && mysql -u$MYSQL_USER -p$MYSQL_PASSWORD -e "CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE" \
    && mysql -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE < /etc/mysql/schema.sql

EXPOSE 3306

