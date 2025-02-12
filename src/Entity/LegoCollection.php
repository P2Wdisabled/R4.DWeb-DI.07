<?php

namespace App\Entity;

use App\Repository\LegoCollectionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: LegoCollectionRepository::class)]
class LegoCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'collection', targetEntity: Lego::class)]
    private Collection $legos;

    public function __construct()
    {
        $this->legos = new ArrayCollection();
    }

    public function getLegos(): Collection
    {
        return $this->legos;
    }

    public function addLego(Lego $lego): self
    {
        if (!$this->legos->contains($lego)) {
            $this->legos->add($lego);
            $lego->setCollection($this);
        }

        return $this;
    }

    public function removeLego(Lego $lego): self
    {
        if ($this->legos->removeElement($lego)) {
            // set the owning side to null (unless already changed)
            if ($lego->getCollection() === $this) {
                $lego->setCollection(null);
            }
        }

        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
