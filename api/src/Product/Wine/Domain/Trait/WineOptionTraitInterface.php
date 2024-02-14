<?php

namespace App\Product\Wine\Domain\Trait;

use App\Product\Wine\Infrastructure\Entity\WineOption;
use Doctrine\Common\Collections\Collection;

interface WineOptionTraitInterface
{
    public function addWineOption(WineOption $wineOption): self;
    public function removeWineOption(WineOption $wineOption): self;
    public function getWineOptions(): Collection;
}
