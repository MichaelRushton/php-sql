# PHP-SQL

## Table documentation

```php
use MichaelRushton\SQL\Components\Table;

$table = new Table("t1");
// t1
```

### only

`PostgreSQL` only.

```php
$table->only();
// ONLY t1
```

### partition

`MariaDB` and `MySQL` only.

```php
$table->partition("p1");
// t1 PARTITION (p1)
```

```php
$table->partition(["p1", "p2"]);
// t1 PARTITION (p1, p2)
```

### forPortionOf

`MariaDB` only.

```php
$table->forPortionOf("date_period", "2024-01-01", "2025-01-01");
// t1 FOR PORTION OF date_period FROM '2024-01-01' TO '2025-01-01'
```

### as

```php
$table->as("t2");
// t1 AS t2
```

### useIndex

`MariaDB` and `MySQL` only.

```php
$table->useIndex();
// USE INDEX ()
```

```php
$table->useIndex("i1");
// USE INDEX (i1)
```

```php
$table->useIndex(["i1", "i2"]);
// USE INDEX (i1, i2)
```

### useIndexForOrderBy

`MariaDB` and `MySQL` only.

Automatic index.

```php
$table->useIndexForOrderBy();
// USE INDEX FOR ORDER BY ()
```

```php
$table->useIndexForOrderBy("i1");
// USE INDEX FOR ORDER BY (i1)
```

```php
$table->useIndexForOrderBy(["i1", "i2"]);
// USE INDEX FOR ORDER BY (i1, i2)
```

### useIndexForGroupBy

`MariaDB` and `MySQL` only.

Automatic index.

```php
$table->useIndexForGroupBy();
// USE INDEX FOR GROUP BY ()
```

```php
$table->useIndexForGroupBy("i1");
// USE INDEX FOR GROUP BY (i1)
```

```php
$table->useIndexForGroupBy(["i1", "i2"]);
// USE INDEX FOR GROUP BY (i1, i2)
```

### ignoreIndex

`MariaDB` and `MySQL` only.

```php
$table->ignoreIndex("i1");
// IGNORE INDEX (i1)
```

```php
$table->ignoreIndex(["i1", "i2"]);
// IGNORE INDEX (i1, i2)
```

### ignoreIndexForOrderBy

`MariaDB` and `MySQL` only.

```php
$table->ignoreIndexForOrderBy("i1");
// IGNORE INDEX FOR ORDER BY (i1)
```

```php
$table->ignoreIndexForOrderBy(["i1", "i2"]);
// IGNORE INDEX FOR ORDER BY (i1, i2)
```

### ignoreIndexForGroupBy

`MariaDB` and `MySQL` only.

```php
$table->ignoreIndexForGroupBy("i1");
// IGNORE INDEX FOR GROUP BY (i1)
```

```php
$table->ignoreIndexForGroupBy(["i1", "i2"]);
// IGNORE INDEX FOR GROUP BY (i1, i2)
```

### forceIndex

`MariaDB` and `MySQL` only.

```php
$table->forceIndex("i1");
// FORCE INDEX (i1)
```

```php
$table->forceIndex(["i1", "i2"]);
// FORCE INDEX (i1, i2)
```

### forceIndexForOrderBy

`MariaDB` and `MySQL` only.

```php
$table->forceIndexForOrderBy("i1");
// FORCE INDEX FOR ORDER BY (i1)
```

```php
$table->forceIndexForOrderBy(["i1", "i2"]);
// FORCE INDEX FOR ORDER BY (i1, i2)
```

### forceIndexForGroupBy

`MariaDB` and `MySQL` only.

```php
$table->forceIndexForGroupBy("i1");
// FORCE INDEX FOR GROUP BY (i1)
```

```php
$table->forceIndexForGroupBy(["i1", "i2"]);
// FORCE INDEX FOR GROUP BY (i1, i2)
```
