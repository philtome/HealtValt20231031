<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'assessments')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Assessments
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int $id;

    #[ORM\ManyToOne(targetEntity: 'Participants', inversedBy: 'assessments')]
    #[ORM\JoinColumn(name: 'participant_id', referencedColumnName: 'id')]
    private $participant;


    #[ORM\Column(name: 'date', type:'datetime', nullable: false)]
    protected $date;

    #[ORM\Column(name: 'seniorAdult', type: 'string', length: 50, nullable: true)]
    protected string|null $seniorAdult;

    #[ORM\Column(name: 'absent', type: 'string', length: 10, nullable: true)]
    protected string|null $absent;
    // No (oif unvalued on screen), Ill, Persaonal, vacation

    #[ORM\Column(name: 'outing', type: 'string', length: 50, nullable: true)]
    protected string|null $outing;

    #[ORM\Column(name: 'inHouseAct', type: 'string', length: 50, nullable: true)]
    protected string|null $inHouseAct;

    #[ORM\Column(name: 'indySkillsDevelop', type: 'string', length: 50, nullable: true)]
    protected string|null $indyskilsdev;


    #[ORM\Column(name: 'volunteer', type: 'string', length: 50, nullable: true)]
    protected string|null $volunteer;

    #[ORM\Column(name: 'art', type: 'string', length: 50, nullable: true)]
    protected string|null $art;

    #[ORM\Column(name: 'crafts', type: 'string', length: 50, nullable: true)]
    protected string|null $crafts;

    #[ORM\Column(name: 'dance', type: 'string', length: 50, nullable: true)]
    protected string|null $dance;

    #[ORM\Column(name: 'music', type: 'string', length: 50, nullable: true)]
    protected string|null $music;

    #[ORM\Column(name: 'exercise', type: 'string', length: 50, nullable: true)]
    protected string|null $exercise;

    #[ORM\Column(name: 'toilet', type: 'string', length: 50, nullable: true)]
    protected string|null $toilet;

    #[ORM\Column(name: 'grooming', type: 'string', length: 50, nullable: true)]
    protected string|null $grooming;

    #[ORM\Column(name: 'reading', type: 'string', length: 50, nullable: true)]
    protected string|null $reading;

    #[ORM\Column(name: 'writing', type: 'string', length: 50, nullable: true)]
    protected string|null $writing;

    #[ORM\Column(name: 'eddevelopment', type: 'string', length: 50, nullable: true)]
    protected string|null $eddevelopment;

    #[ORM\Column(name: 'socializing', type: 'string', length: 50, nullable: true)]
    protected string|null $socializing;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param mixed $participant
     * @return Assessments
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getSeniorAdult(): ?string
    {
        return $this->seniorAdult;
    }

    public function setSeniorAdult(?string $seniorAdult): void
    {
        $this->seniorAdult = $seniorAdult;
    }

    public function getAbsent(): ?string
    {
        return $this->absent;
    }

    public function setAbsent(?string $absent): void
    {
        $this->absent = $absent;
    }

    public function getOuting(): ?string
    {
        return $this->outing;
    }

    public function setOuting(?string $outing): void
    {
        $this->outing = $outing;
    }

    public function getInHouseAct(): ?string
    {
        return $this->inHouseAct;
    }

    public function setInHouseAct(?string $inHouseAct): void
    {
        $this->inHouseAct = $inHouseAct;
    }


    /**
     * @return string|null
     */
    public function getIndyskilsdev(): ?string
    {
        return $this->indyskilsdev;
    }

    /**
     * @param string|null $indyskilsdev
     */
    public function setIndyskilsdev(?string $indyskilsdev): void
    {
        $this->indyskilsdev = $indyskilsdev;
    }


    public function getVolunteer(): ?string
    {
        return $this->volunteer;
    }

    public function setVolunteer(?string $volunteer): void
    {
        $this->volunteer = $volunteer;
    }

    public function getArt(): ?string
    {
        return $this->art;
    }

    public function setArt(?string $art): void
    {
        $this->art = $art;
    }

    public function getCrafts(): ?string
    {
        return $this->crafts;
    }

    public function setCrafts(?string $crafts): void
    {
        $this->crafts = $crafts;
    }

    public function getDance(): ?string
    {
        return $this->dance;
    }

    public function setDance(?string $dance): void
    {
        $this->dance = $dance;
    }

    public function getMusic(): ?string
    {
        return $this->music;
    }

    public function setMusic(?string $music): void
    {
        $this->music = $music;
    }

    public function getExercise(): ?string
    {
        return $this->exercise;
    }

    public function setExercise(?string $exercise): void
    {
        $this->exercise = $exercise;
    }

    public function getToilet(): ?string
    {
        return $this->toilet;
    }

    public function setToilet(?string $toilet): void
    {
        $this->toilet = $toilet;
    }

    public function getGrooming(): ?string
    {
        return $this->grooming;
    }

    public function setGrooming(?string $grooming): void
    {
        $this->grooming = $grooming;
    }

    public function getReading(): ?string
    {
        return $this->reading;
    }

    public function setReading(?string $reading): void
    {
        $this->reading = $reading;
    }

    public function getWriting(): ?string
    {
        return $this->writing;
    }

    public function setWriting(?string $writing): void
    {
        $this->writing = $writing;
    }

    public function getEddevelopment(): ?string
    {
        return $this->eddevelopment;
    }

    public function setEddevelopment(?string $eddevelopment): void
    {
        $this->eddevelopment = $eddevelopment;
    }

    public function getSocializing(): ?string
    {
        return $this->socializing;
    }

    public function setSocializing(?string $socializing): void
    {
        $this->socializing = $socializing;
    }

    public function getCurrentEvents(): ?string
    {
        return $this->currentEvents;
    }

    public function setCurrentEvents(?string $currentEvents): void
    {
        $this->currentEvents = $currentEvents;
    }

    public function getLunch(): ?string
    {
        return $this->lunch;
    }

    public function setLunch(?string $lunch): void
    {
        $this->lunch = $lunch;
    }

    public function getSnack(): ?string
    {
        return $this->snack;
    }

    public function setSnack(?string $snack): void
    {
        $this->snack = $snack;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    #[ORM\Column(name: 'currentEvents', type: 'string', length: 50, nullable: true)]
    protected string|null $currentEvents;

    #[ORM\Column(name: 'lunch', type: 'string', length: 50, nullable: true)]
    protected string|null $lunch;

    #[ORM\Column(name: 'snack', type: 'string', length: 50, nullable: true)]
    protected string|null $snack;


    #[ORM\Column(name: 'notes', type: 'string', nullable: true)]
    protected string|null $notes;


}


