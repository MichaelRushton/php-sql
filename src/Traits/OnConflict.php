<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Upsert;
use Stringable;

trait OnConflict
{

  protected array $on_conflict = [];

  public function onConflict(string|Stringable|array $on_conflict): static
  {

    $on_conflict = is_array($on_conflict) ? $on_conflict : [$on_conflict];

    foreach ($on_conflict as $action)
    {
      $this->on_conflict[] = $action;
    }

    return $this;

  }

  public function onConflictDoNothing(?Closure $callback = null): static
  {

    $this->on_conflict[] = $upsert = new Upsert($this->sql);

    if ($callback)
    {
      $callback($upsert);
    }

    return $this;

  }

  public function onConflictDoUpdateSet(
    string|array $column,
    string|Stringable|int|float|bool|null|array|Closure $value = null,
    ?Closure $callback = null
  ): static
  {

    if ($value instanceof Closure)
    {
      [$value, $callback] = [null, $value];
    }

    $args = is_array($column) && is_null($value) ? [$column] : [$column, $value];

    $this->on_conflict[] = $upsert = (new Upsert($this->sql))->set(...$args);

    if ($callback)
    {
      $callback($upsert);
    }

    return $this;

  }

  public function onConflictDoUpdateSetRaw(
    string|array $column,
    string $expression,
    string|int|float|bool|array $bindings = [],
    ?Closure $callback = null
  ): static
  {

    $this->on_conflict[] = $upsert = (new Upsert($this->sql))->setRaw($column, $expression, $bindings);

    if ($callback)
    {
      $callback($upsert);
    }

    return $this;

  }

  protected function getOnConflict(): string
  {

    if (empty($this->on_conflict))
    {
      return "";
    }

    foreach ($this->on_conflict as $action)
    {

      $on_conflict[] = "ON CONFLICT $action";

      if ($action instanceof HasBindings)
      {
        $this->mergeBindings($action);
      }

    }

    return implode(" ", $on_conflict);

  }

}