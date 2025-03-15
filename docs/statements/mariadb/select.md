# MariaDB SELECT

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::MariaDB->select();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### with
```php
use MichaelRushton\SQL\Services\MariaDB\CTE;
use MichaelRushton\SQL\Statements\MariaDB\Select;

$stmt->with($name, function (Select $stmt)
{

}, function (CTE $cte)
{

});
```
See also [CTE](../../services/mariadb/cte.md).

### recursive
```php
$stmt->recursive();
```

### distinct
```php
$stmt->distinct();
```

### highPriority
```php
$stmt->highPriority();
```

### straightJoinAll
```php
$stmt->straightJoinAll();
```

### sqlSmallResult
```php
$stmt->sqlSmallResult();
```

### sqlBigResult
```php
$stmt->sqlBigResult();
```

### sqlBufferResult
```php
$stmt->sqlBufferResult();
```

### sqlCache
```php
$stmt->sqlCache();
```

### sqlNoCache
```php
$stmt->sqlNoCache();
```

### sqlCalcFoundRows
```php
$stmt->sqlCalcFoundRows();
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
See also [Subquery](../../services/mariadb/subquery.md).

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
See also [Table](../../services/mariadb/table.md) and [Subquery](../../services/mariadb/subquery.md).

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

### withRollup
```php
$stmt->withRollup();
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
See also [Subquery](../../services/mariadb/subquery.md).

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
See also [Subquery](../../services/mariadb/subquery.md).

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
See also [Subquery](../../services/mariadb/subquery.md).

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
See also [Subquery](../../services/mariadb/subquery.md).

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

### union
```php
use MichaelRushton\SQL\Statements\MariaDB\Select;

$stmt->union(function (Select $stmt)
{

});
```

### unionAll
```php
use MichaelRushton\SQL\Statements\MariaDB\Select;

$stmt->unionAll(function (Select $stmt)
{

});
```

### intersect
```php
use MichaelRushton\SQL\Statements\MariaDB\Select;

$stmt->intersect(function (Select $stmt)
{

});
```

### intersectAll
```php
use MichaelRushton\SQL\Statements\MariaDB\Select;

$stmt->intersectAll(function (Select $stmt)
{

});
```

### except
```php
use MichaelRushton\SQL\Statements\MariaDB\Select;

$stmt->except(function (Select $stmt)
{

});
```

### exceptAll
```php
use MichaelRushton\SQL\Statements\MariaDB\Select;

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
```php
$stmt->limit($row_count, $offset);
```

### rowsExamined
```php
$stmt->rowsExamined($row_count);
```

### offsetFetch
```php
$stmt->offsetFetch($offset, $row_count);
```

### withTies
```php
$stmt->withTies();
```

### intoOutfile
```php
$stmt->intoOutfile($path);
```
```php
use MichaelRushton\SQL\Services\Outfile;

$stmt->intoOutfile($path, function (Outfile $outfile)
{

});
```
See also [Outfile](../../services/outfile.md).

### intoDumpfile
```php
$stmt->intoDumpfile($path);
```

### intoVar
```php
$stmt->intoVar($name);
```
```php
$stmt->intoVar([$name1, $name2]);
```

### forUpdate
```php
$stmt->forUpdate();
```

### forUpdateWait
```php
$stmt->forUpdateWait($seconds);
```

### forUpdateNoWait
```php
$stmt->forUpdateNoWait();
```

### forUpdateSkipLocked
```php
$stmt->forUpdateSkipLocked();
```

### lockInShareMode
```php
$stmt->lockInShareMode();
```

### lockInShareModeWait
```php
$stmt->lockInShareModeWait($seconds);
```

### lockInShareModeNoWait
```php
$stmt->lockInShareModeNoWait();
```

### lockInShareModeSkipLocked
```php
$stmt->lockInShareModeSkipLocked();
```

### when
```php
use MichaelRushton\SQL\Statements\MariaDB\Select;

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
See also [Subquery](../../services/mariadb/subquery.md).