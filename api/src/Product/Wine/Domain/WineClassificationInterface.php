<?php

namespace App\Product\Wine\Domain;

use Doctrine\Common\Collections\Collection;

interface WineClassificationInterface
{
    public function getId(): int;
    public function setId(int $id): void;
    public function getName(): string;
    public function setName(string $name): void;
    public function getCreatedAt(): \DateTimeInterface;
    public function setCreatedAt(\DateTimeInterface $createdAt): void;
    public function getWineAppellations(): Collection;
    public function setWineAppellations(Collection $wineAppellations): void;
}
