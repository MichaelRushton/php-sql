<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Outfile;
use MichaelRushton\SQL\SQL;

test("into outfile", function ($path, $output)
{

  expect((string) SQL::MariaDB->select()->intoOutfile($path, function (Outfile $outfile)
  {

  }))
  ->toBe("SELECT * INTO OUTFILE '$output'");

})
->with([
  ["path", "path"],
  ["'path'", "''path''"],
]);