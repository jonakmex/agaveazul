-- Verify agaveazul:appuser on mysql

BEGIN;

SELECT sqitch.checkit(COUNT(*), 'User "restapp" does not exist')
  FROM mysql.user WHERE user = 'restapp';

ROLLBACK;
