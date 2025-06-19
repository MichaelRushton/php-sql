# PHP-SQL

## Window documentation
`MySQL`, `PostgreSQL`, `SQLite`, and `TransactSQL` only.
```php
use MichaelRushton\SQL\Components\Window;
use MichaelRushton\SQL\SQL;

$stmt = SQL::MySQL->select()
->from("t1")
->window("w1", function (Window $window)
{

});
// SELECT * FROM t1 WINDOW w1 AS ()
```

### specName
```php
$window->specName("w2");
// w1 AS (w2)
```

### partitionBy
```php
$window->partitionBy("c1");
// PARTITION BY c1
```
```php
$window->partitionBy(["c1", "c2"]);
// PARTITION BY c1, c2
```

### orderBy
See [SELECT documentation](select.md#orderBy).

### range
```php
$window->range();
// RANGE
```

### rows
```php
$window->rows();
// ROWS
```

### groups
`PostgreSQL` and `SQLite` only.
```php
$window->groups();
// GROUPS
```

### currentRow
```php
$window->currentRow();
// CURRENT ROW
```

### unboundedPreceding
```php
$window->unboundedPreceding();
// UNBOUNDED PRECEDING
```

### unboundedFollowing
```php
$window->unboundedFollowing();
// UNBOUNDED FOLLOWING
```

### preceding
```php
$window->preceding(1);
// PRECEDING 1
```

### following
```php
$window->following(1);
// FOLLOWING 1
```

### betweenCurrentRow
```php
$window->betweenCurrentRow();
// BETWEEN CURRENT ROW
```

### betweenUnboundedPreceding
```php
$window->betweenUnboundedPreceding();
// BETWEEN UNBOUNDED PRECEDING
```

### betweenUnboundedFollowing
```php
$window->betweenUnboundedFollowing();
// BETWEEN UNBOUNDED FOLLOWING
```

### betweenPreceding
```php
$window->betweenPreceding(1);
// BETWEEN PRECEDING 1
```

### betweenFollowing
```php
$window->betweenFollowing(1);
// BETWEEN FOLLOWING 1
```

### andCurrentRow
```php
$window->andCurrentRow();
// AND CURRENT ROW
```

### andUnboundedPreceding
```php
$window->andUnboundedPreceding();
// AND UNBOUNDED PRECEDING
```

### andUnboundedFollowing
```php
$window->andUnboundedFollowing();
// AND UNBOUNDED FOLLOWING
```

### andPreceding
```php
$window->andPreceding(1);
// AND PRECEDING 1
```

### andFollowing
```php
$window->andFollowing(1);
// AND FOLLOWING 1
```

### excludeCurrentRow
`PostgreSQL` and `SQLite` only.
```php
$window->excludeCurrentRow();
// EXCLUDE CURRENT ROW
```

### excludeGroup
`PostgreSQL` and `SQLite` only.
```php
$window->excludeGroup();
// EXCLUDE GROUP
```

### excludeNoOthers
`PostgreSQL` and `SQLite` only.
```php
$window->excludeNoOthers();
// EXCLUDE NO OTHERS
```

### excludeTies
`PostgreSQL` and `SQLite` only.
```php
$window->excludeTies();
// EXCLUDE TIES
```