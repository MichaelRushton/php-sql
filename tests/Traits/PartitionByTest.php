<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\Components\Window;

test("partition by", function ($column, $expected, $bindings = []) {

    expect(
        (string) $window = (new Window("w"))
    ->partitionBy($column)
    )
    ->toBe("w AS (PARTITION BY $expected)");

    expect($window->bindings())
    ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], "c1, c2"],
]);
