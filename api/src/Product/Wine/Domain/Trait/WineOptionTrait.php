<?php

namespace App\Product\Wine\Domain\Trait;

use App\Product\Wine\Infrastructure\Entity\WineOption;
use Doctrine\Common\Collections\Collection;

trait WineOptionTrait
{
    private Collection $wineOptions;
    public function addWineOption(WineOption $wineOption): self
    {
        if (!$this->wineOptions->contains($wineOption)) {
            $this->wineOptions[] = $wineOption;
            $wineOption->setWine($this);
        }

        return $this;
    }

    public function removeWineOption(WineOption $wineOption): self
    {
        if ($this->wineOptions->removeElement($wineOption)) {
            if ($wineOption->getWine() === $this) {
                $wineOption->setWine(null);
            }
        }

        return $this;
    }

    public function getWineOptions(): Collection
    {
        return $this->wineOptions;
    }
}
