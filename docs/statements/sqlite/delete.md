# SQLite DELETE

```php
use MichaelRushton\SQL\SQL;

$stmt = SQL::SQLite->delete();
```

## API reference

### bindings
Note: Must have first cast `$stmt` to a string.
```php
$bindings = $stmt->bindings();
```

### with
```php
use MichaelRushton\SQL\Services\SQLite\CTE;
use MichaelRushton\SQL\Statements\SQLite\Select;

$stmt->with($name, function (Select $stmt)
{

}, function (CTE $cte)
{

});
```
See also [Select](select.md) and [CTE](../../services/sqlite/cte.md).

### from
```php
$stmt->from($table);
```
```php
$stmt->from([$alias => $table]);
```
See also [Table](../../services/sqlite/table.md).

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
See also [Subquery](../../services/sqlite/subquery.md).

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
See also [Subquery](../../services/sqlite/subquery.md).

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
See also [Subquery](../../services/sqlite/subquery.md).

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
See also [Subquery](../../services/sqlite/subquery.md).

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

### when
```php
use MichaelRushton\SQL\Statements\SQLite\Delete;

$stmt->when($condition, if_true: function (Delete $stmt)
{

}, if_false: function (Delete $stmt)
{

});
```