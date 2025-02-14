# MariaDB CTE

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\MariaDB\Select;

$cte = SQL::MariaDB->cte($name, function (Select $stmt)
{

});
```
See also [Select](../../statements/mariadb/select.md).

## API reference

### columns
```php
$cte->columns($column);
```
```php
$cte->columns([$column1, $column2]);
```

### cycleRestrict
```php
$cte->cycleRestrict($column);
```
```php
$cte->cycleRestrict([$column1, $column2]);
```