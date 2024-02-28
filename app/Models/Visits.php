<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'visits')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Visits
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected $date;

    #[ORM\Column(type: 'string', length: 255,nullable: true)]
    protected  string|null $typeVisit; //with & notes

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected string|null $withWho; //dont neeed name

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $notes; //dont neeed name

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getTypeVisit(): ?string
    {
        return $this->typeVisit;
    }

    public function setTypeVisit(?string $typeVisit): void
    {
        $this->typeVisit = $typeVisit;
    }

    public function getWithWho(): ?string
    {
        return $this->withWho;
    }

    public function setWithWho(?string $withWho): void
    {
        $this->withWho = $withWho;
    }

    /**
     * @return string|null
     */
    public function getWith(): ?string
    {
        return $this->with;
    }

    /**
     * @param string|null $with
     */
    public function setWith(?string $with): void
    {
        $this->with = $with;
    }

    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param string|null $notes
     */
    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    public function getUserID(): int
    {
        return $this->userID;
    }

    public function setUserID(int $userID): void
    {
        $this->userID = $userID;
    }


}


