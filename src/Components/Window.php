<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Contracts\Components\WindowInterface;
use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\FrameSpec;
use MichaelRushton\SQL\Traits\OrderBy;
use MichaelRushton\SQL\Traits\PartitionBy;
use MichaelRushton\SQL\Traits\SpecName;
use Stringable;

class Window implements WindowInterface, HasBindings, Stringable
{
    use Bindings;
    use FrameSpec;
    use OrderBy;
    use PartitionBy;
    use SpecName;

    public function __construct(public readonly string $name)
    {
    }

    protected function getSpec(): string
    {

        return implode(" ", array_filter([
          $this->spec_name,
          $this->getPartitionBy(),
          $this->getOrderBy(),
          $this->getFrameSpec(),
        ], "strlen"));

    }

    public function __toString(): string
    {

        $this->bindings = [];

        $spec = $this->getSpec();

        return "$this->name AS ($spec)";

    }

}
