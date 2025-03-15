<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait History
{

  protected string $history = "";

  public function history(): static
  {

    $this->history = "HISTORY";

    return $this;

  }

}