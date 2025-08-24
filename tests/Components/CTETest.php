<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\CTE;

test("cte", function () {

    expect(
        (string) (new CTE("cte", "SELECT"))
    ->columns("c1")
    ->materialized()
    ->cycleRestrict("c1")
    ->searchBreadth("c1", "c2")
    ->cycle("c1")
    )
    ->toBe(
        implode(" ", [
        "cte",
        "(c1)",
        "AS",
        "MATERIALIZED",
        "(SELECT)",
        "CYCLE c1 RESTRICT",
        "SEARCH BREADTH FIRST BY c1 SET c2",
        "CYCLE c1 SET is_cycle USING path",
    ])
    );

});
