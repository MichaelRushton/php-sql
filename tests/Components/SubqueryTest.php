<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Subquery;

test("subquery", function ()
{

  expect(
    (string) (new Subquery("SELECT"))
    ->all()
    ->any()
    ->exists()
    ->in()
    ->lateral()
    ->as("s1")
    ->columns("c1")
  )
  ->toBe(
    implode(" ", [
      "ALL",
      "ANY",
      "EXISTS",
      "IN",
      "LATERAL",
      "(SELECT)",
      "AS s1",
      "(c1)",
    ])
  );

});