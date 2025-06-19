# PHP-SQL

## INSERT documentation

### with
See [SELECT documentation](select.md) and [CTE documentation](../components/cte.md).

`PostgreSQL`, `SQLite`, and `TransactSQL` only.
```php
use MichaelRushton\SQL\Components\CTE;
use MichaelRushton\SQL\Statements\Select;

$stmt->with(
  "cte",
  fn (Select $select) => $select->from("t1"),
  fn (CTE $cte) => $cte->columns("c1")
);
// WITH cte (c1) AS (SELECT * FROM t1) INSERT
```

### recursive
`PostgreSQL`, `SQLite`, and `TransactSQL` only.
```php
$stmt->with("cte", "SELECT * FROM t1")
->recursive();
// WITH RECURSIVE cte AS (SELECT * FROM t1)
```

### lowPriority
`MariaDB` and `MySQL` only.
```php
$stmt->lowPriority();
// INSERT LOW_PRIORITY
```

### delayed
`MariaDB` only.
```php
$stmt->delayed();
// INSERT DELAYED
```

### highPriority
`MariaDB` and `MySQL` only.
```php
$stmt->highPriority();
// INSERT HIGH_PRIORITY
```

### ignore
`MariaDB` and `MySQL` only.
```php
$stmt->ignore();
// INSERT IGNORE
```

### orFail
`SQLite` only.
```php
$stmt->orFail();
// INSERT OR FAIL
```

### orIgnore
`SQLite` only.
```php
$stmt->orIgnore();
// INSERT OR IGNORE
```

### orReplace
`SQLite` only.
```php
$stmt->orReplace();
// INSERT OR REPLACE
```

### orRollBack
`SQLite` only.
```php
$stmt->orRollBack();
// INSERT OR ROLLBACK
```

### top
`TransactSQL` only.
```php
$stmt->top(10);
// INSERT TOP (10)
```

### percent
`TransactSQL` only.
```php
$stmt->top(10)
->percent();
// INSERT TOP (10) PERCENT
```

### into
```php
$stmt->into("t1");
// INSERT INTO t1
```

### columns
```php
$stmt->columns("c1");
// (c1)
```
```php
$stmt->columns(["c1", "c2"]);
// (c1, c2)
```

### overridingSystemValue
`PostgreSQL` only.
```php
$stmt->overridingSystemValue();
// OVERRIDING SYSTEM VALUE
```

### overridingUserValue
`PostgreSQL` only.
```php
$stmt->overridingUserValue();
// OVERRIDING USER VALUE
```

### output
`TransactSQL` only.
```php
$stmt->output("INSERTED.*");
// OUTPUT INSERTED.*
```
```php
$stmt->output("INSERTED.c1");
// OUTPUT INSERTED.c1
```
```php
$stmt->output(["INSERTED.c1", "INSERTED.c2"]);
// OUTPUT INSERTED.c1, INSERTED.c2
```

### values
```php
$stmt->values([1, 2]);
// VALUES (?, ?)
```
```php
$stmt->values([
  [1, 2],
  [3, 4],
]);
// VALUES (?, ?), (?, ?)
```
```php
$stmt->values([
  "c1" => 1,
  "c2" => 2,
]);
// (c1, c2) VALUES (?, ?)
```
```php
$stmt->values([[
  "c1" => 1,
  "c2" => 2,
], [
  "c1" => 3,
  "c2" => 4,
]]);
// (c1, c2) VALUES (?, ?), (?, ?)
```
See [SELECT documentation](select.md).
```php
use MichaelRushton\SQL\Statements\Select;

$stmt->into("t1")
->select(function (Select $select)
{
  $select->from("t2");
});
// INSERT INTO t1 SELECT * FROM t2
```

### set
See [Update documentation](update.md#set).

### as
`MySQL` only.
```php
$stmt->as("new");
// AS new
```
```php
$stmt->as("new", "a");
// AS new (a)
```
```php
$stmt->as("new", ["a", "b"]);
// AS new (a, b)
```

### onDuplicateKeyUpdate
`MariaDB` and `MySQL` only.
```php
$stmt->onDuplicateKeyUpdate("c1", 1);
// ON DUPLICATE KEY UPDATE c1 = ?
```
```php
$stmt->onDuplicateKeyUpdate([
  "c1" => 1,
  "c2" => 2,
]);
// ON DUPLICATE KEY UPDATE c1 = ?, c2 = ?
```

### onConflictDoNothing
See [Upsert documentation](../components/upsert.md).

`PostgreSQL` and `SQLite` only.
```php
use MichaelRushton\SQL\Components\Upsert;

$stmt->onConflictDoNothing(function (Upsert $upsert)
{

});
// ON CONFLICT DO NOTHING
```

### onConflictDoUpdateSet
See [Upsert documentation](../components/upsert.md).

`PostgreSQL` and `SQLite` only.
```php
use MichaelRushton\SQL\Components\Upsert;

$stmt->onConflictDoUpdateSet("c1", 1, function (Upsert $upsert)
{

});
// ON CONFLICT DO UPDATE SET c1 = ?
```
```php
use MichaelRushton\SQL\Components\Upsert;

$stmt->onConflictDoUpdateSet([
  "c1" => 1,
  "c2" => 2,
], function (Upsert $upsert)
{

});
// ON CONFLICT DO UPDATE SET c1 = ?, c2 = ?
```

### returning
`MariaDB`, `PostgreSQL`, and `SQLite` only.
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