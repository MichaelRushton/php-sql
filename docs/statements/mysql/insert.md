# MySQL INSERT

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::MySQL->insert();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### lowPriority
```php
$stmt->lowPriority();
```

### highPriority
```php
$stmt->highPriority();
```

### ignore
```php
$stmt->ignore();
```

### into
```php
$stmt->into($table);
```
See also [Table](../../services/mysql/table.md).

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

### set
```php
$stmt->set($column, $value);
```
```php
$stmt->set([
    $column1 => $value1,
    $column2 => $value2,
]);
```

### setRaw
```php
$stmt->setRaw($column, $expression, $bindings);
```

### as
```php
$stmt->as($row_alias);
```
```php
$stmt->as($row_alias, $column_alias);
```
```php
$stmt->as($row_alias, [$column_alias1, $column_alias2]);
```

### select
```php
use MichaelRushton\SQL\Statements\MySQL\Select;

$stmt->select(function (Select $stmt)
{

});
```
See also [Select](select.md).

### onDuplicateKeyUpdate
```php
$stmt->onDuplicateKeyUpdate($column, $value);
```
```php
$stmt->onDuplicateKeyUpdate([
    $column1 => $value1,
    $column2 => $value2,
]);
```

### onDuplicateKeyUpdateRaw
```php
$stmt->onDuplicateKeyUpdateRaw($column, $expression, $bindings);
```

### when
```php
use MichaelRushton\SQL\Statements\MySQL\Insert;

$stmt->when($condition, if_true: function (Insert $stmt)
{

}, if_false: function (Insert $stmt)
{

});
```