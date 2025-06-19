# PHP-SQL

## SELECT documentation

### with
See [CTE documentation](../components/cte.md).

```php
use MichaelRushton\SQL\Components\CTE;
use MichaelRushton\SQL\Statements\Select;

$stmt->with(
  "cte",
  fn (Select $select) => $select->from("t1"),
  fn (CTE $cte) => $cte->columns("c1")
);
// WITH cte (c1) AS (SELECT * FROM t1) SELECT *
```

### recursive
```php
$stmt->with("cte", "SELECT * FROM t1")
->recursive();
// WITH RECURSIVE cte AS (SELECT * FROM t1)
```

### distinct
```php
$stmt->distinct();
// SELECT DISTINCT
```

### highPriority
`MariaDB` and `MySQL` only.
```php
$stmt->highPriority();
// SELECT HIGH_PRIORITY
```

### straightJoinAll
`MariaDB` and `MySQL` only.
```php
$stmt->straightJoinAll();
// SELECT STRAIGHT_JOIN
```

### sqlSmallResult
`MariaDB` and `MySQL` only.
```php
$stmt->sqlSmallResult();
// SELECT SQL_SMALL_RESULT
```

### sqlBigResult
`MariaDB` and `MySQL` only.
```php
$stmt->sqlBigResult();
// SELECT SQL_BIG_RESULT
```

### sqlBufferResult
`MariaDB` and `MySQL` only.
```php
$stmt->sqlBufferResult();
// SELECT SQL_BUFFER_RESULT
```

### sqlCache
`MariaDB` only.
```php
$stmt->sqlCache();
// SELECT SQL_CACHE
```

### sqlNoCache
`MariaDB` only.
```php
$stmt->sqlNoCache();
// SELECT SQL_NO_CACHE
```

### sqlCalcFoundRows
`MariaDB` and `MySQL` only.
```php
$stmt->sqlCalcFoundRows();
// SELECT SQL_CALC_FOUND_ROWS
```

### top
`TransactSQL` only.
```php
$stmt->top(10);
// TOP (10)
```

### percent
`TransactSQL` only.
```php
$stmt->top(10)
->percent();
// TOP (10) PERCENT
```

### columns
```php
$stmt->columns("c1");
// SELECT c1
```
```php
$stmt->columns(["c1", "c2"]);
// SELECT c1, c2
```

### from
```php
$stmt->from("t1");
// FROM t1
```
```php
$stmt->from(["t1", "t2"]);
// FROM t1, t2
```
See [Table documentation](../components/table.md).
```php
$stmt->from(new Table("t1"));
// FROM t1
```
See [Subquery documentation](../components/subquery.md).
```php
$stmt->from(
  SQL::SQLite->select()
  ->from("t2")
  ->toSubquery()
  ->as("s1")
);
// FROM (SELECT * FROM t2) AS s1
```

### join
```php
$stmt->join("t2");
// JOIN t2
```
```php
$stmt->join("t2", "c1");
// JOIN t2 USING (c1)
```
```php
$stmt->join("t2", ["c1", "c2"]);
// JOIN t2 USING (c1, c2)
```
```php
$stmt->join("t2", "c1", "c2");
// JOIN t2 ON c1 = c2
```
```php
$stmt->join("t2", "c1", ">", "c2");
// JOIN t2 ON c1 > c2
```
```php
use MichaelRushton\SQL\Components\On;

$stmt->join("t2", function (On $on)
{
  $on->on("c1", "c2");
});
// JOIN t2 ON c1 = c2
```

### on
```php
$stmt->on("c1", "c2");
// ON c1 = c2
```
```php
$stmt->on("c1", ">", "c2");
// ON c1 > c2
```
```php
$stmt->on([
  "c1" => "c2",
  "c3" => "c4",
]);
// ON (c1 = c2 AND c3 = c4)
```
```php
use MichaelRushton\SQL\Components\On;

$stmt->on(function (On $on)
{
  $on->on("c1", "c2")
  ->on("c3", "c4");
});
// ON (c1 = c2 AND c3 = c4)
```
```php
$stmt->on("c1", SQL::bind(1));
// ON c1 = ?
```
```php
$stmt->on(
  SQL::SQLite->select()
  ->from("t2")
  ->toSubquery()
  ->exists()
);
// ON EXISTS (SELECT * FROM t2)
```
```php
$stmt->on(
  SQL::SQLite->select()
  ->columns("COUNT(*)")
  ->from("t2"),
  "c2"
);
// ON (SELECT COUNT(*) FROM t2) = c2
```

