# Transact-SQL INSERT

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::TransactSQL->insert();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### with
```php
use MichaelRushton\SQL\Services\TransactSQL\CTE;
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$stmt->with($name, function (Select $stmt)
{

}, function (CTE $cte)
{

});
```
See also [Select](select.md) and [CTE](../../services/transactsql/cte.md).

### top
```php
$stmt->top($row_count);
```

### percent
```php
$stmt->percent();
```

### into
```php
$stmt->into($table);
```
See also [Table](../../services/transactsql/table.md).

### columns
```php
$stmt->columns($column);
```
```php
$stmt->columns([$column1, $column2]);
```

### output
```php
$stmt->output();
```
```php
$stmt->output($column);
```
```php
$stmt->output([$column1, $column2]);
```
```php
$stmt->output([$alias => $column]);
```

### outputRaw
```php
$stmt->outputRaw($expression, $bindings);
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

### select
```php
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$stmt->select(function (Select $stmt)
{

});
```
See also [Select](select.md).

### when
```php
use MichaelRushton\SQL\Statements\TransactSQL\Insert;

$stmt->when($condition, if_true: function (Insert $stmt)
{

}, if_false: function (Insert $stmt)
{

});
```