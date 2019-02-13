CREATE DATABASE if not exists integramod;
use integramod;
CREATE SCHEMA if not exists integramod;
CREATE USER 'integramod' IDENTIFIED BY 'integramod';
GRANT ALL PRIVILEGES ON integramod.* TO integramod;
FLUSH PRIVILEGES;
