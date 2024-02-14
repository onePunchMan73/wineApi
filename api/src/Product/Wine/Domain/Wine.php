<?php

namespace App\Product\Wine\Domain;

use App\Product\Wine\Domain\Trait\WineOptionTrait;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Wine implements WineInterface
{
    use WineOptionTrait;

    public function __construct()
    {
        $this->wineOptions = new ArrayCollection();
    }

}
