# MariaDB Table

```php
use MichaelRushton\SQL\SQL;

$table = SQL::MariaDB->table($name);
```

## API reference

### partition
```php
$table->partition($partition);
```
```php
$table->partition([$partition1, $partition2]);
```

### forSystemTimeAsOf
```php
$table->forSystemTimeAsOf($datetime);
```

### forSystemTimeAsOfRaw
```php
$table->forSystemTimeAsOfRaw($expression);
```

### forSystemTimeBetween
```php
$table->forSystemTimeBetween($datetime_start, $datetime_end);
```

### forSystemTimeBetweenRaw
```php
$table->forSystemTimeBetweenRaw($expression_start, $expression_end);
```

### forSystemTimeFrom
```php
$table->forSystemTimeFrom($datetime_start, $datetime_end);
```

### forSystemTimeFromRaw
```php
$table->forSystemTimeFromRaw($expression_start, $expression_end);
```

### forSystemTimeAll
```php
$table->forSystemTimeAll();
```

### forPortionOf
```php
$table->forPortionOf($date_period, $datetime_start, $datetime_end);
```

### beforeSystemTime
```php
$table->beforeSystemTime($datetime);
```

### beforeSystemTimeRaw
```php
$table->beforeSystemTimeRaw($datetime);
```

### as
```php
$table->as($alias);
```

### useIndex
```php
$table->useIndex();
```
```php
$table->useIndex($index);
```
```php
$table->useIndex([$index1, $index2]);
```

### useIndexForOrderBy
```php
$table->useIndexForOrderBy();
```
```php
$table->useIndexForOrderBy($index);
```
```php
$table->useIndexForOrderBy([$index1, $index2]);
```

### useIndexForGroupBy
```php
$table->useIndexForGroupBy();
```
```php
$table->useIndexForGroupBy($index);
```
```php
$table->useIndexForGroupBy([$index1, $index2]);
```

### ignoreIndex
```php
$table->ignoreIndex($index);
```
```php
$table->ignoreIndex([$index1, $index2]);
```

### ignoreIndexForOrderBy
```php
$table->ignoreIndexForOrderBy($index);
```
```php
$table->ignoreIndexForOrderBy([$index1, $index2]);
```

### ignoreIndexForGroupBy
```php
$table->ignoreIndexForGroupBy($index);
```
```php
$table->ignoreIndexForGroupBy([$index1, $index2]);
```

### forceIndex
```php
$table->forceIndex($index);
```
```php
$table->forceIndex([$index1, $index2]);
```

### forceIndexForOrderBy
```php
$table->forceIndexForOrderBy($index);
```
```php
$table->forceIndexForOrderBy([$index1, $index2]);
```

### forceIndexForGroupBy
```php
$table->forceIndexForGroupBy($index);
```
```php
$table->forceIndexForGroupBy([$index1, $index2]);
```