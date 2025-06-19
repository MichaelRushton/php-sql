# PHP-SQL

## DELETE documentation

### with
See [SELECT documentation](select.md) and [CTE documentation](../components/cte.md).

`MySQL`, `PostgreSQL`, `SQLite`, and `TransactSQL` only.
```php
use MichaelRushton\SQL\Components\CTE;
use MichaelRushton\SQL\Statements\Select;

$stmt->with(
  "cte",
  fn (Select $select) => $select->from("t1"),
  fn (CTE $cte) => $cte->columns("c1")
);
// WITH cte (c1) AS (SELECT * FROM t1) DELETE
```

### recursive
`MySQL`, `PostgreSQL`, `SQLite`, and `TransactSQL` only.
```php
$stmt->with("cte", "SELECT * FROM t1")
->recursive();
// WITH RECURSIVE cte AS (SELECT * FROM t1)
```

### lowPriority
`MariaDB` and `MySQL` only.
```php
$stmt->lowPriority();
// DELETE LOW_PRIORITY
```

### quick
`MariaDB` and `MySQL` only.
```php
$stmt->quick();
// DELETE QUICK
```

### ignore
`MariaDB` and `MySQL` only.
```php
$stmt->ignore();
// DELETE IGNORE
```

### top
`TransactSQL` only.
```php
$stmt->top(10);
// DELETE TOP (10)
```

### percent
`TransactSQL` only.
```php
$stmt->top(10)
->percent();
// DELETE TOP (10) PERCENT
```

### table
```php
$stmt->table("t1");
// DELETE t1
```
```php
$stmt->table(["t1", "t2"]);
// DELETE t1, t2
```

### output
`TransactSQL` only.
```php
$stmt->output("DELETED.*");
// OUTPUT DELETED.*
```
```php
$stmt->output("DELETED.c1");
// OUTPUT v.c1
```
```php
$stmt->output(["DELETED.c1", "DELETED.c2"]);
// OUTPUT DELETED.c1, DELETED.c2
```

### from
See [Select documentation](select.md#from).

### using
```php
$stmt->using("t1");
// USING t1
```
```php
$stmt->using(["t1", "t2"]);
// USING t1, t2
```

### join
See [Select documentation](select.md#join).

### where
See [Select documentation](select.md#where).

### whereCurrentOf
`PostgreSQL` and `TransactSQL` only.
```php
$stmt->whereCurrentOf("cursor");
// WHERE CURRENT OF cursor
```

### orderBy
See [Select documentation](select.md#orderBy).

### limit
`MariaDB`, `MySQL`, and `SQLite` only.
```php
$stmt->limit(10);
// LIMIT 10
```

### returning
`MariaDB`, `PostgreSQL` and `SQLite` only.
```php
$stmt->returning();
// RETURNING *
```
```php
$stmt->returning("c1");
// RETURNING c1
```
```php
$stmt->returning(["c1", "c2"]);
// RETURNING c1, c2
```