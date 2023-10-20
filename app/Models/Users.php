<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'users')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

class Users
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: 'string', length: 255)]
    protected string $uid;

    #[ORM\Column(type: 'string', length: 255)]
    protected string $pwd;

    #[ORM\Column(type: 'string', length: 255)]
    protected string $email;

    #[ORM\Column(type: 'boolean', nullable: true)]
    protected bool $admin = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    protected bool $active = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected ?DateTime $lastSignon;


    // Getters and Setters:

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Users
     */
    public function setId(int $id): Users
    {
        $this->id = $id;
        return $this;
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
     * @return Users
     */
    public function setUid(string $uid): Users
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     * @return Users
     */
    public function setPwd(string $pwd): Users
    {
        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
        $this->pwd = $hashedPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Users
     */
    public function setEmail(string $email): Users
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     * @return Users
     */
    public function setAdmin(bool $admin): Users
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Users
     */
    public function setActive(bool $active): Users
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getLastSignon(): ?DateTime
    {
        return $this->lastSignon;
    }

    /**
     * @param DateTime|null $lastSignon
     * @return Users
     */
    public function setLastSignon(?DateTime $lastSignon): Users
    {
        $this->lastSignon = $lastSignon;
        return $this;
    }
}
