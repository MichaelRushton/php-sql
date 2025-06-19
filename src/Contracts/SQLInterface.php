<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts;

use MichaelRushton\SQL\Contracts\Statements\DeleteInterface;
use MichaelRushton\SQL\Contracts\Statements\InsertInterface;
use MichaelRushton\SQL\Contracts\Statements\SelectInterface;
use MichaelRushton\SQL\Contracts\Statements\UpdateInterface;

interface SQLInterface
{

  public function delete(): DeleteInterface;

  public function insert(): InsertInterface;

  public function select(): SelectInterface;

  public function update(): UpdateInterface;

}