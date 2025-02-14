<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use DateTimeInterface;

trait ForSystemTime
{

  protected string $for_system_time = "";

  public function forSystemTimeAsOf(string|DateTimeInterface $datetime): static
  {

    if ($datetime instanceof DateTimeInterface)
    {
      $datetime = $datetime->format("Y-m-d H:i:s");
    }

    return $this->forSystemTimeAsOfRaw("'$datetime'");

  }

  public function forSystemTimeAsOfRaw(string $expression): static
  {

    $this->for_system_time = "FOR SYSTEM_TIME AS OF $expression";

    return $this;

  }

  public function forSystemTimeBetween(
    string|DateTimeInterface $datetime_start,
    string|DateTimeInterface $datetime_end
  ): static
  {

    foreach ([&$datetime_start, &$datetime_end] as &$datetime)
    {

      if ($datetime instanceof DateTimeInterface)
      {
        $datetime = $datetime->format("Y-m-d H:i:s");
      }

    }

    return $this->forSystemTimeBetweenRaw("'$datetime_start'", "'$datetime_end'");

  }

  public function forSystemTimeBetweenRaw(
    string $expression_start,
    string $expression_end
  ): static
  {

    $this->for_system_time = "FOR SYSTEM_TIME BETWEEN $expression_start AND $expression_end";

    return $this;

  }

  public function forSystemTimeFrom(
    string|DateTimeInterface $datetime_start,
    string|DateTimeInterface $datetime_end
  ): static
  {

    foreach ([&$datetime_start, &$datetime_end] as &$datetime)
    {

      if ($datetime instanceof DateTimeInterface)
      {
        $datetime = $datetime->format("Y-m-d H:i:s");
      }

    }

    return $this->forSystemTimeFromRaw("'$datetime_start'", "'$datetime_end'");

  }

  public function forSystemTimeFromRaw(
    string $expression_start,
    string $expression_end
  ): static
  {

    $this->for_system_time = "FOR SYSTEM_TIME FROM $expression_start TO $expression_end";

    return $this;

  }

  public function forSystemTimeAll(): static
  {

    $this->for_system_time = "FOR SYSTEM_TIME ALL";

    return $this;

  }

}