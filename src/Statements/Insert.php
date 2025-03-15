<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\Delayed;
use MichaelRushton\SQL\Traits\HighPriority;
use MichaelRushton\SQL\Traits\Ignore;
use MichaelRushton\SQL\Traits\InsertSelect;
use MichaelRushton\SQL\Traits\Into;
use MichaelRushton\SQL\Traits\LowPriority;
use MichaelRushton\SQL\Traits\OnConflict;
use MichaelRushton\SQL\Traits\OnDuplicateKeyUpdate;
use MichaelRushton\SQL\Traits\OrOnConflict;
use MichaelRushton\SQL\Traits\Output;
use MichaelRushton\SQL\Traits\Overriding;
use MichaelRushton\SQL\Traits\Returning;
use MichaelRushton\SQL\Traits\RowAlias;
use MichaelRushton\SQL\Traits\Set;
use MichaelRushton\SQL\Traits\Top;
use MichaelRushton\SQL\Traits\Values;
use MichaelRushton\SQL\Traits\With;

abstract class Insert extends Statement
{
  use Columns;
  use Delayed;
  use HighPriority;
  use Ignore;
  use InsertSelect;
  use Into;
  use LowPriority;
  use OnConflict;
  use OnDuplicateKeyUpdate;
  use OrOnConflict;
  use Output;
  use Overriding;
  use Returning;
  use RowAlias;
  use Set;
  use Top;
  use Values;
  use With;
}