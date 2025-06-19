# PHP-SQL

## REPLACE documentation

`MariaDB`, `MySQL`, and `SQLite` only.

### with
See [SELECT documentation](select.md) and [CTE documentation](../components/cte.md).

`SQLite` only.
```php
use MichaelRushton\SQL\Components\CTE;
use MichaelRushton\SQL\Statements\Select;

$stmt->with(
  "cte",
  fn (Select $select) => $select->from("t1"),
  fn (CTE $cte) => $cte->columns("c1")
);
// WITH cte (c1) AS (SELECT * FROM t1) REPLACE
```

### recursive
`SQLite` only.
```php
$stmt->with("cte", "SELECT * FROM t1")
->recursive();
// WITH RECURSIVE cte AS (SELECT * FROM t1)
```

### lowPriority
`MariaDB` and `MySQL` only.
```php
$stmt->lowPriority();
// REPLACE LOW_PRIORITY
```

### delayed
`MariaDB` only.
```php
$stmt->delayed();
// REPLACE DELAYED
```

### into
```php
$stmt->into("t1");
// REPLACE INTO t1
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
// REPLACE INTO t1 SELECT * FROM t2
```

### set
See [Update documentation](update.md#set).

### returning
`MariaDB` and `SQLite` only.
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