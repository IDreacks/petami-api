<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnnonceTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceTypeRepository::class)]
#[ApiResource]
class AnnonceType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $label;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Annonces::class)]
    private $libellé;

    public function __construct()
    {
        $this->libellé = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Annonces>
     */
    public function getLibellé(): Collection
    {
        return $this->libellé;
    }

    public function addLibell(Annonces $libell): self
    {
        if (!$this->libellé->contains($libell)) {
            $this->libellé[] = $libell;
            $libell->setType($this);
        }

        return $this;
    }

    public function removeLibell(Annonces $libell): self
    {
        if ($this->libellé->removeElement($libell)) {
            // set the owning side to null (unless already changed)
            if ($libell->getType() === $this) {
                $libell->setType(null);
            }
        }

        return $this;
    }
}
