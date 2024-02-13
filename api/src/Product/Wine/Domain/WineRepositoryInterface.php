<?php

namespace App\Product\Wine\Domain;

interface WineRepositoryInterface
{
    public function findById(int $id): ?Wine;
}
