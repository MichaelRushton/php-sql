# MySQL Table

```php
use MichaelRushton\SQL\SQL;

$table = SQL::MySQL->table($name);
```

## API reference

### partition
```php
$table->partition($partition);
```
```php
$table->partition([$partition1, $partition2]);
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