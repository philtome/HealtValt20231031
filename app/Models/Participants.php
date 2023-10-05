<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; //needed?
use Doctrine\Common\Collections\Collection;  //needed?

#[ORM\Table(name: 'participants')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class Participants
{
    public function __construct()
    {
        $this->assessments = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    public int $id;

    #[ORM\OneToMany(targetEntity: 'Assessments', mappedBy: 'participant')]
    public $assessments;


    #[ORM\Column(name: 'lastName', type: 'string', nullable: false)] //may not be null, (required)
    protected string $lastName;

    #[ORM\Column(name: 'firstName', type: 'string', nullable: false)]
    protected string $firstName;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected string|null $streetAddress1; //dont neeed name,| allows it to be a null

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected string|null $streetAddress2;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected string|null $city;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    protected string|null $state;

    #[ORM\Column(type: 'string', length: 12, nullable: true)]
    protected string|null $zip;


    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    protected string|null $phone;

    #[ORM\Column(type: 'text', nullable: true)]
    protected string|null $notes;

    #[ORM\ManyToOne(targetEntity: 'Contacts', fetch: 'EAGER')]
    public $responsibleParty;



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
     * @return Collection
     */
    public function getAssessments(): Collection
    {
        return $this->assessments;
    }

    /**
     * @param ArrayCollection $assessments
     * @return Participants
     */
    public function setAssessments(ArrayCollection $assessments): Participants
    {
        $this->assessments = $assessments;
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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    } //dont neeed name

    public function getResponsibleParty()
    {
        return $this->responsibleParty;
    }

    public function setResponsibleParty($responsibleParty)
    {
        $this->responsibleParty = $responsibleParty;
    }


}