# PHP-SQL
A PHP library to generate SQL statement strings using a fluent interface.

See also https://github.com/MichaelRushton/php-db for an extension that provides a PDO wrapper.

## Installation
```bash
composer require michaelrushton/sql
```

## Documentation

### Supported dialects
```php
use MichaelRushton\SQL\SQL;

SQL::MariaDB
SQL::MySQL
SQL::PostgreSQL
SQL::SQLite
SQL::TransactSQL
```

#### DELETE example
See [DELETE documentation](docs/statements/delete.md).
```php
echo $stmt = SQL::SQLite->delete()
->from("users")
->where("email_address", "john@example.com");

// Only after casting $stmt to a string
print_r($stmt->bindings());
```
```
DELETE FROM users WHERE email_address = ?

Array
(
    [0] => john@example.com
)
```

#### INSERT example
See [INSERT documentation](docs/statements/insert.md).
```php
echo $stmt = SQL::SQLite->insert()
->into("users")
->columns(["name", "email_address"])
->values([
    ["John", "john@example.com"],
    ["Jane", "jane@example.com"],
]);

// Only after casting $stmt to a string
print_r($stmt->bindings());
```
```
INSERT INTO users (name, email_address) VALUES (?, ?), (?, ?)

Array
(
    [0] => John
    [1] => john@example.com
    [2] => Jane
    [3] => jane@example.com
)
```

#### REPLACE example
`MariaDB`, `MySQL`, and `SQLite` only.

See [REPLACE documentation](docs/statements/replace.md).
```php
echo $stmt = SQL::SQLite->replace()
->into("users")
->columns(["name", "email_address"])
->values([
    ["John", "john@example.com"],
    ["Jane", "jane@example.com"],
]);

// Only after casting $stmt to a string
print_r($stmt->bindings());
```
```
REPLACE INTO users (name, email_address) VALUES (?, ?), (?, ?)

Array
(
    [0] => John
    [1] => john@example.com
    [2] => Jane
    [3] => jane@example.com
)
```

#### SELECT example
See [SELECT documentation](docs/statements/select.md).
```php
echo $stmt = SQL::SQLite->select()
->from("users")
->where("email_address", "john@example.com");

// Only after casting $stmt to a string
print_r($stmt->bindings());
```
```
SELECT * FROM users WHERE email_address = ?

Array
(
    [0] => john@example.com
)
```

#### UPDATE example
See [UPDATE documentation](docs/statements/update.md).
```php
echo $stmt = SQL::SQLite->update()
->table("users")
->set("name", "John")
->where("email_address", "john@example.com");

// Only after casting $stmt to a string
print_r($stmt->bindings());
```
```
UPDATE users SET name = ? WHERE email_address = ?

Array
(
    [0] => John
    [1] => john@example.com
)
```