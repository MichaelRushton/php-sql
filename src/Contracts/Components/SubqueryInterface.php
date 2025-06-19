<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Components;

interface SubqueryInterface
{

  public function all(): static;

  public function any(): static;

  public function exists(): static;

  public function in(): static;

  public function lateral(): static;

  public function as(string $alias): static;

  public function columns(string|array $columns): static;

}