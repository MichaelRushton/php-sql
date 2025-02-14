# MariaDB Subquery

```php
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\MariaDB\Select;

$subquery = SQL::MariaDB->subquery(function (Select $stmt)
{

});
```
See also [Select](../../statements/mariadb/select.md).

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

### forSystemTimeAsOf
```php
$subquery->forSystemTimeAsOf($datetime);
```

### forSystemTimeAsOfRaw
```php
$subquery->forSystemTimeAsOfRaw($expression);
```

### forSystemTimeBetween
```php
$subquery->forSystemTimeBetween($datetime_start, $datetime_end);
```

### forSystemTimeBetweenRaw
```php
$subquery->forSystemTimeBetweenRaw($expression_start, $expression_end);
```

### forSystemTimeFrom
```php
$subquery->forSystemTimeFrom($datetime_start, $datetime_end);
```

### forSystemTimeFromRaw
```php
$subquery->forSystemTimeFromRaw($expression_start, $expression_end);
```

### forSystemTimeAll
```php
$subquery->forSystemTimeAll();
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