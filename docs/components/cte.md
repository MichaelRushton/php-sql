# PHP-SQL

## CTE documentation

```php
use MichaelRushton\SQL\Components\CTE;
use MichaelRushton\SQL\SQL;

$stmt = SQL::SQLite->select()
->with("cte", "SELECT * FROM t2", function (CTE $cte)
{

})
->from("t1");
// WITH cte AS (SELECT * FROM t2) SELECT * FROM t1
```

### columns

```php
$cte->columns("c1");
// cte (c1)
```

```php
$cte->columns(["c1", "c2"]);
// cte (c1, c2)
```

### materialized

`PostgreSQL` and `SQLite` only.

```php
$cte->materialized();
// AS MATERIALIZED
```

### notMaterialized

`PostgreSQL` and `SQLite` only.

```php
$cte->notMaterialized();
// AS NOT MATERIALIZED
```

### cycleRestrict

`MariaDB` only.

```php
$cte->cycleRestrict("c1");
// CYCLE c1 RESTRICT
```

Multiple columns.

```php
$cte->cycleRestrict(["c1", "c2"]);
// CYCLE c1, c2 RESTRICT
```

### searchBreadth

`PostgreSQL` only.

```php
$cte->searchBreadth("c1", "ordercol");
// SEARCH BREADTH FIRST BY c1 SET ordercol
```

```php
$cte->searchBreadth(["c1", "c2"], "ordercol");
// SEARCH BREADTH FIRST BY c1, c2 SET ordercol
```

### searchDepth

`PostgreSQL` only.

```php
$cte->searchDepth("c1", "ordercol");
// SEARCH DEPTH FIRST BY c1 SET ordercol
```

```php
$cte->searchDepth(["c1", "c2"], "ordercol");
// SEARCH DEPTH FIRST BY c1, c2 SET ordercol
```

### cycle

`PostgreSQL` only.

```php
$cte->cycle("c1");
// CYCLE c1 SET is_cycle USING path
```

```php
$cte->cycle("c1", "a", "b");
// CYCLE c1 SET a USING b
```

```php
$cte->cycle(["c1", "c2"]);
// CYCLE c1 SET is_cycle USING path
```
