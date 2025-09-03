<?php

namespace JaOcero\RadioDeck\Traits;

use Closure;

trait HasGap
{
    protected string|Closure|null $gap = null;

    public function cardGap(string|Closure|null $gap): static
    {
        $this->gap = $gap;

        return $this;
    }
    
    // Override Filament's gap method to maintain compatibility
    public function gap(Closure|string|bool|null $gap = true): static
    {
        if (is_string($gap) || is_null($gap) || $gap instanceof Closure) {
            $this->gap = $gap;
        }
        
        return $this;
    }

    public function getGap(): ?string
    {
        return $this->evaluate($this->gap);
    }
}
