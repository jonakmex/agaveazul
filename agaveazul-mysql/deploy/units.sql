-- Deploy agaveazul:units to mysql
-- requires: appuser

BEGIN;

CREATE TABLE unit (
    id  INTEGER PRIMARY KEY AUTO_INCREMENT,
    description  VARCHAR(512) NOT NULL
);


GRANT SELECT,INSERT,UPDATE,DELETE ON TABLE unit TO restapp;

COMMIT;
