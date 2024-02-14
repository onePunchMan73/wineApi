<?php

namespace App\Product\Wine\Infrastructure\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Product\Wine\Domain\Wine;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'wine')]
#[ApiResource]
class WineEntity extends Wine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;
    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;
    #[ORM\Column(type: 'text', nullable: false)]
    private string $description;
    #[ORM\Column(type: 'datetime', nullable: false)]
    private DateTimeInterface $createdAt;
    #[ORM\Column(type: 'datetime', nullable: false)]
    private DateTimeInterface $updatedAt;
    #[ORM\OneToMany(mappedBy: 'wine', targetEntity: WineOption::class, cascade: ['persist'])]
    private Collection $wineOptions;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }




}
