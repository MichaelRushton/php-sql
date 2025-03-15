<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("output", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::TransactSQL->update()->output($column))
  ->toBe("UPDATE OUTPUT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "[c1]"],
  ["DELETED.c1", "DELETED.[c1]"],
  ["INSERTED.c1", "INSERTED.[c1]"],
  ["*", "*"],
  [new Raw("?", 1), "?", [1]],
  [SQL::TransactSQL->select(), "(SELECT *)"],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c1", "c2"], "[c1], [c2]"],
]);

test("output deleted", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::TransactSQL->delete()->output($column))
  ->toBe("DELETE OUTPUT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "DELETED.[c1]"],
  ["DELETED.c1", "DELETED.[c1]"],
  ["*", "DELETED.*"],
  [new Raw("?", 1), "?", [1]],
  [SQL::TransactSQL->select(), "(SELECT *)"],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c1", "c2"], "DELETED.[c1], DELETED.[c2]"],
]);

test("output inserted", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::TransactSQL->insert()->output($column))
  ->toBe("INSERT OUTPUT $output DEFAULT VALUES");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "INSERTED.[c1]"],
  ["INSERTED.c1", "INSERTED.[c1]"],
  ["*", "INSERTED.*"],
  [new Raw("?", 1), "?", [1]],
  [SQL::TransactSQL->select(), "(SELECT *)"],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c1", "c2"], "INSERTED.[c1], INSERTED.[c2]"],
]);

test("output with alias", function ($column, $output)
{

  expect((string) SQL::TransactSQL->update()->output($column))
  ->toBe("UPDATE OUTPUT $output");

})
->with([
  [["c2" => "c1"], "[c1] AS [c2]"],
  [["c2" => new Raw("c1")], "c1 AS [c2]"],
  [["c1" => SQL::TransactSQL->select()], "(SELECT *) AS [c1]"],
]);

test("output raw", function ($bindings)
{

  expect((string) $stmt = SQL::TransactSQL->update()->outputRaw("?", $bindings))
  ->toBe("UPDATE OUTPUT ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);