### orOn
```php
$stmt->on("c1", "c2")
->orOn("c3", "c4");
// ON (c1 = c2 OR c3 = c4)
```

### onNot
```php
$stmt->onNot("c1", "c2");
// ON NOT c1 = c2
```

### orOnNot
```php
$stmt->on("c1", "c2")
->orOnNot("c3", "c4");
// ON (c1 = c2 OR NOT c3 = c4)
```

### onIn
```php
$stmt->onIn("c1", ["c2", "c3"]);
// ON c1 IN (c2, c3)
```

### orOnIn
```php
$stmt->on("c1", "c2")
->orOnIn("c3", ["c4", "c5"]);
// ON (c1 = c2 OR c3 IN (c4, c5))
```

### onNotIn
```php
$stmt->onNotIn("c1", ["c2", "c3"]);
// ON NOT c1 IN (c2, c3)
```

### orOnNotIn
```php
$stmt->on("c1", "c2")
->orOnNotIn("c3", ["c4", "c5"]);
// ON (c1 = c2 OR NOT c3 IN (c4, c5))
```

### onBetween
```php
$stmt->onBetween("c1", "c2", "c3");
// ON c1 BETWEEN c2 AND c3
```

### orOnBetween
```php
$stmt->on("c1", "c2")
->orOnBetween("c3", "c4", "c5");
// ON (c1 = c2 OR c3 BETWEEN c4 AND c5)
```

### onNotBetween
```php
$stmt->onNotBetween("c1", "c2", "c3");
// ON NOT c1 BETWEEN c2 AND c3
```

### orOnNotBetween
```php
$stmt->on("c1", "c2")
->orOnNotBetween("c3", "c4", "c5");
// ON (c1 = c2 OR NOT c3 BETWEEN c4 AND c5)
```

### onNull
```php
$stmt->onNull("c1");
// ON c1 IS NULL
```

### orOnNull
```php
$stmt->on("c1", "c2")
->orOnNull("c3");
// ON (c1 = c2 OR c3 IS NULL)
```

### onNotNull
```php
$stmt->onNotNull("c1");
// ON NOT c1 IS NULL
```

### orOnNotNull
```php
$stmt->on("c1", "c2")
->orOnNotNull("c3");
// ON (c1 = c2 OR NOT c3 IS NULL)
```

### leftJoin
```php
$stmt->leftJoin("t2", ...$on);
// LEFT JOIN t2
```

### rightJoin
```php
$stmt->rightJoin("t2", ...$on);
// RIGHT JOIN t2
```

### fullJoin
`PostgreSQL`, `SQLite`, and `TransactSQL` only.
```php
$stmt->fullJoin("t2", ...$on);
// FULL JOIN t2
```

### straightJoin
`MariaDB` and `MySQL` only.
```php
$stmt->straightJoin("t2", ...$on);
// STRAIGHT_JOIN t2
```

### crossJoin
```php
$stmt->crossJoin("t2");
// CROSS JOIN t2
```

### naturalJoin
`MariaDB`, `MySQL`, `PostgreSQL`, and `SQLite` only.
```php
$stmt->naturalJoin("t2");
// NATURAL JOIN t2
```

### naturalLeftJoin
`MariaDB`, `MySQL`, `PostgreSQL`, and `SQLite` only.
```php
$stmt->naturalLeftJoin("t2");
// NATURAL LEFT JOIN t2
```

### naturalRightJoin
`MariaDB`, `MySQL`, `PostgreSQL`, and `SQLite` only.
```php
$stmt->naturalRightJoin("t2");
// NATURAL RIGHT JOIN t2
```

### naturalFullJoin
`PostgreSQL` and `SQLite` only.
```php
$stmt->naturalFullJoin("t2");
// NATURAL FULL JOIN t2
```

