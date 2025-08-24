<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait Lateral
{
    protected string $lateral = "";

    public function lateral(): static
    {

        $this->lateral = "LATERAL";

        return $this;

    }

}
