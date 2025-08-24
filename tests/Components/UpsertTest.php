<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Upsert;

test("upsert", function () {

    expect(
        (string) $upsert = (new Upsert())
    ->columns("c1")
    ->whereIndex("c1", 1)
    ->onConstraint("c")
    ->set("c1", 1)
    ->where("c1", 1)
    )
    ->toBe("(c1) WHERE c1 = ? ON CONSTRAINT c DO UPDATE SET c1 = ? WHERE c1 = ?");

    expect($upsert->bindings())
    ->toBe([1, 1, 1]);

});
