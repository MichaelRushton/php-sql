<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("on duplicate key update", function ($column, $value, $output, $bindings = [])
{

  expect((string) $stmt = SQL::MariaDB->insert()->onDuplicateKeyUpdate($column, $value))
  ->toBe("INSERT VALUES () ON DUPLICATE KEY UPDATE $output");

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

test("on duplicate key update array", function ()
{

  expect((string) $stmt = SQL::MariaDB->insert()->onDuplicateKeyUpdate([
    "c1" => "test1",
    "c2" => "test2",
  ]))
  ->toBe("INSERT VALUES () ON DUPLICATE KEY UPDATE `c1` = ?, `c2` = ?");

  expect($stmt->bindings())
  ->toBe(["test1", "test2"]);

});

test("on duplicate key update raw", function ($bindings)
{

  expect((string) $stmt = SQL::MariaDB->insert()->onDuplicateKeyUpdateRaw("c1", "?", $bindings))
  ->toBe("INSERT VALUES () ON DUPLICATE KEY UPDATE `c1` = ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);