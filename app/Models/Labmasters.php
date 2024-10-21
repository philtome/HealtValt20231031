<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'labmasters')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Labmasters
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsName;

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsSubtype;

    #[ORM\Column(type:'datetime', nullable: false)]
    protected mixed $labsDate;

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsValueType;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    protected float $labsLowValue;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    protected float $labsHighValue;

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsUnits;



    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsValue2Type;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    protected float $labsLowValue2;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    protected float $labsHighValue2;

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsUnits2;



    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $labsNotes;

    #[ORM\Column(type:'datetime', nullable: false)]
    protected mixed $labsCreateDate;

    #[ORM\Column(type:'datetime', nullable: true)]
    protected mixed $labsModifiedDate;

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

    public function getLabsName(): string
    {
        return $this->labsName;
    }

    public function setLabsName(string $labsName): void
    {
        $this->labsName = $labsName;
    }

    public function getLabsSubtype(): string
    {
        return $this->labsSubtype;
    }

    public function setLabsSubtype(string $labsSubtype): void
    {
        $this->labsSubtype = $labsSubtype;
    }

    public function getLabsDate(): mixed
    {
        return $this->labsDate;
    }

    public function setLabsDate(mixed $labsDate): void
    {
        $this->labsDate = $labsDate;
    }

    public function getLabsValueType(): string
    {
        return $this->labsValueType;
    }

    public function setLabsValueType(string $labsValueType): void
    {
        $this->labsValueType = $labsValueType;
    }

    public function getLabsLowValue(): float
    {
        return $this->labsLowValue;
    }

    public function setLabsLowValue(float $labsLowValue): void
    {
        $this->labsLowValue = $labsLowValue;
    }

    public function getLabsHighValue(): float
    {
        return $this->labsHighValue;
    }

    public function setLabsHighValue(float $labsHighValue): void
    {
        $this->labsHighValue = $labsHighValue;
    }

    public function getLabsUnits(): string
    {
        return $this->labsUnits;
    }

    public function setLabsUnits(string $labsUnits): void
    {
        $this->labsUnits = $labsUnits;
    }

    public function getLabsValue2Type(): string
    {
        return $this->labsValue2Type;
    }

    public function setLabsValue2Type(string $labsValue2Type): void
    {
        $this->labsValue2Type = $labsValue2Type;
    }

    public function getLabsLowValue2(): float
    {
        return $this->labsLowValue2;
    }

    public function setLabsLowValue2(float $labsLowValue2): void
    {
        $this->labsLowValue2 = $labsLowValue2;
    }

    public function getLabsHighValue2(): float
    {
        return $this->labsHighValue2;
    }

    public function setLabsHighValue2(float $labsHighValue2): void
    {
        $this->labsHighValue2 = $labsHighValue2;
    }

    public function getLabsUnits2(): string
    {
        return $this->labsUnits2;
    }

    public function setLabsUnits2(string $labsUnits2): void
    {
        $this->labsUnits2 = $labsUnits2;
    }

    public function getLabsNotes(): ?string
    {
        return $this->labsNotes;
    }

    public function setLabsNotes(?string $labsNotes): void
    {
        $this->labsNotes = $labsNotes;
    }

    public function getLabsCreateDate(): mixed
    {
        return $this->labsCreateDate;
    }

    public function setLabsCreateDate(mixed $labsCreateDate): void
    {
        $this->labsCreateDate = $labsCreateDate;
    }

    public function getLabsModifiedDate(): mixed
    {
        return $this->labsModifiedDate;
    }

    public function setLabsModifiedDate(mixed $labsModifiedDate): void
    {
        $this->labsModifiedDate = $labsModifiedDate;
    }

}