<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;

test("raw", function ($bindings)
{

  expect((string) $raw = new Raw("?", $bindings))
  ->toBe("?");

  expect($raw->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);