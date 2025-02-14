# SQLite CTE

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\SQLite\Select;

$cte = SQL::SQLite->cte($name, function (Select $stmt)
{

});
```
See also [Select](../../statements/sqlite/select.md).

## API reference

### columns
```php
$cte->columns($column);
```
```php
$cte->columns([$column1, $column2]);
```

### materialized
```php
$cte->materialized();
```

### notMaterialized
```php
$cte->notMaterialized();
```