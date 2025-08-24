<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Contracts\Components\OutfileInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Traits\CharacterSet;
use MichaelRushton\SQL\Traits\Fields;
use MichaelRushton\SQL\Traits\Lines;
use Stringable;

class Outfile implements OutfileInterface, Stringable
{
    use CharacterSet;
    use Fields;
    use Lines;

    public function __construct(protected string $path)
    {
        $this->path = SQL::escape($path);
    }

    public function __toString(): string
    {

        return implode(" ", array_filter([
          "'$this->path'",
          $this->character_set,
          $this->getFields(),
          $this->getLines(),
        ], "strlen"));

    }

}
