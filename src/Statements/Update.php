<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\From;
use MichaelRushton\SQL\Traits\Ignore;
use MichaelRushton\SQL\Traits\Join;
use MichaelRushton\SQL\Traits\Limit;
use MichaelRushton\SQL\Traits\LowPriority;
use MichaelRushton\SQL\Traits\OrderBy;
use MichaelRushton\SQL\Traits\OrOnConflict;
use MichaelRushton\SQL\Traits\Output;
use MichaelRushton\SQL\Traits\Returning;
use MichaelRushton\SQL\Traits\Set;
use MichaelRushton\SQL\Traits\Table;
use MichaelRushton\SQL\Traits\Top;
use MichaelRushton\SQL\Traits\Where;
use MichaelRushton\SQL\Traits\WhereCurrentOf;
use MichaelRushton\SQL\Traits\With;

abstract class Update extends Statement
{
  use From;
  use Ignore;
  use Join;
  use Limit;
  use LowPriority;
  use OrderBy;
  use OrOnConflict;
  use Output;
  use Returning;
  use Set;
  use Table;
  use Top;
  use Where;
  use WhereCurrentOf;
  use With;
}