<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("rows examined", function ($row_count, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::MariaDB))
    ->rowsExamined($row_count)
    )
    ->toBe("SELECT * LIMIT ROWS EXAMINED $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("rows examined with limit", function () {

    expect(
        (string) (new Select(SQL::MariaDB))
    ->limit(5)
    ->rowsExamined(10)
    )
    ->toBe("SELECT * LIMIT 5 ROWS EXAMINED 10");

});
