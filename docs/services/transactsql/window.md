# Transact-SQL Window

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

### andUnboundedFollowing
```php
$window->andUnboundedFollowing();
```

### andFollowing
```php
$window->andFollowing($expression);
```

### andCurrentRow
```php
$window->andCurrentRow();
```