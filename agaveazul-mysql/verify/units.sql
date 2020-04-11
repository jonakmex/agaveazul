-- Verify agaveazul:units on mysql

BEGIN;

SELECT unit_id, description
  FROM unit
 WHERE 0;

ROLLBACK;
