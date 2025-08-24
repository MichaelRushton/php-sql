<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use Stringable;

trait Output
{
    protected array $output = [];

    public function output(string|Stringable|int|float|array $columns): static
    {

        $columns = is_array($columns) ? $columns : [$columns];

        foreach ($columns as $column) {
            $this->output[] = $column;
        }

        return $this;

    }

    protected function getOutput(): string
    {

        if (empty($this->output)) {
            return "";
        }

        $output = implode(", ", $this->output);

        foreach ($this->output as $column) {

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return "OUTPUT $output";

    }

}
