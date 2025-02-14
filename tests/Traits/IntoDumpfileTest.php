<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("into dumpfile", function ($path, $output)
{

  expect((string) SQL::MariaDB->select()->intoDumpfile($path))
  ->toBe("SELECT * INTO DUMPFILE '$output'");

})
->with([
  ["path", "path"],
  ["'path'", "''path''"],
]);