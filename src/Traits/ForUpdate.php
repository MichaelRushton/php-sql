<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait ForUpdate
{
    use ForLockOf;

    protected array $for_update = [];

    public function forUpdate(string|array|null $table = null): static
    {

        $this->for_update[] = ["FOR UPDATE", $this->getForLockOf($table)];

        return $this;

    }

    public function forUpdateWait(int $seconds): static
    {

        $this->for_update[] = ["FOR UPDATE WAIT $seconds"];

        return $this;

    }

    public function forUpdateNoWait(string|array|null $table = null): static
    {

        $this->for_update[] = ["FOR UPDATE", $this->getForLockOf($table), "NOWAIT"];

        return $this;

    }

    public function forUpdateSkipLocked(string|array|null $table = null): static
    {

        $this->for_update[] = ["FOR UPDATE", $this->getForLockOf($table), "SKIP LOCKED"];

        return $this;

    }

    protected function getForUpdate(): string
    {

        if (empty($this->for_update)) {
            return "";
        }

        foreach ($this->for_update as $f) {
            $for_update[] = implode(" ", array_filter($f));
        }

        return implode(" ", $for_update);

    }

}
