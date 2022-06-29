<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnnoncesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AnnoncesRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read_annonces']], denormalizationContext: ['groups' => ['write_annonces']])]
class Annonces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read_annonces', "write_annonces"])]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Groups(['read_annonces', "write_annonces"])]
    private $StartDate;

    #[ORM\Column(type: 'date')]
    #[Groups(['read_annonces', "write_annonces"])]
    private $EndDate;

    #[ORM\Column(type: 'text')]
    #[Groups(['read_annonces', "write_annonces"])]
    private $Description;

    // #[ORM\ManyToOne(targetEntity: AnnonceType::class, inversedBy: 'libellé')]
    // #[ORM\JoinColumn(nullable: false)]
    // #[Groups(['read_annonces', "write_annonces"])]

    // private $type;

    // #[ORM\ManyToOne(targetEntity: EtatAnnonce::class, inversedBy: 'etat')]
    // #[ORM\JoinColumn(nullable: false)]
    // #[Groups(['read_annonces', "write_annonces"])]
    // private $etat;

    // #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'User')]
    // #[ORM\JoinColumn(nullable: false)]
    // #[Groups(['read_annonces', "write_annonces"])]
    // private $User;

    // #[ORM\ManyToOne(targetEntity: Animal::class, inversedBy: 'Animal')]
    // #[Groups(['read_annonces', "write_annonces"])]
    // private $Animal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTimeInterface $StartDate): self
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->EndDate;
    }

    public function setEndDate(\DateTimeInterface $EndDate): self
    {
        $this->EndDate = $EndDate;

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

    // public function getType(): ?AnnonceType
    // {
    //     return $this->type;
    // }

    // public function setType(?AnnonceType $type): self
    // {
    //     $this->type = $type;

    //     return $this;
    // }

    // public function getEtat(): ?EtatAnnonce
    // {
    //     return $this->etat;
    // }

    // public function setEtat(?EtatAnnonce $etat): self
    // {
    //     $this->etat = $etat;

    //     return $this;
    // }

    // public function getUser(): ?User
    // {
    //     return $this->User;
    // }

    // public function setUser(?User $User): self
    // {
    //     $this->User = $User;

    //     return $this;
    // }

    // public function getAnimal(): ?Animal
    // {
    //     return $this->Animal;
    // }

    // public function setAnimal(?Animal $Animal): self
    // {
    //     $this->Animal = $Animal;

    //     return $this;
    // }
}
