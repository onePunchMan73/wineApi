<?php

namespace App\Product\Wine\Infrastructure\Entity;
use ApiPlatform\Metadata\ApiResource;
use App\Product\Wine\Domain\WineClassificationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class WineClassificationEntity implements WineClassificationInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\OneToMany(mappedBy: 'classification', targetEntity: WineAppellationEntity::class)]
    private Collection $wineAppellations;

    // Constructor
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->wineAppellations = new ArrayCollection();
    }

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

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getWineAppellations(): Collection
    {
        return $this->wineAppellations;
    }

    public function setWineAppellations(Collection $wineAppellations): void
    {
        $this->wineAppellations = $wineAppellations;
    }

}
