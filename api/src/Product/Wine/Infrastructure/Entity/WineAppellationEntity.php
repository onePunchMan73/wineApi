<?php

namespace App\Product\Wine\Infrastructure\Entity;


use ApiPlatform\Metadata\ApiResource;
use App\Product\Wine\Domain\WineAppellationInterface;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class WineAppellationEntity implements WineAppellationInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $updatedAt;

    #[ORM\ManyToOne(targetEntity: WineClassificationEntity::class, fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: false)]
    private WineClassificationEntity $classification;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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

    public function getClassification(): WineClassificationEntity
    {
        return $this->classification;
    }

    public function setClassification(WineClassificationEntity $classification): void
    {
        $this->classification = $classification;
    }


}