### where
```php
$stmt->where("c1", 1);
// WHERE c1 = ?
```
```php
$stmt->where("c1", ">", 1);
// WHERE c1 > ?
```
```php
$stmt->where([
  "c1" => 1,
  "c2" => 2,
]);
// WHERE c1 = ? AND c2 = ?
```
```php
use MichaelRushton\SQL\Components\Where;

$stmt->where(function (Where $where)
{
  $where->where("c1", 1)
  ->where("c2", 2);
});
// WHERE (c1 = ? AND c2 = ?)
```
```php
use MichaelRushton\SQL\Components\Raw;

$stmt->where("c1", new Raw("c2"));
// WHERE c1 = c2
```
```php
$stmt->where(
  SQL::SQLite->select()
  ->from("t2")
  ->toSubquery()
  ->exists()
);
// WHERE EXISTS (SELECT * FROM t2)
```
```php
$stmt->where(
  SQL::SQLite->select()
  ->columns("COUNT(*)")
  ->from("t2"),
  1
);
// WHERE (SELECT COUNT(*) FROM t2) = 1
```

### orWhere
```php
$stmt->where("c1", 1)
->orWhere("c2", 2);
// WHERE c1 = ? OR c2 = ?
```

### whereNot
```php
$stmt->whereNot("c1", 1);
// WHERE NOT c1 = ?
```

### orWhereNot
```php
$stmt->where("c1", 1)
->orWhereNot("c2", 2);
// WHERE c1 = ? OR NOT c2 = ?
```

### whereIn
```php
$stmt->whereIn("c1", [1, 2]);
// WHERE c1 IN (?, ?)
```

### orWhereIn
```php
$stmt->where("c1", 1)
->orWhereIn("c2", [2, 3]);
// WHERE c1 = ? OR c2 IN (?, ?)
```

### whereNotIn
```php
$stmt->whereNotIn("c1", [1, 2]);
// WHERE NOT c1 IN (?, ?)
```

### orWhereNotIn
```php
$stmt->where("c1", 1)
->orWhereNotIn("c2", [2, 3]);
// WHERE c1 = ? OR NOT c2 IN (?, ?)
```

### whereBetween
```php
$stmt->whereBetween("c1", 1, 2);
// WHERE c1 BETWEEN ? AND ?
```

### orWhereBetween
```php
$stmt->where("c1", 1)
->orWhereBetween("c2", 2, 3);
// WHERE c1 = ? OR c2 BETWEEN ? AND ?
```

### whereNotBetween
```php
$stmt->whereNotBetween("c1", 1, 2);
// WHERE NOT c1 BETWEEN ? AND ?
```

### orWhereNotBetween
```php
$stmt->where("c1", 1)
->orWhereNotBetween("c2", 2, 3);
// WHERE c1 = ? OR NOT c2 BETWEEN ? AND ?
```

### whereNull
```php
$stmt->whereNull("c1");
// WHERE c1 IS NULL
```

### orWhereNull
```php
$stmt->where("c1", 1)
->orWhereNull("c2");
// WHERE c1 = ? OR c2 IS NULL
```

### whereNotNull
```php
$stmt->whereNotNull("c1");
// WHERE NOT c1 IS NULL
```

### orWhereNotNull
```php
$stmt->where("c1", 1)
->orWhereNotNull("c2");
// WHERE c1 = ? OR NOT c2 IS NULL
```

### groupBy
```php
$stmt->groupBy("c1");
// GROUP BY c1
```
```php
$stmt->groupBy(["c1", "c2"]);
// GROUP BY c1, c2
```

### withRollup
`MariaDB` and `MySQL` only.
```php
$stmt->groupBy("c1")
->withRollup();
// GROUP BY c1 WITH ROLLUP
```

### having
```php
$stmt->having("c1", 1);
// HAVING c1 = ?
```
```php
$stmt->having("c1", ">", 1);
// HAVING c1 > ?
```
```php
$stmt->having([
  "c1" => 1,
  "c2" => 2,
]);
// HAVING c1 = ? AND c2 = ?
```
```php
use MichaelRushton\SQL\Components\Having;

$stmt->having(function (Having $having)
{
  $having->having("c1", 1)
  ->having("c2", 2);
});
// HAVING (c1 = ? AND c2 = ?)
```
```php
use MichaelRushton\SQL\Components\Raw;

$stmt->having("c1", new Raw("c2"));
// HAVING c1 = c2
```
```php
$stmt->having(
  SQL::SQLite->select()
  ->from("t2")
  ->toSubquery()
  ->exists()
);
// HAVING EXISTS (SELECT * FROM t2)
```
```php
$stmt->having(
  SQL::SQLite->select()
  ->columns("COUNT(*)")
  ->from("t2"),
  1
);
// HAVING (SELECT COUNT(*) FROM t2) = 1
```

