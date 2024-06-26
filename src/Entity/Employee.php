<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $roles = null;

    #[ORM\Column]
    private ?bool $deactivate = false;

    #[ORM\OneToMany(targetEntity: Borrowing::class, mappedBy: 'manage')]
    private Collection $borrowings;

    #[ORM\OneToMany(targetEntity: Borrowing::class, mappedBy: 'borrow')]
    private Collection $borrows;

    public function __construct()
    {
        $this->borrowings = new ArrayCollection();
        $this->borrows = new ArrayCollection();
    }
    public function getUserIdentifier(): string
    {
        return $this->username;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }

    // Implémentez les autres méthodes de l'interface UserInterface
    public function getRoles(): array
    {
        return explode(',', $this->roles); // Convertir la chaîne de rôles en tableau
    }

    public function getSalt()
    {
        // Vous n'avez pas besoin de salt si vous utilisez bcrypt pour hacher les mots de passe
        return null;
    }

    public function eraseCredentials()
    {
        // Supprimez les informations sensibles stockées sur l'utilisateur
        // Cette méthode est requise par l'interface, mais dans votre cas, vous pouvez la laisser vide
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    // public function getPassword(): ?string
    // {
    //     return $this->password;
    // }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    // public function getRoles(): ?string
    // {
    //     return $this->roles;
    // }

    public function setRoles(string $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getDeactivate(): ?bool
    {
        return $this->deactivate;
    }


    public function setDeactivate(bool $deactivate)
    {
        $this->deactivate = $deactivate;

        return $this;
    }

    /**
     * @return Collection<int, Borrowing>
     */
    public function getBorrowings(): Collection
    {
        return $this->borrowings;
    }

    public function addBorrowing(Borrowing $borrowing): self
    {
        if (!$this->borrowings->contains($borrowing)) {
            $this->borrowings[] = $borrowing;
            $borrowing->setManage($this);
        }

        return $this;
    }

    public function getBorrows(): Collection
    {
        return $this->borrows;
    }

    public function addBorrow(Borrowing $borrow): self
    {
        if (!$this->borrows->contains($borrow)) {
            $this->borrows[] = $borrow;
            $borrow->setBorrow($this);
        }

        return $this;
    }
}