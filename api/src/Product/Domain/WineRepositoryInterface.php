<?php

namespace App\Product\Domain;

interface WineRepositoryInterface
{
    public function findById(int $id): ?Wine;
}
