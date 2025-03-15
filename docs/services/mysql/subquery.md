# MySQL Subquery

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\MySQL\Select;

$subquery = SQL::MySQL->subquery(function (Select $stmt)
{

});
```
See also [Select](../../statements/mysql/select.md).

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

### lateral
```php
$subquery->lateral();
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