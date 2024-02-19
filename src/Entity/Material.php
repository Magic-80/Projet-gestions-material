<?php

namespace App\Entity;

use App\DataFixtures\MaterialTypeFixtures;
use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serialNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $tagNumber = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\OneToMany(targetEntity: Borrowing::class, mappedBy: 'relateTo')]
    private Collection $relatedTo;

    #[ORM\ManyToOne(targetEntity: MaterialType::class)]
    private ?MaterialType $materialType = null;


    public function __construct()
    {
        $this->relatedTo = new ArrayCollection();
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

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(?string $serial): static
    {
        $this->serialNumber = $serial;

        return $this;
    }

    public function getTagNumber(): ?string
    {
        return $this->tagNumber;
    }

    public function setTagNumber(string $tag): static
    {
        $this->tagNumber = $tag;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, Borrowing>
     */
    public function getRelatedTo(): Collection
    {
        return $this->relatedTo;
    }

    public function addRelatedTo(Borrowing $relatedTo): self
    {
        if (!$this->relatedTo->contains($relatedTo)) {
            $this->relatedTo[] = $relatedTo;
            $relatedTo->setRelateTo($this);
        }

        return $this;
    }

    public function getMaterialType(): ?MaterialType
    {
        return $this->materialType;
    }

    public function setMaterialType(?MaterialType $materialType): self
    {
        $this->materialType = $materialType;

        return $this;
    }
    
}
