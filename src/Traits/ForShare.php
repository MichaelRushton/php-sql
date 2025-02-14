<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait ForShare
{

  protected array $for_share = [];

  use ForLockOf;

  public function forShare(string|array|null $table = null): static
  {

    $this->for_share[] = ["FOR SHARE", $this->getForLockOf($table)];

    return $this;

  }

  public function forShareNoWait(string|array|null $table = null): static
  {

    $this->for_share[] = ["FOR SHARE", $this->getForLockOf($table), "NOWAIT"];

    return $this;

  }

  public function forShareSkipLocked(string|array|null $table = null): static
  {

    $this->for_share[] = ["FOR SHARE", $this->getForLockOf($table), "SKIP LOCKED"];

    return $this;

  }

  protected function getForShare(): string
  {

    if (empty($this->for_share))
    {
      return "";
    }

    foreach ($this->for_share as $f)
    {
      $for_share[] = implode(" ", array_filter($f));
    }

    return implode(" ", $for_share);

  }

}