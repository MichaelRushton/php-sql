# SQLite Subquery

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\SQLite\Select;

$subquery = SQL::SQLite->subquery(function (Select $stmt)
{

});
```
See also [Select](../../statements/sqlite/select.md).

## API reference

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