### orHaving
```php
$stmt->having("c1", 1)
->orHaving("c2", 2);
// HAVING c1 = ? OR c2 = ?
```

### havingNot
```php
$stmt->havingNot("c1", 1);
// HAVING NOT c1 = ?
```

### orHavingNot
```php
$stmt->having("c1", 1)
->orHavingNot("c2", 2);
// HAVING c1 = ? OR NOT c2 = ?
```

### havingIn
```php
$stmt->havingIn("c1", [1, 2]);
// HAVING c1 IN (?, ?)
```

### orHavingIn
```php
$stmt->having("c1", 1)
->orHavingIn("c2", [2, 3]);
// HAVING c1 = ? OR c2 IN (?, ?)
```

### havingNotIn
```php
$stmt->havingNotIn("c1", [1, 2]);
// HAVING NOT c1 IN (?, ?)
```

### orHavingNotIn
```php
$stmt->having("c1", 1)
->orHavingNotIn("c2", [2, 3]);
// HAVING c1 = ? OR NOT c2 IN (?, ?)
```

### havingBetween
```php
$stmt->havingBetween("c1", 1, 3);
// HAVING c1 BETWEEN ? AND ?
```

### orHavingBetween
```php
$stmt->having("c1", 1)
->orHavingBetween("c2", 2, 3);
// HAVING c1 = ? OR c2 BETWEEN ? AND ?
```

### havingNotBetween
```php
$stmt->havingNotBetween("c1", 1, 3);
// HAVING NOT c1 BETWEEN ? AND ?
```

### orHavingNotBetween
```php
$stmt->having("c1", 1)
->orHavingNotBetween("c2", 2, 3);
// HAVING c1 = ? OR NOT c2 BETWEEN ? AND ?
```

### havingNull
```php
$stmt->havingNull("c1");
// HAVING c1 IS NULL
```

### orHavingNull
```php
$stmt->having("c1", 1)
->orHavingNull("c2");
// HAVING c1 = ? OR c2 IS NULL
```

### havingNotNull
```php
$stmt->havingNotNull("c1");
// HAVING NOT c1 IS NULL
```

### orHavingNotNull
```php
$stmt->having("c1", 1)
->orHavingNotNull("c2");
// HAVING c1 = ? OR NOT c2 IS NULL
```

### window
See [Window documentation](../components/window.md).

`MySQL`, `PostgreSQL`, `SQLite`, and `TransactSQL` only.
```php
use MichaelRushton\SQL\Components\Window;

$stmt->window("w", function (Window $window)
{

});
// WINDOW w AS ()
```

### union
```php
use MichaelRushton\SQL\Statements\Select;

$stmt->union(function (Select $select)
{
  $select->from("t2");
});
// UNION SELECT * FROM t2
```

### unionAll
```php
use MichaelRushton\SQL\Statements\Select;

$stmt->unionAll(function (Select $select)
{
  $select->from("t2");
});
// UNION ALL SELECT * FROM t2
```

### intersect
```php
use MichaelRushton\SQL\Statements\Select;

$stmt->intersect(function (Select $select)
{
  $select->from("t2");
});
// INTERSECT SELECT * FROM t2
```

### intersectAll
`MariaDB`, `MySQL`, and `PostgreSQL` only.
```php
use MichaelRushton\SQL\Statements\Select;

$stmt->intersectAll(function (Select $select)
{
  $select->from("t2");
});
// INTERSECT ALL SELECT * FROM t2
```

### except
```php
use MichaelRushton\SQL\Statements\Select;

$stmt->except(function (Select $select)
{
  $select->from("t2");
});
// EXCEPT SELECT * FROM t2
```

### exceptAll
`MariaDB`, `MySQL`, and `PostgreSQL` only.
```php
use MichaelRushton\SQL\Statements\Select;

$stmt->exceptAll(function (Select $select)
{
  $select->from("t2");
});
// EXCEPT ALL SELECT * FROM t2
```

### orderBy
```php
$stmt->orderBy("c1");
// ORDER BY c1
```
```php
$stmt->orderBy(["c1", "c2"]);
// ORDER BY c1, c2
```

### orderByDesc
```php
$stmt->orderByDesc("c1");
// ORDER BY c1 DESC
```
```php
$stmt->orderByDesc(["c1", "c2"]);
// ORDER BY c1 DESC, c2 DESC
```

