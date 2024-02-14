<?php

namespace App\Product\Wine\Domain;

use App\Product\Wine\Domain\Trait\WineOptionTraitInterface;
use DateTimeInterface;

interface WineInterface extends WineOptionTraitInterface
{
    public function getId(): int;
    public function setId(int $id): void;
    public function getName(): string;
    public function setName(string $name): void;
    public function getDescription(): string;
    public function setDescription(string $description): void;
    public function getCreatedAt(): DateTimeInterface;
    public function setCreatedAt(DateTimeInterface $createdAt): void;
    public function getUpdatedAt(): DateTimeInterface;
    public function setUpdatedAt(DateTimeInterface $updatedAt): void;
}
