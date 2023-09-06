<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'participants')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class Participants
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    public int $id;

    #[ORM\Column(name: 'lastName', type: 'string', nullable: false)] //may not be null, (required)
    public string $lastName;

    #[ORM\Column(name: 'firstName', type: 'string', nullable: false)]
    public string $firstName;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    public string|null $streetAddress1; //dont neeed name,| allows it to be a null

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    public string|null $streetAddress2;

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    } //dont neeed name

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    public string|null $city;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    public string|null $state;

    #[ORM\Column(type: 'string', length: 12, nullable: true)]
    public string|null $zip;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public string|null $responsibleParty;

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    public string|null $phone;

    #[ORM\Column(type: 'text', nullable: true)]
    public string|null $notes;

    /**
     * @ManyToOne(targetEntity="Contacts")
     * @JoinColumn(name="responsible_party_id", referencedColumnName="id")
     */
    private $responsiblePartyKey;

    // ...

    public function getResponsiblePartyKey()
    {
        return $this->responsiblePartyKey;
    }

    public function setResponsiblePartyKey($responsiblePartyKey)
    {
        $this->responsiblePartyKey = $responsiblePartyKey;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Participants
     */
    public function setId(int $id): Participants
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Participants
     */
    public function setLastName(string $lastName): Participants
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Participants
     */
    public function setFirstName(string $firstName): Participants
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetAddress1(): ?string
    {
        return $this->streetAddress1;
    }

    /**
     * @param string|null $streetAddress1
     * @return Participants
     */
    public function setStreetAddress1(?string $streetAddress1): Participants
    {
        $this->streetAddress1 = $streetAddress1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetAddress2(): ?string
    {
        return $this->streetAddress2;
    }

    /**
     * @param string|null $streetAddress2
     * @return Participants
     */
    public function setStreetAddress2(?string $streetAddress2): Participants
    {
        $this->streetAddress2 = $streetAddress2;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return Participants
     */
    public function setCity(?string $city): Participants
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     * @return Participants
     */
    public function setState(?string $state): Participants
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string|null $zip
     * @return Participants
     */
    public function setZip(?string $zip): Participants
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getResponsibleParty(): ?string
    {
        return $this->responsibleParty;
    }

    /**
     * @param string|null $responsibleParty
     * @return Participants
     */
    public function setResponsibleParty(?string $responsibleParty): Participants
    {
        $this->responsibleParty = $responsibleParty;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Participants
     */
    public function setPhone(?string $phone): Participants
    {
        $this->phone = $phone;
        return $this;
    }


}