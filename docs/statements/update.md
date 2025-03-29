# PHP-SQL

## UPDATE documentation

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
// WITH cte (c1) AS (SELECT * FROM t1) UPDATE
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
// UPDATE LOW_PRIORITY
```

### ignore
`MariaDB` and `MySQL` only.
```php
$stmt->ignore();
// UPDATE IGNORE
```

### orFail
`SQLite` only.
```php
$stmt->orFail();
// UPDATE OR FAIL
```

### orIgnore
`SQLite` only.
```php
$stmt->orIgnore();
// UPDATE OR IGNORE
```

### orReplace
`SQLite` only.
```php
$stmt->orReplace();
// UPDATE OR REPLACE
```

### orRollBack
`SQLite` only.
```php
$stmt->orRollBack();
// UPDATE OR ROLLBACK
```

### top
`TransactSQL` only.
```php
$stmt->top(10);
// UPDATE TOP (10)
```

### percent
`TransactSQL` only.
```php
$stmt->top(10)
->percent();
// UPDATE TOP (10) PERCENT
```

### table
```php
$stmt->table("t1");
// UPDATE t1
```
```php
$stmt->table(["t1", "t2"]);
// UPDATE t1, t2
```

### join
See [Select documentation](select.md#join).

### set
```php
$stmt->set("c1", 1);
// SET c1 = ?
```
```php
$stmt->set([
  "c1" => 1,
  "c2" => 2,
]);
// SET c1 = ?, c2 = ?
```

### output
`TransactSQL` only.
```php
$stmt->output("INSERTED.*");
// OUTPUT INSERTED.*
```
```php
$stmt->output("DELETED.c1");
// OUTPUT v.c1
```
```php
$stmt->output(["INSERTED.c1", "DELETED.c1"]);
// OUTPUT INSERTED.c1, DELETED.c1
```

### from
See [Select documentation](select.md#from).

### where
See [Select documentation](select.md#where).

### whereCurrentOf
`PostgreSQL` and `TransactSQL` only.
```php
$stmt->whereCurrentOf("cursor");
// WHERE CURRENT OF cursor
```

### returning
`PostgreSQL` and `SQLite` only.
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

### orderBy
See [Select documentation](select.md#orderBy).

### limit
`MariaDB`, `MySQL`, and `SQLite` only.
```php
$stmt->limit(10);
// LIMIT 10
```