<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("into dumpfile", function ($path, $expected) {

    expect(
        (string) (new Select(SQL::MariaDB))
    ->intoDumpfile($path)
    )
    ->toBe("SELECT * INTO DUMPFILE '$expected'");

})
->with([
  ["path", "path"],
  ["'path'", "''path''"],
]);
