<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'medications')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Medications
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(name: 'dateStarted', type:'datetime', nullable: false)]
    protected $dateStarted;

    #[ORM\Column(name: 'dateStopped', type:'datetime', nullable: true)]
    protected $dateStopped;

    #[ORM\Column(type: 'string', length: 255,nullable: false)]
    protected  string|null $medicationName; //with & notes

    #[ORM\Column(type: 'string', length: 255,nullable: true)]
    protected  string|null $strength;

    #[ORM\Column(type: 'string', length: 255,nullable: true)]
    protected  string|null $dose;

    #[ORM\Column(type: 'string', length: 255,nullable: true)]
    protected  string|null $howTaken;

    #[ORM\Column(type: 'string', length: 255,nullable: true)]
    protected  string|null $howOften;

    #[ORM\Column(type: 'string', length: 255,nullable: true)]
    protected  string|null $reason;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $notes;

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

    /**
     * @return mixed
     */
    public function getDateStarted()
    {
        return $this->dateStarted;
    }

    /**
     * @param mixed $dateStarted
     */
    public function setDateStarted($dateStarted): void
    {
        $this->dateStarted = $dateStarted;
    }

    /**
     * @return mixed
     */
    public function getDateStopped()
    {
        return $this->dateStopped;
    }

    /**
     * @param mixed $dateStopped
     */
    public function setDateStopped($dateStopped): void
    {
        $this->dateStopped = $dateStopped;
    }

    public function getMedicationName(): ?string
    {
        return $this->medicationName;
    }

    public function setMedicationName(?string $medicationName): void
    {
        $this->medicationName = $medicationName;
    }

    public function getStrength(): ?string
    {
        return $this->strength;
    }

    public function setStrength(?string $strength): void
    {
        $this->strength = $strength;
    }

    public function getDose(): ?string
    {
        return $this->dose;
    }

    public function setDose(?string $dose): void
    {
        $this->dose = $dose;
    }

    public function getHowTaken(): ?string
    {
        return $this->howTaken;
    }

    public function setHowTaken(?string $howTaken): void
    {
        $this->howTaken = $howTaken;
    }

    public function getHowOften(): ?string
    {
        return $this->howOften;
    }

    public function setHowOften(?string $howOften): void
    {
        $this->howOften = $howOften;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    } //dont neeed name


}


