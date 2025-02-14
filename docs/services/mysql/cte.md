# MySQL CTE

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\MySQL\Select;

$cte = SQL::MySQL->cte($name, function (Select $stmt)
{

});
```
See also [Select](../../statements/mysql/select.md).

## API reference

### columns
```php
$cte->columns($column);
```
```php
$cte->columns([$column1, $column2]);
```