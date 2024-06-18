rm -f IM151/config.php
touch IM151/config.php && chmod 0777 IM151/config.php
docker stop integramod
docker run --name integramod -d --rm -e LOG_STDOUT=1 -e LOG_STDERR=1 -e LOG_LEVEL=debug -p 80:80 -v $PWD/IM151:/var/www/html -v $PWD/docker/init.sql:/docker-entrypoint-initdb.d/init.sql:ro mattrayner/lamp:latest-1804 && docker exec integramod bash -c "until mysqladmin --user=root --password= --host 127.0.0.1 ping --silent &> /dev/null ; do sleep 2; done ; cat /docker-entrypoint-initdb.d/init.sql | mysql --user=root --password="
