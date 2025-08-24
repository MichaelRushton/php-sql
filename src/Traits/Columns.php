<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait Columns
{
    protected array $columns = [];

    public function columns(string|array $columns): static
    {

        foreach ((array) $columns as $column) {
            $this->columns[] = $column;
        }

        return $this;

    }

    protected function getColumns(): string
    {

        if (empty($this->columns)) {
            return "";
        }

        $columns = implode(", ", $this->columns);

        return "($columns)";

    }

}
