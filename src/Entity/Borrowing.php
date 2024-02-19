<?php

namespace App\Entity;

use App\Repository\BorrowingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowingRepository::class)]
class Borrowing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $borrow_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $expected_return_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $actual_return_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    private ?Employee $manage = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    private ?Student $make = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    private ?Material $relate_to = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    private ?TrainingProgram $concern = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowAt(): ?\DateTimeImmutable
    {
        return $this->borrow_at;
    }

    public function setBorrowAt(?\DateTimeImmutable $borrow_at): static
    {
        $this->borrow_at = $borrow_at;

        return $this;
    }

    public function getExpectedReturnDate(): ?\DateTimeInterface
    {
        return $this->expected_return_date;
    }

    public function setExpectedReturnDate(?\DateTimeInterface $expected_return_date): static
    {
        $this->expected_return_date = $expected_return_date;

        return $this;
    }

    public function getActualReturnDate(): ?\DateTimeInterface
    {
        return $this->actual_return_date;
    }

    public function setActualReturnDate(?\DateTimeInterface $actual_return_date): static
    {
        $this->actual_return_date = $actual_return_date;

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

    public function getManage(): ?Employee
    {
        return $this->manage;
    }

    public function setManage(?Employee $manage): static
    {
        $this->manage = $manage;

        return $this;
    }

    public function getMake(): ?Student
    {
        return $this->make;
    }

    public function setMake(?Student $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function getRelateTo(): ?Material
    {
        return $this->relate_to;
    }

    public function setRelateTo(?Material $relate_to): static
    {
        $this->relate_to = $relate_to;

        return $this;
    }

    public function getConcern(): ?TrainingProgram
    {
        return $this->concern;
    }

    public function setConcern(?TrainingProgram $concern): static
    {
        $this->concern = $concern;

        return $this;
    }
}
