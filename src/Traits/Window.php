<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Components\Window as ComponentsWindow;
use MichaelRushton\SQL\Interfaces\Traits\HasBindings;

trait Window
{
    protected array $window = [];

    public function window(
        string $name,
        ?Closure $callback = null,
    ): static {

        $this->window[] = $window = new ComponentsWindow($name);

        if ($callback) {
            $callback->call($window, $window);
        }

        return $this;

    }

    protected function getWindow(): string
    {

        if (empty($this->window)) {
            return "";
        }

        $window = implode(", ", $this->window);

        foreach ($this->window as $w) {

            if ($w instanceof HasBindings) {
                $this->mergeBindings($w);
            }

        }

        return "WINDOW $window";

    }

}
