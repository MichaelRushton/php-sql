<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait RowAlias
{

  protected string $row_alias = "";
  protected array $column_aliases = [];

  public function as(
    string $row_alias,
    string|array|null $column_aliases = null
  ): static
  {

    $this->row_alias = "AS " . $this->sql->quote($row_alias);

    foreach ((array) $column_aliases as $alias)
    {
      $this->column_aliases[] = $this->sql->quote($alias);
    }

    return $this;

  }

  protected function getColumnAliases(): string
  {

    if (empty($this->column_aliases))
    {
      return "";
    }

    $column_aliases = implode(", ", $this->column_aliases);

    return "($column_aliases)";

  }

  protected function getRowAlias(): string
  {

    if ("" === $this->row_alias)
    {
      return "";
    }

    $column_aliases = $this->getColumnAliases();

    return "$this->row_alias$column_aliases";

  }

}