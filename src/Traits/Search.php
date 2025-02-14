<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait Search
{

  protected string $search = "";

  protected function search(
    string $search,
    string|array $first_by,
    string $set
  ): static
  {

    foreach ((array) $first_by as $column)
    {
      $columns[] = $this->sql->quote($column);
    }

    $columns = implode(", ", $columns);

    $this->search = "SEARCH $search FIRST BY $columns SET " . $this->sql->quote($set);

    return $this;

  }

  public function searchBreadth(
    string|array $first_by,
    string $set
  ): static
  {
    return $this->search("BREADTH", $first_by, $set);
  }

  public function searchDepth(
    string|array $first_by,
    string $set
  ): static
  {
    return $this->search("DEPTH", $first_by, $set);
  }

}