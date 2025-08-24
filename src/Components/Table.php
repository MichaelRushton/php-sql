<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Contracts\Components\TableInterface;
use MichaelRushton\SQL\Traits\Alias;
use MichaelRushton\SQL\Traits\ForPortionOf;
use MichaelRushton\SQL\Traits\IndexHint;
use MichaelRushton\SQL\Traits\Only;
use MichaelRushton\SQL\Traits\Partition;
use Stringable;

class Table implements TableInterface, Stringable
{
    use Alias;
    use ForPortionOf;
    use IndexHint;
    use Only;
    use Partition;

    public function __construct(public readonly string $name)
    {
    }

    public function __toString(): string
    {

        return implode(" ", array_filter([
          $this->only,
          $this->name,
          $this->getPartition(),
          $this->for_portion_of,
          $this->alias,
          $this->getIndexHint(),
        ]));

    }

}
