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

    #[ORM\Column(name: 'last_name', type: 'string', nullable: false)] //may not be null, (required)
    public string $last_name;

    #[ORM\Column(name: 'first_name', type: 'string', nullable: false)]
    public string $first_name;

    #[ORM\Column(type: 'string', length: 50)]
    public string|null $street_address_1; //dont neeed name,| allows it to be a null

    #[ORM\Column(type: 'string', length: 50)]
    public string|null $street_address_2; //dont neeed name

    #[ORM\Column(type: 'string', length: 50)]
    public string|null $city;

    #[ORM\Column(type: 'string', length: 25)]
    public string|null $state;

    #[ORM\Column(type: 'string', length: 12)]
    public string|null $zip;

    #[ORM\Column(type: 'string', length: 100)]
    public string|null $responsible_party;

    #[ORM\Column(type: 'string', length: 11)]
    public string|null $phone;

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
        return $this->last_name;
    }

    /**
     * @param string $last_name
     * @return Participants
     */
    public function setLastName(string $last_name): Participants
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     * @return Participants
     */
    public function setFirstname(string $first_name): Participants
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetAddress1(): ?string
    {
        return $this->street_address_1;
    }

    /**
     * @param string|null $street_address_1
     * @return Participants
     */
    public function setStreetAddress1(?string $street_address_1): Participants
    {
        $this->street_address_1 = $street_address_1;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetAddress2(): ?string
    {
        return $this->street_address_2;
    }

    /**
     * @param string|null $street_address_2
     * @return Participants
     */
    public function setStreetAddress2(?string $street_address_2): Participants
    {
        $this->street_address_2 = $street_address_2;
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
        return $this->responsible_party;
    }

    /**
     * @param string|null $responsible_party
     * @return Participants
     */
    public function setResponsibleParty(?string $responsible_party): Participants
    {
        $this->responsible_party = $responsible_party;
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