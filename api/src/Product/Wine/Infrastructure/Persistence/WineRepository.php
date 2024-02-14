<?php

namespace App\Product\Wine\Infrastructure\Persistence;

use App\Product\Wine\Domain\WineInterface;
use App\Product\Wine\Domain\WineRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class WineRepository implements WineRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {
    }

    public function findById(int $id): ?WineInterface
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @return EntityRepository<WineInterface>
     */
    private function getRepository(): EntityRepository
    {
        return $this->em->getRepository(WineInterface::class);
    }


}