### orderByNullsFirst
`PostgreSQL` and `SQLite` only.
```php
$stmt->orderByNullsFirst("c1");
// ORDER BY c1 ASC NULLS FIRST
```
```php
$stmt->orderByNullsFirst(["c1", "c2"]);
// ORDER BY c1 ASC NULLS FIRST, c2 ASC NULLS FIRST
```

### orderByNullsLast
`PostgreSQL` and `SQLite` only.
```php
$stmt->orderByNullsLast("c1");
// ORDER BY c1 ASC NULLS LAST
```
```php
$stmt->orderByNullsLast(["c1", "c2"]);
// ORDER BY c1 ASC NULLS LAST, c2 ASC NULLS LAST
```

### orderByDescNullsFirst
`PostgreSQL` and `SQLite` only.
```php
$stmt->orderByDescNullsFirst("c1");
// ORDER BY c1 DESC NULLS FIRST
```
```php
$stmt->orderByDescNullsFirst(["c1", "c2"]);
// ORDER BY c1 DESC NULLS FIRST, c2 DESC NULLS FIRST
```

### orderByDescNullsLast
`PostgreSQL` and `SQLite` only.
```php
$stmt->orderByDescNullsLast("c1");
// ORDER BY c1 DESC NULLS LAST
```
```php
$stmt->orderByDescNullsLast(["c1", "c2"]);
// ORDER BY c1 DESC NULLS LAST, c2 DESC NULLS LAST
```

### limit
`MariaDB`, `MySQL`, `PostgreSQL`, and `SQLite` only.
```php
$stmt->limit(10);
// LIMIT 10
```
```php
$stmt->limit(10, 10);
// LIMIT 10 OFFSET 10
```

### offsetFetch
`MariaDB`, `PostgreSQL`, and `TransactSQL` only.
```php
$stmt->offsetFetch(10, 10);
// OFFSET 10 ROWS FETCH NEXT 10 ROWS ONLY
```

### withTies
`MariaDB`, `PostgreSQL`, and `TransactSQL` only.
```php
$stmt->offsetFetch(10, 10)
->withTies();
// OFFSET 10 ROWS FETCH NEXT 10 ROWS WITH TIES
```
`TransactSQL` only.
```php
$stmt->top(10)
->witTies();
// TOP (10) WITH TIES
```

### rowsExamined
`MariaDB` only.
```php
$stmt->rowsExamined(10);
// ROWS EXAMINED 10
```

### intoOutfile
See [Outfile documentation](../components/outfile.md).

`MariaDB` and `MySQL` only.
```php
use MichaelRushton\SQL\Components\Outfile;

$stmt->intoOutfile("/path/to/file", function (Outfile $outfile)
{

});
// INTO OUTFILE '/path/to/file'
```

### intoDumpfile
`MariaDB` and `MySQL` only.
```php
$stmt->intoDumpfile("/path/to/file");
// INTO DUMPFILE '/path/to/file'
```

### intoVar
`MariaDB` and `MySQL` only.
```php
$stmt->intoVar("v1");
// INTO @v1
```
```php
$stmt->intoVar(["v1", "v2"]);
// INTO @v1, @v2
```

### forUpdate
`MariaDB`, `MySQL`, and `PostgreSQL` only.
```php
$stmt->forUpdate();
// FOR UPDATE
```
`MySQL` and `PostgreSQL` only.
```php
$stmt->forUpdate("t1");
// FOR UPDATE OF t1
```
`MySQL` and `PostgreSQL` only.
```php
$stmt->forUpdate(["t1", "t2"]);
// FOR UPDATE OF t1, t2
```

### forUpdateWait
`MariaDB` only.
```php
$stmt->forUpdateWait(10);
// FOR UPDATE WAIT 10
```

### forUpdateNoWait
`MariaDB`, `MySQL`, and `PostgreSQL` only.
```php
$stmt->forUpdateNoWait();
// FOR UPDATE NOWAIT
```
`MySQL` and `PostgreSQL` only.
```php
$stmt->forUpdateNoWait("t1");
// FOR UPDATE OF t1 NOWAIT
```
`MySQL` and `PostgreSQL` only.
```php
$stmt->forUpdateNoWait(["t1", "t2"]);
// FOR UPDATE OF t1, t2 NOWAIT
```

