<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use Stringable;

trait PartitionBy
{
    protected array $partition_by = [];

    public function partitionBy(string|Stringable|array $column): static
    {

        $columns = is_array($column) ? $column : [$column];

        foreach ($columns as $column) {
            $this->partition_by[] = $column;
        }

        return $this;

    }

    protected function getPartitionBy(): string
    {

        if (empty($this->partition_by)) {
            return "";
        }

        $partition_by = implode(", ", $this->partition_by);

        foreach ($this->partition_by as $column) {

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return "PARTITION BY $partition_by";

    }

}
