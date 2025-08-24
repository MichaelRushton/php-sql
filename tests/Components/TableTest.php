<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Table;

test("table", function () {

    expect(
        (string) (new Table("t1"))
    ->only()
    ->partition("p1")
    ->forPortionOf("date", "2024-01-01", "2025-01-01")
    ->as("t2")
    ->useIndex()
    )
    ->toBe(implode(" ", [
      "ONLY",
      "t1",
      "PARTITION (p1)",
      "FOR PORTION OF date FROM '2024-01-01' TO '2025-01-01'",
      "AS t2",
      "USE INDEX ()",
    ]));

});
