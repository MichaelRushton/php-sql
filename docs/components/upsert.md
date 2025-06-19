# PHP-SQL

## Upsert documentation
`PostgreSQL` and `SQLite` only.
```php
use MichaelRushton\SQL\Components\Upsert;
use MichaelRushton\SQL\SQL;

$stmt = SQL::PostgreSQL->insert()
->into("t1")
->onConflictDoUpdateSet("c1", 1, function (Upsert $upsert)
{

});
// INSERT INTO t1 ON CONFLICT DO UPDATE SET c1 = ?
```

### columns
```php
$upsert->columns("c1");
// ON CONFLICT (c1) DO ...
```
```php
$upsert->columns(["c1", "c2"]);
// ON CONFLICT (c1, c2) DO ...
```

### whereIndex
```php
$upsert->columns("c1")
->whereIndex("i1");
// ON CONFLICT (c1) WHERE i1 DO ...
```

### onConstraint
`PostgreSQL` only.
```php
$upsert->onConstraint("c1");
// ON CONFLICT ON CONSTRAINT c1
```

### where
See [SELECT documentation](select.md#where).
```php
$upsert->where("c1", 1);
// ON CONFLICT DO ... WHERE c1 = ?
```