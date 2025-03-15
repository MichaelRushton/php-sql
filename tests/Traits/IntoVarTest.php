<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("into var", function ($var, $output)
{

  expect((string) SQL::MariaDB->select()->intoVar($var))
  ->toBe("SELECT * INTO $output");

})
->with([
  ["v1", "@v1"],
  [["v1", "v2"], "@v1, @v2"],
]);