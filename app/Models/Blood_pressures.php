<?php

namespace App\Models;

    use DateTime;
    use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'blood_pressures')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Blood_pressures
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected mixed $bloodPressureDate;

    /**
     * Systolic blood pressure reading.
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    protected int|null $systolicPressure;

    /**
     * Diastolic blood pressure reading.
     */
    #[ORM\Column(type: 'integer', nullable: true)]
    protected int|null $diastolicPressure;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $position;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $armUsed;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $deviceUsed;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $bloodPressureNotes;


    /**
     * Getters and setters
     */

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

    public function getBloodPressureDate(): mixed
    {
        return $this->bloodPressureDate;
    }

    public function setBloodPressureDate(mixed $bloodPressureDate): void
    {
        $this->bloodPressureDate = $bloodPressureDate;
    }


    public function getSystolicPressure(): ?int
    {
        return $this->systolicPressure;
    }

    public function setSystolicPressure(?int $systolicPressure): void
    {
        $this->systolicPressure = $systolicPressure;
    }

    public function getDiastolicPressure(): ?int
    {
        return $this->diastolicPressure;
    }

    public function setDiastolicPressure(?int $diastolicPressure): void
    {
        $this->diastolicPressure = $diastolicPressure;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    public function getArmUsed(): ?string
    {
        return $this->armUsed;
    }

    public function setArmUsed(?string $armUsed): void
    {
        $this->armUsed = $armUsed;
    }

    public function getDeviceUsed(): ?string
    {
        return $this->deviceUsed;
    }

    public function setDeviceUsed(?string $deviceUsed): void
    {
        $this->deviceUsed = $deviceUsed;
    }

    public function getBloodPressureNotes(): ?string
    {
        return $this->bloodPressureNotes;
    }

    public function setBloodPressureNotes(?string $bloodPressureNotes): void
    {
        $this->bloodPressureNotes = $bloodPressureNotes;
    }

}