FROM mysql:5.7

ENV MYSQL_ROOT_PASSWORD=Rapaclass1234

COPY ./init.sql /docker-entrypoint-initdb.d/
