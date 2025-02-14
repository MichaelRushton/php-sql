<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait Delayed
{

  protected string $delayed = "";

  public function delayed(): static
  {

    $this->delayed = "DELAYED";

    return $this;

  }

}