<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Window as ServicesWindow;

trait Window
{

  protected array $window = [];

  public function window(
    string $name,
    ?Closure $callback = null,
  ): static
  {

    $this->window[] = $window = new ServicesWindow($this->sql, $name);

    if ($callback)
    {
      $callback($window);
    }

    return $this;

  }

  protected function getWindow(): string
  {

    if (empty($this->window))
    {
      return "";
    }

    $window = implode(", ", $this->window);

    foreach ($this->window as $w)
    {

      if ($w instanceof HasBindings)
      {
        $this->mergeBindings($w);
      }

    }

    return "WINDOW $window";

  }

}