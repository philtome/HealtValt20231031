<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'settings')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class Settings
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: 'string', length: 255)]
    protected string $uid;

    #[ORM\Column(type: 'string', length: 255,nullable: true)]
    protected string $visitDesc;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string $patientDesc;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string $contactsDesc;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     */
    public function setUid(string $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getVisitDesc(): string
    {
        return $this->visitDesc;
    }

    /**
     * @param string $visitDesc
     */
    public function setVisitDesc(string $visitDesc): void
    {
        $this->visitDesc = $visitDesc;
    }

    /**
     * @return string
     */
    public function getPatientDesc(): string
    {
        return $this->patientDesc;
    }

    /**
     * @param string $patientDesc
     */
    public function setPatientDesc(string $patientDesc): void
    {
        $this->patientDesc = $patientDesc;
    }

    /**
     * @return string
     */
    public function getContactsDesc(): string
    {
        return $this->contactsDesc;
    }

    /**
     * @param string $contactsDesc
     */
    public function setContactsDesc(string $contactsDesc): void
    {
        $this->contactsDesc = $contactsDesc;
    }

}
