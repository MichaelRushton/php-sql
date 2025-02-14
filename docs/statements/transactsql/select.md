# Transact-SQL SELECT

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::TransactSQL->select();
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
See also [CTE](../../services/transactsql/cte.md).

### recursive
```php
$stmt->recursive();
```

### distinct
```php
$stmt->distinct();
```

### top
```php
$stmt->top($row_count);
```

### percent
```php
$stmt->percent();
```

### withTies
```php
$stmt->withTies();
```

### select
```php
$stmt->select($column);
```
```php
$stmt->select([$column1, $column2]);
```
```php
$stmt->select([$alias => $column]);
```
See also [Subquery](../../services/transactsql/subquery.md).

### selectRaw
```php
$stmt->selectRaw($expression, $bindings);
```

### into
```php
$stmt->into($table);
```
See also [Table](../../services/transactsql/table.md).

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
See also [Table](../../services/transactsql/table.md) and [Subquery](../../services/transactsql/subquery.md).

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

### groupBy
```php
$stmt->groupBy($column);
```
```php
$stmt->groupBy([$column1, $column2]);
```

### groupByRaw
```php
$stmt->groupByRaw($expression, $bindings);
```

### having
```php
$stmt->having($column, $value);
```
```php
$stmt->having($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Having;

$stmt->having(function (Having $having)
{

});
```
See also [Subquery](../../services/transactsql/subquery.md).

### orHaving
```php
$stmt->orHaving($column, $value);
```
```php
$stmt->orHaving($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Having;

$stmt->orHaving(function (Having $having)
{

});
```
See also [Subquery](../../services/transactsql/subquery.md).

### havingNot
```php
$stmt->havingNot($column, $value);
```
```php
$stmt->havingNot($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Having;

$stmt->havingNot(function (Having $having)
{

});
```
See also [Subquery](../../services/transactsql/subquery.md).

### orHavingNot
```php
$stmt->orHavingNot($column, $value);
```
```php
$stmt->orHavingNot($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Having;

$stmt->orHavingNot(function (Having $having)
{

});
```
See also [Subquery](../../services/transactsql/subquery.md).

### havingBetween
```php
$stmt->havingBetween($column, $value1, $value2);
```

### orHavingBetween
```php
$stmt->orHavingBetween($column, $value1, $value2);
```

### havingNotBetween
```php
$stmt->havingNotBetween($column, $value1, $value2);
```

### orHavingNotBetween
```php
$stmt->orHavingNotBetween($column, $value1, $value2);
```

### havingRaw
```php
$stmt->havingRaw($expression, $bindings);
```

### orHavingRaw
```php
$stmt->orHavingRaw($expression, $bindings);
```

### havingNotRaw
```php
$stmt->havingNotRaw($expression, $bindings);
```

### orHavingNotRaw
```php
$stmt->orHavingNotRaw($expression, $bindings);
```

### window
```php
use MichaelRushton\SQL\Services\Window;

$stmt->window($name, function (Window $window)
{

});
```
See also [Window](../../services/transactsql/window.md).

### union
```php
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$stmt->union(function (Select $stmt)
{

});
```

### unionAll
```php
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$stmt->unionAll(function (Select $stmt)
{

});
```

### intersect
```php
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$stmt->intersect(function (Select $stmt)
{

});
```

### except
```php
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$stmt->except(function (Select $stmt)
{

});
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

### offsetFetch
```php
$stmt->offsetFetch($offset, $row_count);
```

### when
```php
use MichaelRushton\SQL\Statements\TransactSQL\Select;

$stmt->when($condition, if_true: function (Select $stmt)
{

}, if_false: function (Select $stmt)
{

});
```

### toSubquery
```php
$subquery = $stmt->toSubquery();
```
See also [Subquery](../../services/transactsql/subquery.md).