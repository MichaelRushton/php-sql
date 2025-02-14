<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Bindings;
use Stringable;

class Predicate implements Stringable, HasBindings
{

  protected string|Stringable|int|float|array $expression1;
  protected string $operator = "";
  protected string|Stringable|int|float|array $expression2 = "";

  use Bindings;

  public function __construct(
    public readonly SQLInterface $sql,
    string|Stringable|int|float|bool|null|array $expression1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $expression2 = null,
    ?int $num_args = null
  )
  {

    $this->expression1 = $sql->convert($expression1);

    if (3 === $num_args ??= func_num_args())
    {
      [$operator, $expression2] = [null, $operator];
    }

    if ($num_args > 2)
    {

      $this->operator = static::operator($expression1, $operator, $expression2);

      $this->expression2 = $sql->convert($expression2, bind_string: true);

    }

  }

  public static function operator(
    string|Stringable|int|float|bool|null|array $expression1,
    ?string $operator,
    string|Stringable|int|float|bool|null|array $expression2
  ): string
  {

    return match (true)
    {
      is_string($operator) => $operator,
      is_null($expression2) => "IS",
      is_array($expression2) && !is_array($expression1) => "IN",
      default => "=",
    };

  }

  protected function fromArray(
    string|Stringable|int|float|array $expression,
    ?string $operator = null
  ): string|Stringable|int|float
  {

    return match (true)
    {
      !is_array($expression) => $expression,
      "BETWEEN" === $operator => implode(" AND ", $expression),
      default => "(" . implode(", ", $expression) . ")",
    };

  }

  public function __toString(): string
  {

    $this->bindings = [];

    $expression1 = $this->fromArray($this->expression1);
    $expression2 = $this->fromArray($this->expression2, $this->operator);

    $predicate = "$expression1 $this->operator $expression2";

    foreach ([$this->expression1, $this->expression2] as $expression)
    {

      $expression = is_array($expression) ? $expression : [$expression];

      foreach ($expression as $part)
      {

        if ($part instanceof HasBindings)
        {
          $this->mergeBindings($part);
        }

      }

    }

    return trim($predicate);

  }

}