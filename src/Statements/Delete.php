<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\From;
use MichaelRushton\SQL\Traits\History;
use MichaelRushton\SQL\Traits\Ignore;
use MichaelRushton\SQL\Traits\Join;
use MichaelRushton\SQL\Traits\Limit;
use MichaelRushton\SQL\Traits\LowPriority;
use MichaelRushton\SQL\Traits\OrderBy;
use MichaelRushton\SQL\Traits\Output;
use MichaelRushton\SQL\Traits\Quick;
use MichaelRushton\SQL\Traits\Returning;
use MichaelRushton\SQL\Traits\Table;
use MichaelRushton\SQL\Traits\Top;
use MichaelRushton\SQL\Traits\Using;
use MichaelRushton\SQL\Traits\Where;
use MichaelRushton\SQL\Traits\WhereCurrentOf;
use MichaelRushton\SQL\Traits\With;

abstract class Delete extends Statement
{
  use From;
  use History;
  use Ignore;
  use Join;
  use Limit;
  use LowPriority;
  use OrderBy;
  use Output;
  use Quick;
  use Returning;
  use Table;
  use Top;
  use Using;
  use Where;
  use WhereCurrentOf;
  use With;
}