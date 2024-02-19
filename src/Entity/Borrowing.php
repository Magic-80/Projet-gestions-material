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
}
