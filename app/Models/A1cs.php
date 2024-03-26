<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'a1cs')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class A1cs
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected mixed $a1cDate;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 2, nullable: false)]
    protected float $a1cValue;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $a1cNotes;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserID(): int
    {
        return $this->userID;
    }

    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
    }

    public function getA1cDate(): mixed
    {
        return $this->a1cDate;
    }

    public function setA1cDate(mixed $a1cDate): void
    {
        $this->a1cDate = $a1cDate;
    }

    public function getA1cValue(): float
    {
        return $this->a1cValue;
    }

    public function setA1cValue(float $a1cValue): void
    {
        $this->a1cValue = $a1cValue;
    }

    public function getA1cNotes(): ?string
    {
        return $this->a1cNotes;
    }

    public function setA1cNotes(?string $a1cNotes): void
    {
        $this->a1cNotes = $a1cNotes;
    }





}