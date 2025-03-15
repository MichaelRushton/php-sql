<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Services\Subquery;

trait ToSubquery
{

  public function toSubquery(): Subquery
  {
    return $this->sql->subquery($this);
  }

}