<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ApiResource]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $Name;

    #[ORM\Column(type: 'integer')]
    private $Age;

    #[ORM\Column(type: 'text')]
    private $Description;

    // #[ORM\Column(type: 'string', length: 255)]
    // private $Photo;

    // #[ORM\Column(type: 'string', length: 100)]
    // private $Type;

    // #[ORM\OneToMany(mappedBy: 'Animal', targetEntity: Annonces::class)]
    // private $Animal;

    public function __construct()
    {
        $this->Animal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    // public function getPhoto(): ?string
    // {
    //     return $this->Photo;
    // }

    // public function setPhoto(string $Photo): self
    // {
    //     $this->Photo = $Photo;

    //     return $this;
    // }

    // public function getType(): ?string
    // {
    //     return $this->Type;
    // }

    // public function setType(string $Type): self
    // {
    //     $this->Type = $Type;

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, Annonces>
    //  */
    // public function getAnimal(): Collection
    // {
    //     return $this->Animal;
    // }

    // public function addAnimal(Annonces $animal): self
    // {
    //     if (!$this->Animal->contains($animal)) {
    //         $this->Animal[] = $animal;
    //         $animal->setAnimal($this);
    //     }

    //     return $this;
    // }

    // public function removeAnimal(Annonces $animal): self
    // {
    //     if ($this->Animal->removeElement($animal)) {
    //         // set the owning side to null (unless already changed)
    //         if ($animal->getAnimal() === $this) {
    //             $animal->setAnimal(null);
    //         }
    //     }

    //     return $this;
    // }
}
