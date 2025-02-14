# PostgreSQL SELECT

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::PostgreSQL->select();
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
See also [CTE](../../services/postgresql/cte.md).

### recursive
```php
$stmt->recursive();
```

### distinct
```php
$stmt->distinct();
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
See also [Subquery](../../services/postgresql/subquery.md).

### selectRaw
```php
$stmt->selectRaw($expression, $bindings);
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
See also [Table](../../services/postgresql/table.md) and [Subquery](../../services/postgresql/subquery.md).

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
See also [Subquery](../../services/postgresql/subquery.md).

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
See also [Subquery](../../services/postgresql/subquery.md).

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
See also [Subquery](../../services/postgresql/subquery.md).

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
See also [Subquery](../../services/postgresql/subquery.md).

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
See also [Window](../../services/postgresql/window.md).

### union
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->union(function (Select $stmt)
{

});
```

### unionAll
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->unionAll(function (Select $stmt)
{

});
```

### intersect
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->intersect(function (Select $stmt)
{

});
```

### intersectAll
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->intersectAll(function (Select $stmt)
{

});
```

### except
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->except(function (Select $stmt)
{

});
```

### exceptAll
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

$stmt->exceptAll(function (Select $stmt)
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

### orderByNullsFirst
```php
$stmt->orderByNullsFirst($column);
```
```php
$stmt->orderByNullsFirst([$column1, $column2]);
```

### orderByNullsLast
```php
$stmt->orderByNullsLast($column);
```
```php
$stmt->orderByNullsLast([$column1, $column2]);
```

### orderByDescNullsFirst
```php
$stmt->orderByDescNullsFirst($column);
```
```php
$stmt->orderByDescNullsFirst([$column1, $column2]);
```

### orderByDescNullsLast
```php
$stmt->orderByDescNullsLast($column);
```
```php
$stmt->orderByDescNullsLast([$column1, $column2]);
```

### orderByRaw
```php
$stmt->orderByRaw($expression, $bindings);
```

### orderByDescRaw
```php
$stmt->orderByDescRaw($expression, $bindings);
```

### orderByNullsFirstRaw
```php
$stmt->orderByNullsFirstRaw($expression, $bindings);
```

### orderByNullsLastRaw
```php
$stmt->orderByNullsLastRaw($expression, $bindings);
```

### orderByDescNullsFirstRaw
```php
$stmt->orderByDescNullsFirstRaw($expression, $bindings);
```

### orderByDescNullsLastRaw
```php
$stmt->orderByDescNullsLastRaw($expression, $bindings);
```

### limit
```php
$stmt->limit($row_count);
```
```php
$stmt->limit($row_count, $offset);
```

### offsetFetch
```php
$stmt->offsetFetch($offset, $row_count);
```

### withTies
```php
$stmt->withTies();
```

### forUpdate
```php
$stmt->forUpdate();
```
```php
$stmt->forUpdate($table);
```
```php
$stmt->forUpdate([$table1, $table2]);
```

### forUpdateNoWait
```php
$stmt->forUpdateNoWait();
```
```php
$stmt->forUpdateNoWait($table);
```
```php
$stmt->forUpdateNoWait([$table1, $table2]);
```

### forUpdateSkipLocked
```php
$stmt->forUpdateSkipLocked();
```
```php
$stmt->forUpdateSkipLocked($table);
```
```php
$stmt->forUpdateSkipLocked([$table1, $table2]);
```

### forNoKeyUpdate
```php
$stmt->forNoKeyUpdate();
```
```php
$stmt->forNoKeyUpdate($table);
```
```php
$stmt->forNoKeyUpdate([$table1, $table2]);
```

### forNoKeyUpdateNoWait
```php
$stmt->forNoKeyUpdateNoWait();
```
```php
$stmt->forNoKeyUpdateNoWait($table);
```
```php
$stmt->forNoKeyUpdateNoWait([$table1, $table2]);
```

### forNoKeyUpdateSkipLocked
```php
$stmt->forNoKeyUpdateSkipLocked();
```
```php
$stmt->forNoKeyUpdateSkipLocked($table);
```
```php
$stmt->forNoKeyUpdateSkipLocked([$table1, $table2]);
```

### forShare
```php
$stmt->forShare();
```
```php
$stmt->forShare($table);
```
```php
$stmt->forShare([$table1, $table2]);
```

### forShareNoWait
```php
$stmt->forShareNoWait();
```
```php
$stmt->forShareNoWait($table);
```
```php
$stmt->forShareNoWait([$table1, $table2]);
```

### forShareSkipLocked
```php
$stmt->forShareSkipLocked();
```
```php
$stmt->forShareSkipLocked($table);
```
```php
$stmt->forShareSkipLocked([$table1, $table2]);
```

### forKeyShare
```php
$stmt->forKeyShare();
```
```php
$stmt->forKeyShare($table);
```
```php
$stmt->forKeyShare([$table1, $table2]);
```

### forKeyShareNoWait
```php
$stmt->forKeyShareNoWait();
```
```php
$stmt->forKeyShareNoWait($table);
```
```php
$stmt->forKeyShareNoWait([$table1, $table2]);
```

### forKeyShareSkipLocked
```php
$stmt->forKeyShareSkipLocked();
```
```php
$stmt->forKeyShareSkipLocked($table);
```
```php
$stmt->forKeyShareSkipLocked([$table1, $table2]);
```

### when
```php
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

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
See also [Subquery](../../services/postgresql/subquery.md).