# MariaDB INSERT

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::MariaDB->insert();
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

### delayed
```php
$stmt->delayed();
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
See also [Table](../../services/mariadb/table.md).

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

### select
```php
use MichaelRushton\SQL\Statements\MariaDB\Select;

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
use MichaelRushton\SQL\Statements\MariaDB\Insert;

$stmt->when($condition, if_true: function (Insert $stmt)
{

}, if_false: function (Insert $stmt)
{

});
```