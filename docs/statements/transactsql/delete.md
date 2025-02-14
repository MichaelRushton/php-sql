# Transact-SQL DELETE

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::TransactSQL->delete();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### with
```php
use MichaelRushton\SQL\Services\TransactSQL\CTE;
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$stmt->with($name, function (Select $stmt)
{

}, function (CTE $cte)
{

});
```
See also [Select](select.md) and [CTE](../../services/transactsql/cte.md).

### top
```php
$stmt->top($row_count);
```

### percent
```php
$stmt->percent();
```

### table
```php
$stmt->table($table);
```
```php
$stmt->table([$alias => $table]);
```
See also [Table](../../services/transactsql/table.md).

### output
```php
$stmt->output();
```
```php
$stmt->output($column);
```
```php
$stmt->output([$column1, $column2]);
```
```php
$stmt->output([$alias => $column]);
```

### outputRaw
```php
$stmt->outputRaw($expression, $bindings);
```

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
See also [Table](../../services/transactsql/table.md).

### join
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

### leftJoin
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

### rightJoin
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

### fullJoin
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
See also [Subquery](../../services/transactsql/subquery.md).

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
See also [Subquery](../../services/transactsql/subquery.md).

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
See also [Subquery](../../services/transactsql/subquery.md).

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
See also [Subquery](../../services/transactsql/subquery.md).

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

### when
```php
use MichaelRushton\SQL\Statements\TransactSQL\Delete;

$stmt->when($condition, if_true: function (Delete $stmt)
{

}, if_false: function (Delete $stmt)
{

});
```