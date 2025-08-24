<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Outfile;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("into outfile", function ($path, $expected) {

    expect(
        (string) (new Select(SQL::MariaDB))
    ->intoOutfile($path, fn (Outfile $outfile) => $outfile->characterSet("utf8"))
    )
    ->toBe("SELECT * INTO OUTFILE '$expected' CHARACTER SET utf8");

})
->with([
  ["path", "path"],
  ["'path'", "''path''"],
]);
