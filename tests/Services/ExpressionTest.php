<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Expression;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("expression", function ($input, $output, $bindings = [])
{

  expect(
    (string) $expression = (new Expression(SQL::SQLite, $input))
    ->as("a")
  )
  ->toBe("$output AS \"a\"");

  expect($expression->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [1, "1"],
  [1.1, "1.1"],
]);