# MariaDB DELETE

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::MariaDB->delete();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### lowPriority
```php
$stmt->lowPriority();
```

### quick
```php
$stmt->quick();
```

### ignore
```php
$stmt->ignore();
```

### history
```php
$stmt->history();
```

### table
```php
$stmt->table($table);
```
```php
$stmt->table([$table1, $table2]);
```
```php
$stmt->table([$alias => $table]);
```
See also [Table](../../services/mariadb/table.md).

### from
```php
$stmt->from($table);
```
```php
$stmt->from([$table1, $table2]);
```
```php
$stmt->from([$alias => $table]);
```
See also [Table](../../services/mariadb/table.md) and [Subquery](../../services/mariadb/subquery.md).

### using
```php
$stmt->using($table);
```
```php
$stmt->using([$table1, $table2]);
```
```php
$stmt->using([$alias => $table]);
```
See also [Table](../../services/mariadb/table.md).

### join (using)
```php
$stmt->join($table, $column);
```
```php
$stmt->join($table, [$column1, $column2]);
```

### join (on)
```php
$stmt->join($table, $column1, $column2);
```
```php
$stmt->join($table, $column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$stmt->join(function (Join $join)
{

});
```
See also [Join](../../services/join.md).

### leftJoin (using)
```php
$stmt->leftJoin($table, $column);
```
```php
$stmt->leftJoin($table, [$column1, $column2]);
```

### leftJoin (on)
```php
$stmt->leftJoin($table, $column1, $column2);
```
```php
$stmt->leftJoin($table, $column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$stmt->leftJoin(function (Join $join)
{

});
```
See also [Join](../../services/join.md).

### rightJoin (using)
```php
$stmt->rightJoin($table, $column);
```
```php
$stmt->rightJoin($table, [$column1, $column2]);
```

### rightJoin (on)
```php
$stmt->rightJoin($table, $column1, $column2);
```
```php
$stmt->rightJoin($table, $column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$stmt->rightJoin(function (Join $join)
{

});
```
See also [Join](../../services/join.md).

### straightJoin (using)
```php
$stmt->straightJoin($table, $column);
```
```php
$stmt->straightJoin($table, [$column1, $column2]);
```

### straightJoin (on)
```php
$stmt->straightJoin($table, $column1, $column2);
```
```php
$stmt->straightJoin($table, $column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$stmt->straightJoin(function (Join $join)
{

});
```
See also [Join](../../services/join.md).

### crossJoin
```php
$stmt->crossJoin($table);
```
```php
$stmt->crossJoin([$table1, $table2]);
```

### naturalJoin
```php
$stmt->naturalJoin($table);
```
```php
$stmt->naturalJoin([$table1, $table2]);
```

### naturalLeftJoin
```php
$stmt->naturalLeftJoin($table);
```
```php
$stmt->naturalLeftJoin([$table1, $table2]);
```

### naturalRightJoin
```php
$stmt->naturalRightJoin($table);
```
```php
$stmt->naturalRightJoin([$table1, $table2]);
```

### where
```php
$stmt->where($column, $value);
```
```php
$stmt->where($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$stmt->where(function (Where $where)
{

});
```
See also [Subquery](../../services/mariadb/subquery.md).

### orWhere
```php
$stmt->orWhere($column, $value);
```
```php
$stmt->orWhere($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$stmt->orWhere(function (Where $where)
{

});
```
See also [Subquery](../../services/mariadb/subquery.md).

### whereNot
```php
$stmt->whereNot($column, $value);
```
```php
$stmt->whereNot($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$stmt->whereNot(function (Where $where)
{

});
```
See also [Subquery](../../services/mariadb/subquery.md).

### orWhereNot
```php
$stmt->orWhereNot($column, $value);
```
```php
$stmt->orWhereNot($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$stmt->orWhereNot(function (Where $where)
{

});
```
See also [Subquery](../../services/mariadb/subquery.md).

### whereBetween
```php
$stmt->whereBetween($column, $value1, $value2);
```

### orWhereBetween
```php
$stmt->orWhereBetween($column, $value1, $value2);
```

### whereNotBetween
```php
$stmt->whereNotBetween($column, $value1, $value2);
```

### orWhereNotBetween
```php
$stmt->orWhereNotBetween($column, $value1, $value2);
```

### whereRaw
```php
$stmt->whereRaw($expression, $bindings);
```

### orWhereRaw
```php
$stmt->orWhereRaw($expression, $bindings);
```

### whereNotRaw
```php
$stmt->whereNotRaw($expression, $bindings);
```

### orWhereNotRaw
```php
$stmt->orWhereNotRaw($expression, $bindings);
```

### orderBy
```php
$stmt->orderBy($column);
```
```php
$stmt->orderBy([$column1, $column2]);
```

### orderByDesc
```php
$stmt->orderByDesc($column);
```
```php
$stmt->orderByDesc([$column1, $column2]);
```

### orderByRaw
```php
$stmt->orderByRaw($expression, $bindings);
```

### orderByDescRaw
```php
$stmt->orderByDescRaw($expression, $bindings);
```

### limit
```php
$stmt->limit($row_count);
```

### returning
```php
$stmt->returning();
```
```php
$stmt->returning($column);
```
```php
$stmt->returning([$column1, $column2]);
```
```php
$stmt->returning([$alias => $column]);
```

### returningRaw
```php
$stmt->returningRaw($expression, $bindings);
```

### when
```php
use MichaelRushton\SQL\Statements\MariaDB\Delete;

$stmt->when($condition, if_true: function (Delete $stmt)
{

}, if_false: function (Delete $stmt)
{

});
```