<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'cholesterols')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Cholesterols
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(name: 'date', type: 'datetime', nullable: false)]
    protected mixed $cholesterolDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    protected float $cholesterolTotalValue;

    #[ORM\Column(type: 'integer', nullable: true)]
    protected float $cholesterolLdlValue;

    #[ORM\Column(type: 'integer', nullable: true)]
    protected float $cholesterolHdlValue;

    #[ORM\Column(type: 'integer', nullable: true)]
    protected float $triglyceridesTotalValue;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $cholesterolNotes;

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

    public function getCholesterolDate(): mixed
    {
        return $this->cholesterolDate;
    }

    public function setCholesterolDate(mixed $cholesterolDate): void
    {
        $this->cholesterolDate = $cholesterolDate;
    }

    public function getCholesterolTotalValue(): ?int
    {
        return $this->cholesterolTotalValue ?? null;
    }

    public function setCholesterolTotalValue(float $cholesterolTotalValue): void
    {
        $this->cholesterolTotalValue = $cholesterolTotalValue;
    }

    public function getCholesterolLdlValue(): ?int
    {
        return $this->cholesterolLdlValue ?? null;
    }

    public function setCholesterolLdlValue(float $cholesterolLdlValue): void
    {
        $this->cholesterolLdlValue = $cholesterolLdlValue;
    }

    public function getCholesterolHdlValue(): ?int
    {
        return $this->cholesterolHdlValue ?? null;
    }

    public function setCholesterolHdlValue(float $cholesterolHdlValue): void
    {
        $this->cholesterolHdlValue = $cholesterolHdlValue;
    }

    public function getTriglyceridesTotalValue(): ?int
    {
        return $this->triglyceridesTotalValue ?? null;
    }

    public function setTriglyceridesTotalValue(float $triglyceridesTotalValue): void
    {
        $this->triglyceridesTotalValue = $triglyceridesTotalValue;
    }

    public function getCholesterolNotes(): ?string
    {
        return $this->cholesterolNotes;
    }

    public function setCholesterolNotes(?string $cholesterolNotes): void
    {
        $this->cholesterolNotes = $cholesterolNotes;
    }





}
