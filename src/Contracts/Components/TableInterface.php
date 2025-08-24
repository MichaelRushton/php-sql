<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Components;

use DateTimeInterface;

interface TableInterface
{
    public function only(): static;

    public function partition(string|array $partitions): static;

    public function forPortionOf(
        string $date_period,
        string|DateTimeInterface $datetime_start,
        string|DateTimeInterface $datetime_end
    ): static;

    public function as(string $alias): static;

    public function useIndex(string|array|null $index = null): static;

    public function useIndexForOrderBy(string|array|null $index = null): static;

    public function useIndexForGroupBy(string|array|null $index = null): static;

    public function ignoreIndex(string|array $index): static;

    public function ignoreIndexForOrderBy(string|array $index): static;

    public function ignoreIndexForGroupBy(string|array $index): static;

    public function forceIndex(string|array $index): static;

    public function forceIndexForOrderBy(string|array $index): static;

    public function forceIndexForGroupBy(string|array $index): static;

}
