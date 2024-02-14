<?php

namespace App\Product\Wine\Domain\Trait;

use App\Product\Wine\Infrastructure\Entity\WineAppellationEntity;

trait WineAppellationTrait
{
    private WineAppellationEntity $appellation;
    public function getAppellation(): WineAppellationEntity
    {
        return $this->appellation;
    }
    public function setAppellation(WineAppellationEntity $appellation): void
    {
        $this->appellation = $appellation;
    }
}
