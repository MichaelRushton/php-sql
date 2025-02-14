# PostgreSQL CTE

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$cte = SQL::PostgreSQL->cte($name, function (Select $stmt)
{

});
```
See also [Select](../../statements/postgresql/select.md).

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

### searchBreadth
```php
$cte->searchBreadth($column, $set);
```
```php
$cte->searchBreadth([$column, $column2], $set);
```

### searchDepth
```php
$cte->searchDepth($column, $set);
```
```php
$cte->searchDepth([$column, $column2], $set);
```

### cycle
```php
$cte->cycle($column, $set, $using);
```
```php
$cte->cycle([$column1, $column2], $set, $using);
```