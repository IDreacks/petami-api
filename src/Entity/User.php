<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 100)]
    private $Lastname;

    #[ORM\Column(type: 'string', length: 100)]
    private $Firstname;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $Postal_code;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $City;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $Street;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $Age;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Picture;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Annonces::class)]
    private $User;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: ImageMaison::class, orphanRemoval: true)]
    private $house_pics;

    public function __construct()
    {
        $this->User = new ArrayCollection();
        $this->house_pics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->Postal_code;
    }

    public function setPostalCode(?int $Postal_code): self
    {
        $this->Postal_code = $Postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(?string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->Street;
    }

    public function setStreet(?string $Street): self
    {
        $this->Street = $Street;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(?int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Annonces>
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(Annonces $user): self
    {
        if (!$this->User->contains($user)) {
            $this->User[] = $user;
            $user->setUser($this);
        }

        return $this;
    }

    public function removeUser(Annonces $user): self
    {
        if ($this->User->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getUser() === $this) {
                $user->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ImageMaison>
     */
    public function getHousePics(): Collection
    {
        return $this->house_pics;
    }

    public function addHousePic(ImageMaison $housePic): self
    {
        if (!$this->house_pics->contains($housePic)) {
            $this->house_pics[] = $housePic;
            $housePic->setUser($this);
        }

        return $this;
    }

    public function removeHousePic(ImageMaison $housePic): self
    {
        if ($this->house_pics->removeElement($housePic)) {
            // set the owning side to null (unless already changed)
            if ($housePic->getUser() === $this) {
                $housePic->setUser(null);
            }
        }

        return $this;
    }
}
