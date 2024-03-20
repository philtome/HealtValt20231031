<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'creatinines')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Creatinines
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected mixed $creatinineDate;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 2, nullable: false)]
    protected float $creatinineValue;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $creatinineNotes;

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

    public function getCreatinineDate(): mixed
    {
        return $this->creatinineDate;
    }

    public function setCreatinineDate(mixed $creatinineDate): void
    {
        $this->creatinineDate = $creatinineDate;
    }

    public function getCreatinineValue(): float
    {
        return $this->creatinineValue;
    }

    public function setCreatinineValue(float $creatinineValue): void
    {
        $this->creatinineValue = $creatinineValue;
    }

    public function getCreatinineNotes(): ?string
    {
        return $this->creatinineNotes;
    }

    public function setCreatinineNotes(?string $creatinineNotes): void
    {
        $this->creatinineNotes = $creatinineNotes;
    }

}