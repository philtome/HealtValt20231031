<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'sirolimuss')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class Sirolimuss {
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected mixed $sirolimusDate;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 2, nullable: false)]
    protected float $sirolimusValue;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $sirolimusNotes;

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

    public function getSirolimusDate(): mixed
    {
        return $this->sirolimusDate;
    }

    public function setSirolimusDate(mixed $sirolimusDate): void
    {
        $this->sirolimusDate = $sirolimusDate;
    }

    public function getSirolimusValue(): float
    {
        return $this->sirolimusValue;
    }

    public function setSirolimusValue(float $sirolimusValue): void
    {
        $this->sirolimusValue = $sirolimusValue;
    }

    public function getSirolimusNotes(): ?string
    {
        return $this->sirolimusNotes;
    }

    public function setSirolimusNotes(?string $sirolimusNotes): void
    {
        $this->sirolimusNotes = $sirolimusNotes;
    }



}


