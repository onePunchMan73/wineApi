<?php

namespace App\Product\Wine\Infrastructure\Persistence;

use App\Product\Wine\Domain\Wine;
use App\Product\Wine\Domain\WineRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class WineRepository implements WineRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {
    }

    public function findById(int $id): ?Wine
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @return EntityRepository<Wine>
     */
    private function getRepository(): EntityRepository
    {
        return $this->em->getRepository(Wine::class);
    }


}
