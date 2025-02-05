<?php

namespace App\Entity;

use App\Repository\LegoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LegoRepository::class)]
class Lego
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $collection = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\Column]
    private ?int $Pieces = null;

    #[ORM\Column(length: 255)]
    private ?string $BoxImage = null;

    #[ORM\Column(length: 255)]
    private ?string $LegoImage = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function __construct(int $id)
{
    $this->id = $id;
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function setCollection(string $Collection): static
    {
        $this->collection = $Collection;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getPieces(): ?int
    {
        return $this->Pieces;
    }

    public function setPieces(int $Pieces): static
    {
        $this->Pieces = $Pieces;

        return $this;
    }

    public function getBoxImage(): ?string
    {
        return $this->BoxImage;
    }

    public function setBoxImage(string $BoxImage): static
    {
        $this->BoxImage = $BoxImage;

        return $this;
    }

    public function getLegoImage(): ?string
    {
        return $this->LegoImage;
    }

    public function setLegoImage(string $LegoImage): static
    {
        $this->LegoImage = $LegoImage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
