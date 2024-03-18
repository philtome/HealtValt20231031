<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'procedures')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Procedures
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(name: 'procedureDate', type: 'date', nullable: false)]
    protected $procedureDate;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    protected string|null $procedureType; //with & notes

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $procedurePhysician;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $procedureFacility;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $procedureDescription;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $procedureResults;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $procedureInstructions; // followup or discharge instructions

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $notes;


    // GETTERS AND SETTERS:

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
    public function getProcedureDate()
    {
        return $this->procedureDate;
    }

    /**
     * @param mixed $procedureDate
     */
    public function setProcedureDate($procedureDate): void
    {
        $this->procedureDate = $procedureDate;
    }

    public function getProcedureType(): ?string
    {
        return $this->procedureType;
    }

    public function setProcedureType(?string $procedureType): void
    {
        $this->procedureType = $procedureType;
    }

    public function getProcedurePhysician(): ?string
    {
        return $this->procedurePhysician;
    }

    public function setProcedurePhysician(?string $procedurePhysician): void
    {
        $this->procedurePhysician = $procedurePhysician;
    }

    public function getProcedureFacility(): ?string
    {
        return $this->procedureFacility;
    }

    public function setProcedureFacility(?string $procedureFacility): void
    {
        $this->procedureFacility = $procedureFacility;
    }

    public function getProcedureDescription(): ?string
    {
        return $this->procedureDescription;
    }

    public function setProcedureDescription(?string $procedureDescription): void
    {
        $this->procedureDescription = $procedureDescription;
    }

    public function getProcedureResults(): ?string
    {
        return $this->procedureResults;
    }

    public function setProcedureResults(?string $procedureResults): void
    {
        $this->procedureResults = $procedureResults;
    }

    public function getProcedureInstructions(): ?string
    {
        return $this->procedureInstructions;
    }

    public function setProcedureInstructions(?string $procedureInstructions): void
    {
        $this->procedureInstructions = $procedureInstructions;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }
}