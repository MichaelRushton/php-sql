<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("materialized", function ()
{

  expect((string) SQL::SQLite->cte("cte", "SELECT *")->materialized())
  ->toBe('"cte" AS MATERIALIZED (SELECT *)');

});

test("not materialized", function ()
{

  expect((string) SQL::SQLite->cte("cte", "SELECT *")->notMaterialized())
  ->toBe('"cte" AS NOT MATERIALIZED (SELECT *)');

});