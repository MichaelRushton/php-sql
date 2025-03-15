# PostgreSQL Upsert

```php
use MichaelRushton\SQL\Services\Upsert;

$stmt->onConflictDoUpdateSet($column, $value, function (Upsert $upsert)
{

});
```

## API reference

### columns
```php
$upsert->columns($column);
```
```php
$upsert->columns([$column1, $column2]);
```

### whereIndex
```php
$upsert->whereIndex($column, $value);
```
```php
$upsert->whereIndex($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$upsert->whereIndex(function (Where $where)
{

});
```

### onConstraint
```php
$upsert->onConstraint($constraint);
```

### where
```php
$upsert->where($column, $value);
```
```php
$upsert->where($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$upsert->where(function (Where $where)
{

});
```
See also [Subquery](../../services/postgresql/subquery.md).

### orWhere
```php
$upsert->orWhere($column, $value);
```
```php
$upsert->orWhere($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$upsert->orWhere(function (Where $where)
{

});
```
See also [Subquery](../../services/postgresql/subquery.md).

### whereNot
```php
$upsert->whereNot($column, $value);
```
```php
$upsert->whereNot($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$upsert->whereNot(function (Where $where)
{

});
```
See also [Subquery](../../services/postgresql/subquery.md).

### orWhereNot
```php
$upsert->orWhereNot($column, $value);
```
```php
$upsert->orWhereNot($column, $operator, $value);
```
```php
use MichaelRushton\SQL\Services\Where;

$upsert->orWhereNot(function (Where $where)
{

});
```
See also [Subquery](../../services/postgresql/subquery.md).

### whereBetween
```php
$upsert->whereBetween($column, $value1, $value2);
```

### orWhereBetween
```php
$upsert->orWhereBetween($column, $value1, $value2);
```

### whereNotBetween
```php
$upsert->whereNotBetween($column, $value1, $value2);
```

### orWhereNotBetween
```php
$upsert->orWhereNotBetween($column, $value1, $value2);
```

### whereRaw
```php
$upsert->whereRaw($expression, $bindings);
```

### orWhereRaw
```php
$upsert->orWhereRaw($expression, $bindings);
```

### whereNotRaw
```php
$upsert->whereNotRaw($expression, $bindings);
```

### orWhereNotRaw
```php
$upsert->orWhereNotRaw($expression, $bindings);
```