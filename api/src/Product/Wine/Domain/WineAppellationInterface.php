<?php

namespace App\Product\Wine\Domain;

use App\Product\Wine\Infrastructure\Entity\WineClassificationEntity;
use DateTimeInterface;

interface WineAppellationInterface
{
    public function getId(): int;
    public function setId(int $id): void;
    public function getClassification(): WineClassificationEntity;
    public function setClassification(WineClassificationEntity $classification): void;
    public function getName(): string;
    public function setName(string $name): void;
    public function getCreatedAt(): DateTimeInterface;
    public function setCreatedAt(DateTimeInterface $createdAt): void;
    public function getUpdatedAt(): DateTimeInterface;
    public function setUpdatedAt(DateTimeInterface $updatedAt): void;
}
