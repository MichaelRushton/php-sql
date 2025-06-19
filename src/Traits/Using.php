<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use Stringable;

trait Using
{

  protected array $using = [];

  public function using(string|Stringable|array $table): static
  {

    $tables = is_array($table) ? $table : [$table];

    foreach ($tables as $table)
    {
      $this->using[] = $table;
    }

    return $this;

  }

  protected function getUsing(): string
  {

    if (empty($this->using))
    {
      return "";
    }

    $using = implode(", ", $this->using);

    foreach ($this->using as $table)
    {

      if ($table instanceof HasBindings)
      {
        $this->mergeBindings($table);
      }

    }

    return "USING $using";

  }

}