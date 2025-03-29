<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Contracts\Statements\SelectInterface;
use MichaelRushton\SQL\Contracts\Traits\CanConvertToSubquery;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\Distinct;
use MichaelRushton\SQL\Traits\ForKeyShare;
use MichaelRushton\SQL\Traits\ForNoKeyUpdate;
use MichaelRushton\SQL\Traits\ForShare;
use MichaelRushton\SQL\Traits\ForUpdate;
use MichaelRushton\SQL\Traits\From;
use MichaelRushton\SQL\Traits\GroupBy;
use MichaelRushton\SQL\Traits\Having;
use MichaelRushton\SQL\Traits\HighPriority;
use MichaelRushton\SQL\Traits\Into;
use MichaelRushton\SQL\Traits\IntoDumpfile;
use MichaelRushton\SQL\Traits\IntoOutfile;
use MichaelRushton\SQL\Traits\IntoVar;
use MichaelRushton\SQL\Traits\Join;
use MichaelRushton\SQL\Traits\Limit;
use MichaelRushton\SQL\Traits\LockInShareMode;
use MichaelRushton\SQL\Traits\OffsetFetch;
use MichaelRushton\SQL\Traits\OrderBy;
use MichaelRushton\SQL\Traits\RowsExamined;
use MichaelRushton\SQL\Traits\SelectColumns;
use MichaelRushton\SQL\Traits\SetOperation;
use MichaelRushton\SQL\Traits\SQLBigResult;
use MichaelRushton\SQL\Traits\SQLBufferResult;
use MichaelRushton\SQL\Traits\SQLCache;
use MichaelRushton\SQL\Traits\SQLCalcFoundRows;
use MichaelRushton\SQL\Traits\SQLSmallResult;
use MichaelRushton\SQL\Traits\StraightJoin;
use MichaelRushton\SQL\Traits\Top;
use MichaelRushton\SQL\Traits\ToSubquery;
use MichaelRushton\SQL\Traits\Where;
use MichaelRushton\SQL\Traits\Window;
use MichaelRushton\SQL\Traits\With;
use MichaelRushton\SQL\Traits\WithTies;

class Select extends Statement implements SelectInterface, CanConvertToSubquery
{

  use Distinct;
  use ForKeyShare;
  use ForNoKeyUpdate;
  use ForShare;
  use ForUpdate;
  use From;
  use GroupBy;
  use Having;
  use HighPriority;
  use Into;
  use IntoDumpfile;
  use IntoOutfile;
  use IntoVar;
  use Join;
  use Limit;
  use LockInShareMode;
  use OffsetFetch;
  use OrderBy;
  use RowsExamined;
  use SelectColumns;
  use SetOperation;
  use SQLBigResult;
  use SQLBufferResult;
  use SQLCache;
  use SQLCalcFoundRows;
  use SQLSmallResult;
  use StraightJoin;
  use Top;
  use ToSubquery;
  use Where;
  use Window;
  use With;
  use WithTies;

  protected function toArray(): array
  {

    return match ($this->sql())
    {

      SQL::MariaDB => [
        $this->getWith(),
        "SELECT",
        $this->distinct,
        $this->high_priority,
        $this->straight_join,
        $this->sql_small_result,
        $this->sql_big_result,
        $this->sql_buffer_result,
        $this->sql_cache,
        $this->sql_calc_found_rows,
        $this->getColumns(),
        $this->getFrom(),
        $this->getJoin(),
        $this->getWhere(),
        $this->getGroupBy(),
        $this->getHaving(),
        $this->getSetOperation(),
        $this->getOrderBy(),
        $this->getLimit() ?: $this->getOffsetFetch(),
        $this->getRowsExamined(),
        $this->getIntoOutfile(),
        $this->into_dumpfile,
        $this->getIntoVar(),
        $this->getForUpdate(),
        $this->lock_in_share_mode,
      ],

      SQL::MySQL => [
        $this->getWith(),
        "SELECT",
        $this->distinct,
        $this->high_priority,
        $this->straight_join,
        $this->sql_small_result,
        $this->sql_big_result,
        $this->sql_buffer_result,
        $this->sql_calc_found_rows,
        $this->getColumns(),
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
      ],

      SQL::PostgreSQL => [
        $this->getWith(),
        "SELECT",
        $this->distinct,
        $this->getColumns(),
        $this->getFrom(),
        $this->getJoin(),
        $this->getWhere(),
        $this->getGroupBy(),
        $this->getHaving(),
        $this->getWindow(),
        $this->getSetOperation(),
        $this->getOrderBy(),
        $this->getLimit() ?: $this->getOffsetFetch(),
        $this->getForUpdate(),
        $this->getForNoKeyUpdate(),
        $this->getForShare(),
        $this->getForKeyShare(),
      ],

      SQL::SQLite => [
        $this->getWith(),
        "SELECT",
        $this->distinct,
        $this->getColumns(),
        $this->getFrom(),
        $this->getJoin(),
        $this->getWhere(),
        $this->getGroupBy(),
        $this->getHaving(),
        $this->getWindow(),
        $this->getSetOperation(),
        $this->getOrderBy(),
        $this->getLimit(),
      ],

      SQL::TransactSQL => [
        $this->getWith(),
        "SELECT",
        $this->distinct,
        $this->getTop(),
        $this->getColumns(),
        $this->into,
        $this->getFrom(),
        $this->getJoin(),
        $this->getWhere(),
        $this->getGroupBy(),
        $this->getHaving(),
        $this->getWindow(),
        $this->getSetOperation(),
        $this->getOrderBy(),
        $this->getOffsetFetch(),
      ],

    };

  }

}