<?php

namespace App\Product\Wine\Domain\Trait;

use App\Product\Wine\Infrastructure\Entity\WineAppellationEntity;

interface WineAppellationTraitInterface
{
    public function getAppellation(): WineAppellationEntity;
    public function setAppellation(WineAppellationEntity $appellation): void;
}
