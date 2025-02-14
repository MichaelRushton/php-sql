# Join

```php
use MichaelRushton\SQL\Services\Join;

$stmt->join(function (Join $join)
{

});
```

## API reference

### on
```php
$join->on($column1, $column2);
```
```php
$join->on($column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$join->on(function (Join $join)
{

});
```

### orOn
```php
$join->orOn($column1, $column2);
```
```php
$join->orOn($column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$join->orOn(function (Join $join)
{

});
```

### onNot
```php
$join->onNot($column1, $column2);
```
```php
$join->onNot($column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$join->onNot(function (Join $join)
{

});
```

### orOnNot
```php
$join->orOnNot($column1, $column2);
```
```php
$join->orOnNot($column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$join->orOnNot(function (Join $join)
{

});
```

### onBetween
```php
$join->onBetween($column1, $column2, $column3);
```

### orOnBetween
```php
$join->orOnBetween($column1, $column2, $column3);
```

### onNotBetween
```php
$join->onNotBetween($column1, $column2, $column3);
```

### orOnNotBetween
```php
$join->orOnNotBetween($column1, $column2, $column3);
```

### onRaw
```php
$join->onRaw($expression, $bindings);
```

### orOnRaw
```php
$join->orOnRaw($expression, $bindings);
```

### onNotRaw
```php
$join->onNotRaw($expression, $bindings);
```

### orOnNotRaw
```php
$join->orOnNotRaw($expression, $bindings);
```