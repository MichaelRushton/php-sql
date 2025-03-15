<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Traits\CharacterSet;
use MichaelRushton\SQL\Traits\Fields;
use MichaelRushton\SQL\Traits\Lines;
use Stringable;

class Outfile implements Stringable
{

  protected string $path;

  use CharacterSet;
  use Fields;
  use Lines;

  public function __construct(
    public readonly SQLInterface $sql,
    string $path
  )
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