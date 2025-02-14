<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait Only
{

  protected string $only = "";

  public function only(): static
  {

    $this->only = "ONLY";

    return $this;

  }

}