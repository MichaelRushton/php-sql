# Transact-SQL Subquery

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$subquery = SQL::TransactSQL->subquery(function (Select $stmt)
{

});
```
See also [Select](../../statements/transactsql/select.md).

## API reference

### all
```php
$subquery->all();
```

### any
```php
$subquery->any();
```

### exists
```php
$subquery->exists();
```

### in
```php
$subquery->in();
```

### as
```php
$subquery->as($alias);
```

### columns
```php
$subquery->columns($column);
```
```php
$subquery->columns([$column1, $column2]);
```