<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'care_plans')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class Careplan
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    public int $id;

    #[ORM\Column(name: 'date', type: 'datetime', nullable: false)] //may not be null, (required)
    public DateTime $date;

    #[ORM\Column(name: 'editDate', type: 'datetime', nullable: false)]
    public DateTime $editDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $presentHealth; //dont neeed name,| allows it to be a null

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    protected string $assistiveDevices; //dont neeed name

    #[ORM\Column(type: 'text', nullable: true)]
    protected string $notes;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Careplan
     */
    public function setId(int $id): Careplan
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Careplan
     */
    public function setDate(DateTime $date): Careplan
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEditDate(): DateTime
    {
        return $this->editDate;
    }

    /**
     * @param DateTime $editDate
     * @return Careplan
     */
    public function setEditDate(DateTime $editDate): Careplan
    {
        $this->editDate = $editDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPresentHealth(): ?string
    {
        return $this->presentHealth;
    }

    /**
     * @param string|null $presentHealth
     * @return Careplan
     */
    public function setPresentHealth(?string $presentHealth): Careplan
    {
        $this->presentHealth = $presentHealth;
        return $this;
    }

    /**
     * @return string
     */
    public function getAssistiveDevices(): string
    {
        return $this->assistiveDevices;
    }

    /**
     * @param string $assistiveDevices
     * @return Careplan
     */
    public function setAssistiveDevices(string $assistiveDevices): Careplan
    {
        $this->assistiveDevices = $assistiveDevices;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return Careplan
     */
    public function setNotes(string $notes): Careplan
    {
        $this->notes = $notes;
        return $this;
    }

}