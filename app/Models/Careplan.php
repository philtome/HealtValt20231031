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

    #[ORM\Column(name: 'careplan_date', type: 'datetime', nullable: false)] //may not be null, (required)
    public DateTime $careplan_date;

    #[ORM\Column(name: 'careplan_edit_date', type: 'datetime')]
    public DateTime $careplan_edit_date;

    #[ORM\Column(type: 'string', length: 255)]
    public string|null $present_health; //dont neeed name,| allows it to be a null

    #[ORM\Column(type: 'string', length: 100)]
    public string $assistive_devices; //dont neeed name

    #[ORM\Column(type: 'text')]
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
    public function getCareplanDate(): DateTime
    {
        return $this->careplan_date;
    }

    /**
     * @param DateTime $careplan_date
     * @return Careplan
     */
    public function setCareplanDate(DateTime $careplan_date): Careplan
    {
        $this->careplan_date = $careplan_date;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCareplanEditDate(): DateTime
    {
        return $this->careplan_edit_date;
    }

    /**
     * @param DateTime $careplan_edit_date
     * @return Careplan
     */
    public function setCareplanEditDate(DateTime $careplan_edit_date): Careplan
    {
        $this->careplan_edit_date = $careplan_edit_date;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPresentHealth(): ?string
    {
        return $this->present_health;
    }

    /**
     * @param string|null $present_health
     * @return Careplan
     */
    public function setPresentHealth(?string $present_health): Careplan
    {
        $this->present_health = $present_health;
        return $this;
    }

    /**
     * @return string
     */
    public function getAssistiveDevices(): string
    {
        return $this->assistive_devices;
    }

    /**
     * @param string $assistive_devices
     * @return Careplan
     */
    public function setAssistiveDevices(string $assistive_devices): Careplan
    {
        $this->assistive_devices = $assistive_devices;
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