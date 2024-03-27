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

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $borrowAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $expectedReturnDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $actualReturnDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    private ?Employee $manage = null;

    #[ORM\ManyToOne(inversedBy: 'borrows')]
    private ?Employee $borrow = null;

    #[ORM\ManyToOne(inversedBy: 'relatedTo')]
    private ?Material $relateTo = null;

    #[ORM\ManyToOne(targetEntity: TrainingProgram::class)]
    private ?TrainingProgram $trainingProgram = null;

    #[ORM\ManyToOne(targetEntity: Student::class)]
    private ?Student $student = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowAt(): ?\DateTimeInterface
    {
        return $this->borrowAt;
    }

    public function setBorrowAt(?\DateTimeInterface $borrowAt): static
    {
        $this->borrowAt = $borrowAt;

        return $this;
    }

    public function getExpectedReturnDate(): ?\DateTimeInterface
    {
        return $this->expectedReturnDate;
    }

    public function setExpectedReturnDate(?\DateTimeInterface $expected_return_date): static
    {
        $this->expectedReturnDate = $expected_return_date;

        return $this;
    }

    public function getActualReturnDate(): ?\DateTimeInterface
    {
        return $this->actualReturnDate;
    }

    public function setActualReturnDate(?\DateTimeInterface $actual_return_date): static
    {
        $this->actualReturnDate = $actual_return_date;

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

    public function setManage(?Employee $manage): self
    {
        $this->manage = $manage;

        return $this;
    }

    public function getBorrow(): ?Employee
    {
        return $this->borrow;
    }

    public function setBorrow(?Employee $borrow): self
    {
        $this->borrow = $borrow;

        return $this;
    }

    public function getRelateTo(): ?Material
    {
        return $this->relateTo;
    }

    public function setRelateTo(?Material $relateTo): self
    {
        $this->relateTo = $relateTo;

        return $this;
    }

    public function getTrainingProgram(): ?TrainingProgram
    {
        return $this->trainingProgram;
    }

    public function setTrainingProgram(?TrainingProgram $trainingProgram): self
    {
        $this->trainingProgram = $trainingProgram;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}