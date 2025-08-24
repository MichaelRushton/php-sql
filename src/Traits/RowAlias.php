<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait RowAlias
{
    protected string $row_alias = "";

    public function as(
        string $row_alias,
        string|array|null $column_aliases = null
    ): static {

        $this->row_alias = "AS $row_alias";

        if ($column_aliases = implode(", ", (array) $column_aliases)) {
            $this->row_alias .= " ($column_aliases)";
        }

        return $this;

    }

}
