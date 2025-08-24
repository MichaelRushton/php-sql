<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Table;

test("use index", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->useIndex($index)
    )
    ->toBe("t1 USE INDEX ($output)");

})
->with([
  [null, ""],
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);

test("use index for order by", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->useIndexForOrderBy($index)
    )
    ->toBe("t1 USE INDEX FOR ORDER BY ($output)");

})
->with([
  [null, ""],
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);

test("use index for group by", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->useIndexForGroupBy($index)
    )
    ->toBe("t1 USE INDEX FOR GROUP BY ($output)");

})
->with([
  [null, ""],
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);

test("ignore index", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->ignoreIndex($index)
    )
    ->toBe("t1 IGNORE INDEX ($output)");

})
->with([
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);

test("ignore index for order by", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->ignoreIndexForOrderBy($index)
    )
    ->toBe("t1 IGNORE INDEX FOR ORDER BY ($output)");

})
->with([
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);

test("ignore index for group by", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->ignoreIndexForGroupBy($index)
    )
    ->toBe("t1 IGNORE INDEX FOR GROUP BY ($output)");

})
->with([
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);

test("force index", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->forceIndex($index)
    )
    ->toBe("t1 FORCE INDEX ($output)");

})
->with([
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);

test("force index for order by", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->forceIndexForOrderBy($index)
    )
    ->toBe("t1 FORCE INDEX FOR ORDER BY ($output)");

})
->with([
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);

test("force index for group by", function ($index, $output) {

    expect(
        (string) (new Table("t1"))
    ->forceIndexForGroupBy($index)
    )
    ->toBe("t1 FORCE INDEX FOR GROUP BY ($output)");

})
->with([
  ["i1", "i1"],
  [["i1", "i2"], "i1, i2"],
]);
