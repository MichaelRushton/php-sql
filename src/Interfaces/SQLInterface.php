<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Interfaces;

use MichaelRushton\SQL\Interfaces\Statements\DeleteInterface;
use MichaelRushton\SQL\Interfaces\Statements\InsertInterface;
use MichaelRushton\SQL\Interfaces\Statements\SelectInterface;
use MichaelRushton\SQL\Interfaces\Statements\UpdateInterface;

interface SQLInterface
{
    public function delete(): DeleteInterface;

    public function insert(): InsertInterface;

    public function select(): SelectInterface;

    public function update(): UpdateInterface;

}
