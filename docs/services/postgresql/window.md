# PostgreSQL Window

```php
use MichaelRushton\SQL\Services\Window;

$stmt->window(function (Window $window)
{

});
```

## API reference

### specName
```php
$window->specName($name);
```

### partitionBy
```php
$window->partitionBy($column);
```
```php
$window->partitionBy([$column1, $column2]);
```

### partitionByRaw
```php
$window->partitionByRaw($expression, $bindings);
```

### orderBy
```php
$window->orderBy($column);
```
```php
$window->orderBy([$column1, $column2]);
```

### orderByDesc
```php
$window->orderByDesc($column);
```
```php
$window->orderByDesc([$column1, $column2]);
```

### orderByNullsFirst
```php
$window->orderByNullsFirst($column);
```
```php
$window->orderByNullsFirst([$column1, $column2]);
```

### orderByNullsLast
```php
$window->orderByNullsLast($column);
```
```php
$window->orderByNullsLast([$column1, $column2]);
```

### orderByDescNullsFirst
```php
$window->orderByDescNullsFirst($column);
```
```php
$window->orderByDescNullsFirst([$column1, $column2]);
```

### orderByDescNullsLast
```php
$window->orderByDescNullsLast($column);
```
```php
$window->orderByDescNullsLast([$column1, $column2]);
```

### orderByRaw
```php
$window->orderByRaw($expression, $bindings);
```

### orderByDescRaw
```php
$window->orderByDescRaw($expression, $bindings);
```

### orderByNullsFirstRaw
```php
$window->orderByNullsFirstRaw($expression, $bindings);
```

### orderByNullsLastRaw
```php
$window->orderByNullsLastRaw($expression, $bindings);
```

### orderByDescNullsFirstRaw
```php
$window->orderByDescNullsFirstRaw($expression, $bindings);
```

### orderByDescNullsLastRaw
```php
$window->orderByDescNullsLastRaw($expression, $bindings);
```

### range
```php
$window->range();
```

### rows
```php
$window->rows();
```

### groups
```php
$window->groups();
```

### unboundedPreceding
```php
$window->unboundedPreceding();
```

### preceding
```php
$window->preceding($expression);
```

### currentRow
```php
$window->currentRow();
```

### following
```php
$window->following($expression);
```

### unboundedFollowing
```php
$window->unboundedFollowing();
```

### betweenUnboundedPreceding
```php
$window->betweenUnboundedPreceding();
```

### betweenPreceding
```php
$window->betweenPreceding($expression);
```

### betweenCurrentRow
```php
$window->betweenCurrentRow();
```

### betweenFollowing
```php
$window->betweenFollowing($expression);
```

### betweenUnboundedFollowing
```php
$window->betweenUnboundedFollowing();
```

### andUnboundedFollowing
```php
$window->andUnboundedFollowing();
```

### andPreceding
```php
$window->andPreceding($expression);
```

### andCurrentRow
```php
$window->andCurrentRow();
```

### andFollowing
```php
$window->andFollowing($expression);
```

### andUnboundedFollowing
```php
$window->andUnboundedFollowing();
```

### excludeCurrentRow
```php
$window->excludeCurrentRow();
```

### excludeGroup
```php
$window->excludeGroup();
```

### excludeTies
```php
$window->excludeTies();
```

### excludeNoOthers
```php
$window->excludeNoOthers();
```