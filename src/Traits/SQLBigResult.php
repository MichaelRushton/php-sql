<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait SQLBigResult
{

  protected string $sql_big_result = "";

  public function sqlBigResult(): static
  {

    $this->sql_big_result = "SQL_BIG_RESULT";

    return $this;

  }

}