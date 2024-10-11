<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'Labmasters')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Labmasters
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsName;

    #[ORM\Column(type:'datetime', nullable: false)]
    protected mixed $labsDate;

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsValueType;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    protected float $labsLowValue;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    protected float $labsHighValue;

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labsUnits;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $labsNotes;

    #[ORM\Column(type:'datetime', nullable: false)]
    protected mixed $labsCreateDate;

    #[ORM\Column(type:'datetime', nullable: true)]
    protected mixed $labsModifiedDate;






}