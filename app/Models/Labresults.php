<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'labresults')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Labresults
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\ManyToOne(targetEntity: 'Labmasters')]
    #[ORM\JoinColumn(name: 'labmasters_id', referencedColumnName: 'id', nullable: false)]
    public $labresultsName;

    #[ORM\Column(type:'datetime', nullable: false)]
    protected mixed $labresultsDate;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 2, nullable: false)]
    protected float $labresultsFloatValue;

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labresultsTextValue;

//    #[ORM\Column(type: 'text', nullable: false)]
//    protected string $labresultsUnits;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $labresultsNotes;

    #[ORM\Column(type:'datetime', nullable: false)]
    protected mixed $labresultsCreateDate;

    #[ORM\Column(type:'datetime', nullable: false)]
    protected mixed $labresultsModifiedDate;

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
    public function getLabresultsName()
    {
        return $this->labresultsName;
    }

    /**
     * @param mixed $labresultsName
     */
    public function setLabresultsName($labresultsName): void
    {
        $this->labresultsName = $labresultsName;
    }

    public function getLabresultsDate(): mixed
    {
        return $this->labresultsDate;
    }

    public function setLabresultsDate(mixed $labresultsDate): void
    {
        $this->labresultsDate = $labresultsDate;
    }

    public function getLabresultsFloatValue(): float
    {
        return $this->labresultsFloatValue;
    }

    public function setLabresultsFloatValue(float $labresultsFloatValue): void
    {
        $this->labresultsFloatValue = $labresultsFloatValue;
    }

    public function getLabresultsTextValue(): string
    {
        return $this->labresultsTextValue;
    }

    public function setLabresultsTextValue(string $labresultsTextValue): void
    {
        $this->labresultsTextValue = $labresultsTextValue;
    }

    public function getLabresultsNotes(): ?string
    {
        return $this->labresultsNotes;
    }

    public function setLabresultsNotes(?string $labresultsNotes): void
    {
        $this->labresultsNotes = $labresultsNotes;
    }

    public function getLabresultsCreateDate(): mixed
    {
        return $this->labresultsCreateDate;
    }

    public function setLabresultsCreateDate(mixed $labresultsCreateDate): void
    {
        $this->labresultsCreateDate = $labresultsCreateDate;
    }

    public function getLabresultsModifiedDate(): mixed
    {
        return $this->labresultsModifiedDate;
    }

    public function setLabresultsModifiedDate(mixed $labresultsModifiedDate): void
    {
        $this->labresultsModifiedDate = $labresultsModifiedDate;
    }



}