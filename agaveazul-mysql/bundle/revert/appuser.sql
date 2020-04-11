-- Revert agaveazul:appuser from mysql

BEGIN;

DROP USER restapp;

COMMIT;
