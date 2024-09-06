<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'labresults')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Labresults
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\Column(type: "integer", nullable: false)] // Adjusted for mandatory user
    protected int $userID; // Added property for user ID

    #[ORM\ManyToOne(targetEntity: 'Labs', fetch: 'Eager')]
    public $labresultsName;

    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected mixed $labresultsDate;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 2, nullable: false)]
    protected float $labresultsFloatValue;

    #[ORM\Column(type: 'text', nullable: false)]
    protected string $labresultsTextValue;

//    #[ORM\Column(type: 'text', nullable: false)]
//    protected string $labresultsUnits;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected string|null $labresultsNotes;

    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected mixed $labresultsCreateDate;

    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected mixed $labresultsModifiedDate;

}