<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\Delayed;
use MichaelRushton\SQL\Traits\InsertSelect;
use MichaelRushton\SQL\Traits\Into;
use MichaelRushton\SQL\Traits\LowPriority;
use MichaelRushton\SQL\Traits\Returning;
use MichaelRushton\SQL\Traits\Set;
use MichaelRushton\SQL\Traits\Values;
use MichaelRushton\SQL\Traits\With;

abstract class Replace extends Statement
{
  use Columns;
  use Delayed;
  use InsertSelect;
  use Into;
  use LowPriority;
  use Returning;
  use Set;
  use Values;
  use With;
}