<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'contacts')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class Contacts
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    public int $id;

    #[ORM\Column(name: 'lastName', type: 'string', nullable: true)] //may not be null, (required)
    protected string|null $lastName;

    #[ORM\Column(name: 'firstName', type: 'string', nullable: true)]
    public string|null $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $contactType; //dont neeed name,| allows it to be a null

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $companyPractice; //dont neeed name

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected string|null $email; //dont neeed name

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    protected string|null $phone;

    #[ORM\Column(type: 'boolean')]
    protected $isDriver = false;

    #[ORM\Column(type: 'boolean')]
    protected $isEmployee = false;

    #[ORM\Column(type: 'boolean')]
    protected $isCaregiver = false;

    #[ORM\Column(type: 'boolean')]
    protected $isCna = false;

    #[ORM\Column(type: 'boolean')]
    protected $isRn = false;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    protected string|null $address1; //dont neeed name

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    protected string|null $address2; //dont neeed name

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    public string|null $city;

    #[ORM\Column(type: 'string', length: 25, nullable: true)]
    public string|null $state;

    #[ORM\Column(type: 'string', length: 12, nullable: true)]
    public string|null $zip;

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    protected string|null $phone1;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getContactType(): ?string
    {
        return $this->contactType;
    }

    public function setContactType(?string $contactType): void
    {
        $this->contactType = $contactType;
    }

    public function getCompanyPractice(): ?string
    {
        return $this->companyPractice;
    }

    public function setCompanyPractice(?string $companyPractice): void
    {
        $this->companyPractice = $companyPractice;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function isDriver(): bool
    {
        return $this->isDriver;
    }

    public function setIsDriver(bool $isDriver): void
    {
        $this->isDriver = $isDriver;
    }

    public function isEmployee(): bool
    {
        return $this->isEmployee;
    }

    public function setIsEmployee(bool $isEmployee): void
    {
        $this->isEmployee = $isEmployee;
    }

    public function isCaregiver(): bool
    {
        return $this->isCaregiver;
    }

    public function setIsCaregiver(bool $isCaregiver): void
    {
        $this->isCaregiver = $isCaregiver;
    }

    public function isCna(): bool
    {
        return $this->isCna;
    }

    public function setIsCna(bool $isCna): void
    {
        $this->isCna = $isCna;
    }

    public function isRn(): bool
    {
        return $this->isRn;
    }

    public function setIsRn(bool $isRn): void
    {
        $this->isRn = $isRn;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): void
    {
        $this->address1 = $address1;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): void
    {
        $this->address2 = $address2;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): void
    {
        $this->zip = $zip;
    }

    public function getPhone1(): ?string
    {
        return $this->phone1;
    }

    public function setPhone1(?string $phone1): void
    {
        $this->phone1 = $phone1;
    }

    public function getPhone1x(): ?string
    {
        return $this->phone1x;
    }

    public function setPhone1x(?string $phone1x): void
    {
        $this->phone1x = $phone1x;
    }

    public function getPhone2(): ?string
    {
        return $this->phone2;
    }

    public function setPhone2(?string $phone2): void
    {
        $this->phone2 = $phone2;
    }

    public function getPhone2x(): ?string
    {
        return $this->phone2x;
    }

    public function setPhone2x(?string $phone2x): void
    {
        $this->phone2x = $phone2x;
    }

    public function getPhone3(): ?string
    {
        return $this->phone3;
    }

    public function setPhone3(?string $phone3): void
    {
        $this->phone3 = $phone3;
    }

    public function getPhone3x(): ?string
    {
        return $this->phone3x;
    }

    public function setPhone3x(?string $phone3x): void
    {
        $this->phone3x = $phone3x;
    } //dont neeed name

    #[ORM\Column(type: 'string', length: 6, nullable: true)]
    protected string|null $phone1x; //dont neeed name

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    protected string|null $phone2; //dont neeed name

    #[ORM\Column(type: 'string', length: 6, nullable: true)]
    protected string|null $phone2x; //dont neeed name

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    protected string|null $phone3; //dont neeed name

    #[ORM\Column(type: 'string', length: 6, nullable: true)]
    protected string|null $phone3x; //dont neeed name

}