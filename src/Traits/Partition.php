<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait Partition
{
    protected array $partitions = [];

    public function partition(string|array $partitions): static
    {

        foreach ((array) $partitions as $partition) {
            $this->partitions[] = $partition;
        }

        return $this;

    }

    protected function getPartition(): string
    {

        if (empty($this->partitions)) {
            return "";
        }

        $partitions = implode(", ", $this->partitions);

        return "PARTITION ($partitions)";

    }

}
