<?php

namespace App\Product\Domain;

use DateTimeInterface;

class Wine
{
    private string $name;
    private string $description;
    private DateTimeInterface $createdAt;
    private DateTimeInterface $updatedAt;
    private bool $isActive;
}
