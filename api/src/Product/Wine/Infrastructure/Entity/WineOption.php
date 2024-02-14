<?php

namespace App\Product\Wine\Infrastructure\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Product\Wine\Domain\WineOptionInterface;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wine_option')]
#[ApiResource]
class WineOption implements WineOptionInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;
    #[ORM\ManyToOne(targetEntity: WineEntity::class, inversedBy: 'wineOptions')]
    #[ORM\JoinColumn(nullable: false)]
    private WineEntity $wine;
    #[ORM\Column(type: 'text')]
    private string $description;
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $alcohol = null;
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isActive;
    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $createdAt;
    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getWine(): ?WineEntity
    {
        return $this->wine;
    }

    public function setWine(?WineEntity $wine): self
    {
        $this->wine = $wine;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getAlcohol(): ?float
    {
        return $this->alcohol;
    }

    public function setAlcohol(?float $alcohol): void
    {
        $this->alcohol = $alcohol;
    }


    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
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
