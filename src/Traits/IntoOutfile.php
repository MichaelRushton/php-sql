<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Components\Outfile;
use Stringable;

trait IntoOutfile
{
    protected string|Stringable $into_outfile = "";

    public function intoOutfile(
        string $path,
        ?Closure $callback = null
    ): static {

        $this->into_outfile = $outfile = new Outfile($path);

        if ($callback) {
            $callback->call($outfile, $outfile);
        }

        return $this;

    }

    protected function getIntoOutfile(): string
    {

        if ("" === $this->into_outfile) {
            return "";
        }

        return "INTO OUTFILE $this->into_outfile";

    }

}
