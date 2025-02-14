# PostgreSQL DELETE

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::PostgreSQL->delete();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### with
```php
use MichaelRushton\SQL\Services\PostgreSQL\CTE;
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->with($name, function (Select $stmt)
{

}, function (CTE $cte)
{

});
```
See also [Select](select.md) and [CTE](../../services/postgresql/cte.md).

### from
```php
$stmt->from($table);
```
```php
$stmt->from([$alias => $table]);
```
See also [Table](../../services/postgresql/table.md).

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
See also [Table](../../services/postgresql/table.md).

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

### fullJoin (using)
```php
$stmt->fullJoin($table, $column);
```
```php
$stmt->fullJoin($table, [$column1, $column2]);
```

### fullJoin (on)
```php
$stmt->fullJoin($table, $column1, $column2);
```
```php
$stmt->fullJoin($table, $column1, $operator, $column2);
```
```php
use MichaelRushton\SQL\Services\Join;

$stmt->fullJoin(function (Join $join)
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

### naturalFullJoin
```php
$stmt->naturalFullJoin($table);
```
```php
$stmt->naturalFullJoin([$table1, $table2]);
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
See also [Subquery](../../services/postgresql/subquery.md).

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
See also [Subquery](../../services/postgresql/subquery.md).

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
See also [Subquery](../../services/postgresql/subquery.md).

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
See also [Subquery](../../services/postgresql/subquery.md).

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

### whereCurrentOf
```php
$stmt->whereCurrentOf($cursor);
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
use MichaelRushton\SQL\Statements\PostgreSQL\Delete;

$stmt->when($condition, if_true: function (Delete $stmt)
{

}, if_false: function (Delete $stmt)
{

});
```