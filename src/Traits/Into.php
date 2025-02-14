<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Stringable;

trait Into
{

  protected string $into = "";

  public function into(string|Stringable $table): static
  {

    $this->into = "INTO " . $this->sql->toTable($table);

    return $this;

  }

}