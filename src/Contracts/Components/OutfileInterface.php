<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Components;

interface OutfileInterface
{

  public function characterSet(string $name): static;

  public function fieldsTerminatedBy(string $string): static;

  public function fieldsEnclosedBy(string $char): static;

  public function fieldsOptionallyEnclosedBy(string $char): static;

  public function fieldsEscapedBy(string $char): static;

  public function linesStartingBy(string $string): static;

  public function linesTerminatedBy(string $string): static;

}