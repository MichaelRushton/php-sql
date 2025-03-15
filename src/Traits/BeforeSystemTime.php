<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use DateTimeInterface;

trait BeforeSystemTime
{

  protected string $before_system_time = "";

  public function beforeSystemTime(string|DateTimeInterface $datetime): static
  {

    if ($datetime instanceof DateTimeInterface)
    {
      $datetime = $datetime->format("Y-m-d H:i:s");
    }

    return $this->beforeSystemTimeRaw("'$datetime'");

  }

  public function beforeSystemTimeRaw(string $expression): static
  {

    $this->before_system_time = "BEFORE SYSTEM_TIME $expression";

    return $this;

  }

}