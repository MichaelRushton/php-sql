<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("row alias", function ()
{

  expect((string) SQL::MySQL->insert()->as("new"))
  ->toBe("INSERT VALUES () AS `new`");

});

test("row alias with columns", function ($columns, $output)
{

  expect((string) SQL::MySQL->insert()->as("new", $columns))
  ->toBe("INSERT VALUES () AS `new`($output)");

})
->with([
  ["a", "`a`"],
  [["a", "b"], "`a`, `b`"],
]);