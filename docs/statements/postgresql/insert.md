# PostgreSQL INSERT

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::PostgreSQL->insert();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### with
```php
use MichaelRushton\SQL\Services\PostgreSQL\CTE;
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->with($name, function (Select $stmt)
{

}, function (CTE $cte)
{

});
```
See also [Select](select.md) and [CTE](../../services/postgresql/cte.md).

### into
```php
$stmt->into($table);
```
See also [Table](../../services/postgresql/table.md).

### columns
```php
$stmt->columns($column);
```
```php
$stmt->columns([$column1, $column2]);
```

### overridingSystemValue
```php
$stmt->overridingSystemValue();
```

### overridingUserValue
```php
$stmt->overridingUserValue();
```

### values
```php
$stmt->values([$value1, $value2]);
```
```php
$stmt->values([
    $column1 => $value1,
    $column2 => $value2,
]);
```
```php
$stmt->values([
    [$value1, $value2],
    [$value3, $value4],
]);
```

### select
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->select(function (Select $stmt)
{

});
```
See also [Select](select.md).

### onConflictDoNothing
```php
use MichaelRushton\SQL\Services\Upsert;

$stmt->onConflictDoNothing(function (Upsert $upsert)
{

});
```
See also [Upsert](../../services/postgresql/upsert.md).

### onConflictDoUpdateSet
```php
use MichaelRushton\SQL\Services\Upsert;

$stmt->onConflictDoUpdateSet($column, $value, function (Upsert $upsert)
{

});
```
```php
$stmt->onConflictDoUpdateSet([
    $column1 => $value1,
    $column2 => $value2,
], function (Upsert $upsert)
{

});
```
See also [Upsert](../../services/postgresql/upsert.md).

### onConflictDoUpdateSetRaw
```php
use MichaelRushton\SQL\Services\Upsert;

$stmt->onConflictDoUpdateSetRaw($column, $expression, $bindings, function (Upsert $upsert)
{

});
```
See also [Upsert](../../services/postgresql/upsert.md).

### returning
```php
$stmt->returning();
```
```php
$stmt->returning($column);
```
```php
$stmt->returning([$column1, $column2]);
```
```php
$stmt->returning([$alias => $column]);
```

### returningRaw
```php
$stmt->returningRaw($expression, $bindings);
```

### when
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Insert;

$stmt->when($condition, if_true: function (Insert $stmt)
{

}, if_false: function (Insert $stmt)
{

});
```