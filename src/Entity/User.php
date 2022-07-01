<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(normalizationContext: ['groups' => ['read_users']], denormalizationContext: ['groups' => ['write_users']])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(['read_users', "write_users", "read_annonces"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Groups(['read_users', "write_users"])]
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    #[Groups(['read_users', "write_users"])]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    #[Groups(['read_users', "write_users"])]
    private $password;

    #[Groups(['read_users', "write_users", "read_annonces"])]
    #[ORM\Column(type: 'string', length: 100)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(['read_users', "write_users", "read_annonces"])]
    private $firstname;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['read_users', "write_users", "read_annonces"])]
    private $Postal_code;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    #[Groups(['read_users', "write_users", "read_annonces"])]
    private $City;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['read_users', "write_users", "read_annonces"])]
    private $Street;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['read_users', "write_users", "read_annonces"])]
    private $Age;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $picture;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['read_users', "write_users"])]
    private $description;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Annonces::class)]
    private $User;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: ImageMaison::class, orphanRemoval: true)]
    private $house_pics;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Annonces::class, orphanRemoval: true)]
    private $annonces;

    public function __construct()
    {
        $this->User = new ArrayCollection();
        $this->house_pics = new ArrayCollection();
        $this->annonces = new ArrayCollection();
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
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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

    /**
     * @return Collection<int, Annonces>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonces $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setUser($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonces $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getUser() === $this) {
                $annonce->setUser(null);
            }
        }

        return $this;
    }
}
