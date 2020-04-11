-- Deploy agaveazul:units to mysql
-- requires: appuser

BEGIN;

CREATE TABLE unit (
    unit_id  INTEGER PRIMARY KEY,
    description  VARCHAR(512) NOT NULL
);


GRANT SELECT ON TABLE unit TO restapp;

COMMIT;
