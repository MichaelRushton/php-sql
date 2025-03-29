<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("into var", function ($var, $expected)
{

  expect(
    (string) (new Select(SQL::MariaDB))
    ->intoVar($var)
  )
  ->toBe("SELECT * INTO $expected");

})
->with([
  ["v1", "@v1"],
  [["v1", "v2"], "@v1, @v2"],
]);