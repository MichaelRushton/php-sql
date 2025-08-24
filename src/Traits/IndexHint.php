<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait IndexHint
{
    protected array $index_hint = [];

    protected function index(
        string $type,
        string|array|null $index,
        string $for = ""
    ): static {

        $index = implode(", ", (array) $index);

        $this->index_hint[] = "$type INDEX$for ($index)";

        return $this;

    }

    public function useIndex(string|array|null $index = null): static
    {
        return $this->index("USE", $index);
    }

    public function useIndexForOrderBy(string|array|null $index = null): static
    {
        return $this->index("USE", $index, " FOR ORDER BY");
    }

    public function useIndexForGroupBy(string|array|null $index = null): static
    {
        return $this->index("USE", $index, " FOR GROUP BY");
    }

    public function ignoreIndex(string|array $index): static
    {
        return $this->index("IGNORE", $index);
    }

    public function ignoreIndexForOrderBy(string|array $index): static
    {
        return $this->index("IGNORE", $index, " FOR ORDER BY");
    }

    public function ignoreIndexForGroupBy(string|array $index): static
    {
        return $this->index("IGNORE", $index, " FOR GROUP BY");
    }

    public function forceIndex(string|array $index): static
    {
        return $this->index("FORCE", $index);
    }

    public function forceIndexForOrderBy(string|array $index): static
    {
        return $this->index("FORCE", $index, " FOR ORDER BY");
    }

    public function forceIndexForGroupBy(string|array $index): static
    {
        return $this->index("FORCE", $index, " FOR GROUP BY");
    }

    protected function getIndexHint(): string
    {
        return implode(", ", $this->index_hint);
    }

}
