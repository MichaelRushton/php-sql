# Transact-SQL CTE

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$cte = SQL::TransactSQL->cte($name, function (Select $stmt)
{

});
```
See also [Select](../../statements/transactsql/select.md).

## API reference

### columns
```php
$cte->columns($column);
```
```php
$cte->columns([$column1, $column2]);
```