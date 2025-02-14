<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\MySQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select as StatementsSelect;

class Select extends StatementsSelect
{

  protected SQLInterface $sql = SQL::MySQL;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "SELECT",
      $this->distinct,
      $this->high_priority,
      $this->straight_join,
      $this->sql_small_result,
      $this->sql_big_result,
      $this->sql_buffer_result,
      $this->sql_calc_found_rows,
      $this->getSelect(),
      $this->getFrom(),
      $this->getJoin(),
      $this->getWhere(),
      $this->getGroupBy(),
      $this->getHaving(),
      $this->getWindow(),
      $this->getSetOperation(),
      $this->getOrderBy(),
      $this->getLimit(),
      $this->getIntoOutfile(),
      $this->into_dumpfile,
      $this->getIntoVar(),
      $this->getForUpdate(),
      $this->getForShare(),
      $this->lock_in_share_mode,
    ];

  }

}