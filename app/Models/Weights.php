<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'weights')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class Weights
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(name: 'date', type: 'date', nullable: false)]
    protected mixed $weightDate;

    #[ORM\Column(type: 'decimal', precision: 4, scale: 1, nullable: false)]
    protected float $weightValue;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $weightNotes;

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

    public function getWeightDate(): mixed
    {
        return $this->weightDate;
    }
    /**
     * @param mixed $weightDate
     */
    public function setWeightDate(mixed $weightDate): void
    {
        $this->weightDate = $weightDate;
    }

    /**
     * @return mixed
     */
    public function getWeightValue(): float
    {
        return $this->weightValue;
    }

    public function setWeightValue(float $weightValue): void
    {
        $this->weightValue = $weightValue;
    }

    public function getWeightNotes(): ?string
    {
        return $this->weightNotes;
    }

    public function setWeightNotes(?string $weightNotes): void
    {
        $this->weightNotes = $weightNotes;
    }





}





