<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait ForNoKeyUpdate
{
    use ForLockOf;

    protected array $for_no_key_update = [];

    public function forNoKeyUpdate(string|array|null $table = null): static
    {

        $this->for_no_key_update[] = ["FOR NO KEY UPDATE", $this->getForLockOf($table)];

        return $this;

    }

    public function forNoKeyUpdateNoWait(string|array|null $table = null): static
    {

        $this->for_no_key_update[] = ["FOR NO KEY UPDATE", $this->getForLockOf($table), "NOWAIT"];

        return $this;

    }

    public function forNoKeyUpdateSkipLocked(string|array|null $table = null): static
    {

        $this->for_no_key_update[] = ["FOR NO KEY UPDATE", $this->getForLockOf($table), "SKIP LOCKED"];

        return $this;

    }

    protected function getForNoKeyUpdate(): string
    {

        if (empty($this->for_no_key_update)) {
            return "";
        }

        foreach ($this->for_no_key_update as $f) {
            $for_no_key_update[] = implode(" ", array_filter($f));
        }

        return implode(" ", $for_no_key_update);

    }

}
