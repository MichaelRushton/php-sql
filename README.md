# PHP-SQL
A PHP library to generate SQL statement strings using a fluent interface.

See also https://github.com/MichaelRushton/php-db for an extension that provides a PDO wrapper.

## Installation
```bash
composer require michaelrushton/sql
```

## Example
```php
use MichaelRushton\SQL\SQL;

echo $stmt = SQL::SQLite->select()
->from("users")
->where("email_address", "michael@example.com");

print_r($stmt->bindings());
```
```
SELECT * FROM "users" WHERE "email_address" = ?

Array
(
    [0] => michael@example.com
)
```

## Documentation
[MariaDB](docs/statements/mariadb.md)\
[MySQL](docs/statements/mysql.md)\
[PostgreSQL](docs/statements/postgresql.md)\
[SQLite](docs/statements/sqlite.md)\
[TransactSQL](docs/statements/transactsql.md)