### forUpdateSkipLocked
`MariaDB`, `MySQL`, and `PostgreSQL` only.
```php
$stmt->forUpdateSkipLocked();
// FOR UPDATE SKIP LOCKED
```
`MySQL` and `PostgreSQL` only.
```php
$stmt->forUpdateSkipLocked("t1");
// FOR UPDATE OF t1 SKIP LOCKED
```
`MySQL` and `PostgreSQL` only.
```php
$stmt->forUpdateSkipLocked(["t1", "t2"]);
// FOR UPDATE OF t1, t2 SKIP LOCKED
```

### forNoKeyUpdate
`PostgreSQL` only.
```php
$stmt->forNoKeyUpdate();
// FOR NO KEY UPDATE
```
```php
$stmt->forNoKeyUpdate("t1");
// FOR NO KEY UPDATE OF t1
```
```php
$stmt->forNoKeyUpdate(["t1", "t2"]);
// FOR NO KEY UPDATE OF t1, t2
```

### forNoKeyUpdateNoWait
`PostgreSQL` only.
```php
$stmt->forNoKeyUpdateNoWait();
// FOR NO KEY UPDATE NOWAIT
```
```php
$stmt->forNoKeyUpdateNoWait("t1");
// FOR NO KEY UPDATE OF t1 NOWAIT
```
```php
$stmt->forNoKeyUpdateNoWait(["t1", "t2"]);
// FOR NO KEY UPDATE OF t1, t2 NOWAIT
```

### forNoKeyUpdateSkipLocked
`PostgreSQL` only.
```php
$stmt->forNoKeyUpdateSkipLocked();
// FOR NO KEY UPDATE SKIP LOCKED
```
```php
$stmt->forNoKeyUpdateSkipLocked("t1");
// FOR NO KEY UPDATE OF t1 SKIP LOCKED
```
```php
$stmt->forNoKeyUpdateSkipLocked(["t1", "t2"]);
// FOR NO KEY UPDATE OF t1, t2 SKIP LOCKED
```

### forShare
`MySQL` and `PostgreSQL` only.
```php
$stmt->forShare();
// FOR SHARE
```
```php
$stmt->forShare("t1");
// FOR SHARE OF t1
```
```php
$stmt->forShare(["t1", "t2"]);
// FOR SHARE OF t1, t2
```

### forShareNoWait
`MySQL` and `PostgreSQL` only.
```php
$stmt->forShareNoWait();
// FOR SHARE NOWAIT
```
```php
$stmt->forShareNoWait("t1");
// FOR SHARE OF t1 NOWAIT
```
```php
$stmt->forShareNoWait(["t1", "t2"]);
// FOR SHARE OF t1, t2 NOWAIT
```

### forShareSkipLocked
`MySQL` and `PostgreSQL` only.
```php
$stmt->forShareSkipLocked();
// FOR SHARE SKIP LOCKED
```
```php
$stmt->forShareSkipLocked("t1");
// FOR SHARE OF t1 SKIP LOCKED
```
```php
$stmt->forShareSkipLocked(["t1", "t2"]);
// FOR SHARE OF t1, t2 SKIP LOCKED
```

### forKeyShare
`PostgreSQL` only.
```php
$stmt->forKeyShare();
// FOR KEY SHARE
```
```php
$stmt->forKeyShare("t1");
// FOR KEY SHARE OF t1
```
```php
$stmt->forKeyShare(["t1", "t2"]);
// FOR KEY SHARE OF t1, t2
```

### forKeyShareNoWait
`PostgreSQL` only.
```php
$stmt->forKeyShareNoWait();
// FOR KEY SHARE NOWAIT
```
```php
$stmt->forKeyShareNoWait("t1");
// FOR KEY SHARE OF t1 NOWAIT
```
```php
$stmt->forKeyShareNoWait(["t1", "t2"]);
// FOR KEY SHARE OF t1, t2 NOWAIT
```

### forKeyShareSkipLocked
`PostgreSQL` only.
```php
$stmt->forKeyShareSkipLocked();
// FOR KEY SHARE SKIP LOCKED
```
```php
$stmt->forKeyShareSkipLocked("t1");
// FOR KEY SHARE OF t1 SKIP LOCKED
```
```php
$stmt->forKeyShareSkipLocked(["t1", "t2"]);
// FOR KEY SHARE OF t1, t2 SKIP LOCKED
```

### lockInShareMode
`MariaDB` only.
```php
$stmt->lockInShareMode();
// LOCK IN SHARE MODE
```