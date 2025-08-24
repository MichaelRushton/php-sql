<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Components\Upsert;
use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use Stringable;

trait OnConflict
{
    protected array $on_conflict = [];

    public function onConflictDoNothing(?Closure $callback = null): static
    {

        $this->on_conflict[] = $upsert = new Upsert();

        if ($callback) {
            $callback->call($upsert, $upsert);
        }

        return $this;

    }

    public function onConflictDoUpdateSet(
        string|array $column,
        string|Stringable|int|float|bool|null|Closure $value = null,
        ?Closure $callback = null
    ): static {

        if ($value instanceof Closure) {
            [$value, $callback] = [null, $value];
        }

        $this->on_conflict[] = $upsert = (new Upsert())->set($column, $value);

        if ($callback) {
            $callback->call($upsert, $upsert);
        }

        return $this;

    }

    protected function getOnConflict(): string
    {

        if (empty($this->on_conflict)) {
            return "";
        }

        foreach ($this->on_conflict as $action) {

            $on_conflict[] = "ON CONFLICT $action";

            if ($action instanceof HasBindings) {
                $this->mergeBindings($action);
            }

        }

        return implode(" ", $on_conflict);

    }

}
