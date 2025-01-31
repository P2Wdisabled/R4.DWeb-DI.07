<?php

namespace App\Entity;

class Lego
{
    private int $id;
    private string $name; // Utilisation de noms en anglais pour correspondre au template
    private string $collection;
    private string $description;
    private float $price;
    private int $pieces;
    private string $boxImage;
    private string $legoImage;

    public function __construct(int $id, string $name, string $collection)
    {
        $this->id = $id;
        $this->name = $name;
        $this->collection = $collection;
    }

    // Getters et Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getCollection(): string
    {
        return $this->collection;
    }

    public function setCollection(string $collection): self
    {
        $this->collection = $collection;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getPieces(): int
    {
        return $this->pieces;
    }

    public function setPieces(int $pieces): self
    {
        $this->pieces = $pieces;
        return $this;
    }

    public function getBoxImage(): string
    {
        return $this->boxImage;
    }

    public function setBoxImage(string $boxImage): self
    {
        $this->boxImage = $boxImage;
        return $this;
    }

    public function getLegoImage(): string
    {
        return $this->legoImage;
    }

    public function setLegoImage(string $legoImage): self
    {
        $this->legoImage = $legoImage;
        return $this;
    }
}
