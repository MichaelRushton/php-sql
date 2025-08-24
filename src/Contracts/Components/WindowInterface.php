<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Components;

use Stringable;

interface WindowInterface
{
    public function specName(string $name): static;

    public function partitionBy(string|Stringable|array $column): static;

    public function orderBy(string|Stringable|array $column): static;

    public function orderByDesc(string|Stringable|array $column): static;

    public function orderByNullsFirst(string|Stringable|array $column): static;

    public function orderByNullsLast(string|Stringable|array $column): static;

    public function orderByDescNullsFirst(string|Stringable|array $column): static;

    public function orderByDescNullsLast(string|Stringable|array $column): static;

    public function range(): static;

    public function rows(): static;

    public function groups(): static;

    public function currentRow(): static;

    public function unboundedPreceding(): static;

    public function unboundedFollowing(): static;

    public function preceding(int|string|Stringable $expression): static;

    public function following(int|string|Stringable $expression): static;

    public function betweenCurrentRow(): static;

    public function betweenUnboundedPreceding(): static;

    public function betweenUnboundedFollowing(): static;

    public function betweenPreceding(int|string|Stringable $expression): static;

    public function betweenFollowing(int|string|Stringable $expression): static;

    public function andCurrentRow(): static;

    public function andUnboundedPreceding(): static;

    public function andUnboundedFollowing(): static;

    public function andPreceding(int|string|Stringable $expression): static;

    public function andFollowing(int|string|Stringable $expression): static;

    public function excludeCurrentRow(): static;

    public function excludeGroup(): static;

    public function excludeNoOthers(): static;

    public function excludeTies(): static;

}
