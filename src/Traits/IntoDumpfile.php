<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\SQL;

trait IntoDumpfile
{
    protected string $into_dumpfile = "";

    public function intoDumpfile(string $path): static
    {

        $path = SQL::escape($path);

        $this->into_dumpfile = "INTO DUMPFILE '$path'";

        return $this;

    }

}
