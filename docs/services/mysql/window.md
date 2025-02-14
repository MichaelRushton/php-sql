# MySQL Window

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

### orderByRaw
```php
$window->orderByRaw($expression, $bindings);
```

### orderByDescRaw
```php
$window->orderByDescRaw($expression, $bindings);
```

### rows
```php
$window->rows();
```

### range
```php
$window->range();
```

### currentRow
```php
$window->currentRow();
```

### unboundedPreceding
```php
$window->unboundedPreceding();
```

### unboundedFollowing
```php
$window->unboundedFollowing();
```

### preceding
```php
$window->preceding($expression);
```

### following
```php
$window->following($expression);
```

### betweenCurrentRow
```php
$window->betweenCurrentRow();
```

### betweenUnboundedPreceding
```php
$window->betweenUnboundedPreceding();
```

### betweenUnboundedFollowing
```php
$window->betweenUnboundedFollowing();
```

### betweenPreceding
```php
$window->betweenPreceding($expression);
```

### betweenFollowing
```php
$window->betweenFollowing($expression);
```

### andCurrentRow
```php
$window->andCurrentRow();
```

### andUnboundedPreceding
```php
$window->andUnboundedPreceding();
```

### andUnboundedFollowing
```php
$window->andUnboundedFollowing();
```

### andPreceding
```php
$window->andPreceding($expression);
```

### andFollowing
```php
$window->andFollowing($expression);
```