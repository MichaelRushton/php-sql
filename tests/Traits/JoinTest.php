<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Join;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->join($table))
  ->toBe("SELECT * JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" JOIN "t2" AS "t3"'],
]);

test("join using", function ($column, $output)
{

  expect((string) SQL::SQLite->select()->join("t1", $column))
  ->toBe("SELECT * JOIN \"t1\" USING ($output)");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("join on closure", function ()
{

  expect((string) $stmt = SQL::SQLite->select()->join("t1", function (Join $join)
  {
    $join->on(true);
  }))
  ->toBe("SELECT * JOIN \"t1\" ON ?");

  expect($stmt->bindings())
  ->toBe([true]);

});

test("join on implicit operator", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->join("t1", $column, $input))
  ->toBe("SELECT * JOIN \"t1\" ON $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("join on explicit expression", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->join("t1", "c1", $operator, $input))
  ->toBe("SELECT * JOIN \"t1\" ON \"c1\" $operator $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("left join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->leftJoin($table))
  ->toBe("SELECT * LEFT JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" LEFT JOIN "t2" AS "t3"'],
]);

test("left join using", function ($column, $output)
{

  expect((string) SQL::SQLite->select()->leftJoin("t1", $column))
  ->toBe("SELECT * LEFT JOIN \"t1\" USING ($output)");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("left join on closure", function ()
{

  expect((string) $stmt = SQL::SQLite->select()->leftJoin("t1", function (Join $join)
  {
    $join->on(true);
  }))
  ->toBe("SELECT * LEFT JOIN \"t1\" ON ?");

  expect($stmt->bindings())
  ->toBe([true]);

});

test("left join on implicit operator", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->leftJoin("t1", $column, $input))
  ->toBe("SELECT * LEFT JOIN \"t1\" ON $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("left join on explicit expression", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->leftJoin("t1", "c1", $operator, $input))
  ->toBe("SELECT * LEFT JOIN \"t1\" ON \"c1\" $operator $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("right join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->rightJoin($table))
  ->toBe("SELECT * RIGHT JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" RIGHT JOIN "t2" AS "t3"'],
]);

test("right join using", function ($column, $output)
{

  expect((string) SQL::SQLite->select()->rightJoin("t1", $column))
  ->toBe("SELECT * RIGHT JOIN \"t1\" USING ($output)");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("right join on closure", function ()
{

  expect((string) $stmt = SQL::SQLite->select()->rightJoin("t1", function (Join $join)
  {
    $join->on(true);
  }))
  ->toBe("SELECT * RIGHT JOIN \"t1\" ON ?");

  expect($stmt->bindings())
  ->toBe([true]);

});

test("right join on implicit operator", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->rightJoin("t1", $column, $input))
  ->toBe("SELECT * RIGHT JOIN \"t1\" ON $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("right join on explicit expression", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->rightJoin("t1", "c1", $operator, $input))
  ->toBe("SELECT * RIGHT JOIN \"t1\" ON \"c1\" $operator $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("full join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->fullJoin($table))
  ->toBe("SELECT * FULL JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" FULL JOIN "t2" AS "t3"'],
]);

test("full join using", function ($column, $output)
{

  expect((string) SQL::SQLite->select()->fullJoin("t1", $column))
  ->toBe("SELECT * FULL JOIN \"t1\" USING ($output)");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("full join on closure", function ()
{

  expect((string) $stmt = SQL::SQLite->select()->fullJoin("t1", function (Join $join)
  {
    $join->on(true);
  }))
  ->toBe("SELECT * FULL JOIN \"t1\" ON ?");

  expect($stmt->bindings())
  ->toBe([true]);

});

test("full join on implicit operator", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->fullJoin("t1", $column, $input))
  ->toBe("SELECT * FULL JOIN \"t1\" ON $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("full join on explicit expression", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->fullJoin("t1", "c1", $operator, $input))
  ->toBe("SELECT * FULL JOIN \"t1\" ON \"c1\" $operator $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("straight join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->straightJoin($table))
  ->toBe("SELECT * STRAIGHT_JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" STRAIGHT_JOIN "t2" AS "t3"'],
]);

test("straight join using", function ($column, $output)
{

  expect((string) SQL::SQLite->select()->straightJoin("t1", $column))
  ->toBe("SELECT * STRAIGHT_JOIN \"t1\" USING ($output)");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("straight join on closure", function ()
{

  expect((string) $stmt = SQL::SQLite->select()->straightJoin("t1", function (Join $join)
  {
    $join->on(true);
  }))
  ->toBe("SELECT * STRAIGHT_JOIN \"t1\" ON ?");

  expect($stmt->bindings())
  ->toBe([true]);

});

test("straight join on implicit operator", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->straightJoin("t1", $column, $input))
  ->toBe("SELECT * STRAIGHT_JOIN \"t1\" ON $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("straight join on explicit expression", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->straightJoin("t1", "c1", $operator, $input))
  ->toBe("SELECT * STRAIGHT_JOIN \"t1\" ON \"c1\" $operator $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("cross join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->crossJoin($table))
  ->toBe("SELECT * CROSS JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" CROSS JOIN "t2" AS "t3"'],
]);

test("natural join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->naturalJoin($table))
  ->toBe("SELECT * NATURAL JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" NATURAL JOIN "t2" AS "t3"'],
]);

test("natural left join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->naturalLeftJoin($table))
  ->toBe("SELECT * NATURAL LEFT JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" NATURAL LEFT JOIN "t2" AS "t3"'],
]);

test("natural right join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->naturalRightJoin($table))
  ->toBe("SELECT * NATURAL RIGHT JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" NATURAL RIGHT JOIN "t2" AS "t3"'],
]);

test("natural full join", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->naturalFullJoin($table))
  ->toBe("SELECT * NATURAL FULL JOIN $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1" NATURAL FULL JOIN "t2" AS "t3"'],
]);