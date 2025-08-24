# PHP-SQL

## Subquery documentation

```php
use MichaelRushton\SQL\Components\Subquery;
use MichaelRushton\SQL\SQL;

$subquery = SQL::SQLite->select()
->from("t1")
->toSubquery();
// (SELECT * FROM t1)
```

### all

`MariaDB`, `MySQL`, `PostgreSQL`, and `TransactSQL` only.

```php
$subquery->all();
// ALL (SELECT ...)
```

### any

`MariaDB`, `MySQL`, `PostgreSQL`, and `TransactSQL` only.

```php
$subquery->any();
// ANY (SELECT ...)
```

### exists

```php
$subquery->exists();
// EXISTS (SELECT ...)
```

### in

```php
$subquery->in();
// IN (SELECT ...)
```

### lateral

`MySQL` and `PostgreSQL` only.

```php
$subquery->lateral();
// LATERAL (SELECT ...)
```

### as

```php
$subquery->as("s1");
// (SELECT ...) AS s1
```

### columns

`MariaDB`, `MySQL`, `PostgreSQL`, and `TransactSQL` only.

```php
$subquery->columns("c1");
// (SELECT ...) (c1)
```

```php
$subquery->columns(["c1", "c2"]);
// (SELECT ...) (c1, c2)
```
