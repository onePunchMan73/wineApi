<?php

namespace App\Product\Wine\Domain;

use DateTimeInterface;

interface WineOptionInterface
{
    public function getId(): int;
    public function setId(int $id): void;
    public function getDescription(): string;
    public function setDescription(string $description): void;
    public function getAlcohol(): ?float;
    public function setAlcohol(?float $alcohol): void;
    public function getCreatedAt(): DateTimeInterface;
    public function setCreatedAt(DateTimeInterface $createdAt): void;
    public function getUpdatedAt(): DateTimeInterface;
    public function setUpdatedAt(DateTimeInterface $updatedAt): void;
    public function isActive(): bool;
    public function setIsActive(bool $isActive): void;
}
