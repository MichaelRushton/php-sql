<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\HasAlias;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Alias;
use MichaelRushton\SQL\Traits\BeforeSystemTime;
use MichaelRushton\SQL\Traits\ForPortionOf;
use MichaelRushton\SQL\Traits\ForSystemTime;
use MichaelRushton\SQL\Traits\IndexHint;
use MichaelRushton\SQL\Traits\Only;
use MichaelRushton\SQL\Traits\Partition;
use Stringable;

abstract class Table implements Stringable, HasAlias
{

  protected SQLInterface $sql;

  use Alias;
  use BeforeSystemTime;
  use ForPortionOf;
  use ForSystemTime;
  use IndexHint;
  use Only;
  use Partition;

  public function __construct(protected string $name)
  {
    $this->name = $this->sql->quote($name);
  }

  abstract protected function toArray(): array;

  public function __toString(): string
  {
    return implode(" ", array_filter($this->toArray()));
  }

}