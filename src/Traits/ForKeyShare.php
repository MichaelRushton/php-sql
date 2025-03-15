<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait ForKeyShare
{

  protected array $for_key_share = [];

  use ForLockOf;

  public function forKeyShare(string|array|null $table = null): static
  {

    $this->for_key_share[] = ["FOR KEY SHARE", $this->getForLockOf($table)];

    return $this;

  }

  public function forKeyShareNoWait(string|array|null $table = null): static
  {

    $this->for_key_share[] = ["FOR KEY SHARE", $this->getForLockOf($table), "NOWAIT"];

    return $this;

  }

  public function forKeyShareSkipLocked(string|array|null $table = null): static
  {

    $this->for_key_share[] = ["FOR KEY SHARE", $this->getForLockOf($table), "SKIP LOCKED"];

    return $this;

  }

  protected function getForKeyShare(): string
  {

    if (empty($this->for_key_share))
    {
      return "";
    }

    foreach ($this->for_key_share as $f)
    {
      $for_key_share[] = implode(" ", array_filter($f));
    }

    return implode(" ", $for_key_share);

  }

}