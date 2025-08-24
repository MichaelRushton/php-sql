<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("order by", function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->orderBy($column)
    )
    ->toBe("SELECT * ORDER BY $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1", "c2"], "c1, c2"],
]);

test("order by desc", function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->orderByDesc($column)
    )
    ->toBe("SELECT * ORDER BY $expected DESC");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1", "c2"], "c1 DESC, c2"],
]);

test("order by nulls first", function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->orderByNullsFirst($column)
    )
    ->toBe("SELECT * ORDER BY $expected ASC NULLS FIRST");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1", "c2"], "c1 ASC NULLS FIRST, c2"],
]);

test("order by nulls last", function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->orderByNullsLast($column)
    )
    ->toBe("SELECT * ORDER BY $expected ASC NULLS LAST");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1", "c2"], "c1 ASC NULLS LAST, c2"],
]);

test("order by desc nulls first", function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->orderByDescNullsFirst($column)
    )
    ->toBe("SELECT * ORDER BY $expected DESC NULLS FIRST");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1", "c2"], "c1 DESC NULLS FIRST, c2"],
]);

test("order by desc nulls last", function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->orderByDescNullsLast($column)
    )
    ->toBe("SELECT * ORDER BY $expected DESC NULLS LAST");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1", "c2"], "c1 DESC NULLS LAST, c2"],
]);
