-- Deploy agaveazul:appuser to mysql

BEGIN;

CREATE USER 'restapp' IDENTIFIED BY 'password';;

COMMIT;
