# SQLite REPLACE

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::SQLite->replace();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### with
```php
use MichaelRushton\SQL\Services\SQLite\CTE;
use MichaelRushton\SQL\Statements\SQLite\Select;

$stmt->with($name, function (Select $stmt)
{

}, function (CTE $cte)
{

});
```
See also [Select](select.md) and [CTE](../../services/sqlite/cte.md).

### into
```php
$stmt->into($table);
```
See also [Table](../../services/sqlite/table.md).

### columns
```php
$stmt->columns($column);
```
```php
$stmt->columns([$column1, $column2]);
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
use MichaelRushton\SQL\Statements\SQLite\Select;

$stmt->select(function (Select $stmt)
{

});
```
See also [Select](select.md).

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
use MichaelRushton\SQL\Statements\SQLite\Insert;

$stmt->when($condition, if_true: function (Insert $stmt)
{

}, if_false: function (Insert $stmt)
{

});
```