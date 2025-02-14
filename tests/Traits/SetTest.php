<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("set", function ($column, $value, $output, $bindings = [])
{

  expect((string) $stmt = SQL::MariaDB->update()->set($column, $value))
  ->toBe("UPDATE SET $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test", "`c1` = ?", ["test"]],
  ["c1", new Raw("?", 1), "`c1` = ?", [1]],
  ["c1", 1, "`c1` = 1"],
  ["c1", 1.1, "`c1` = 1.1"],
  ["c1", true, "`c1` = ?", [true]],
  ["c1", null, "`c1` = NULL"],
  [["c1", "c2"], ["test1", "test2"], "(`c1`, `c2`) = (?, ?)", ["test1", "test2"]],
]);

test("set array", function ()
{

  expect((string) $stmt = SQL::MariaDB->update()->set([
    "c1" => "test1",
    "c2" => "test2",
  ]))
  ->toBe("UPDATE SET `c1` = ?, `c2` = ?");

  expect($stmt->bindings())
  ->toBe(["test1", "test2"]);

});

test("set raw", function ($bindings)
{

  expect((string) $stmt = SQL::MariaDB->update()->setRaw("c1", "?", $bindings))
  ->toBe("UPDATE SET `c1` = ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);