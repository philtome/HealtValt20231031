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
    protected string $doc1Desc;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string $doc2Desc;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string $contactsDesc;

    #[ORM\Column(name: 'lastName', type: 'string', nullable: true)]
    protected string|null $participantDesc;

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
    public function getDoc11Desc(): string
    {
        return $this->doc11Desc;
    }

    /**
     * @param string $doc11Desc
     */
    public function setDoc11Desc(string $doc11Desc): void
    {
        $this->doc11Desc = $doc11Desc;
    }

    /**
     * @return string
     */
    public function getDoc2Desc(): string
    {
        return $this->doc12Desc;
    }

    /**
     * @param string $doc12Desc
     */
    public function setDoc2Desc(string $doc12Desc): void
    {
        $this->doc12Desc = $doc12Desc;
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

    /**
     * @return string|null
     */
    public function getParticipantDesc(): ?string
    {
        return $this->participantDesc;
    }

    /**
     * @param string|null $participantDesc
     */
    public function setParticipantDesc(?string $participantDesc): void
    {
        $this->participantDesc = $participantDesc;
    }

}
