<?php


namespace App\Entity\Season;


use App\Entity\AbstractEntity;
use App\Entity\Competition\Competition;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Season
 * @ORM\Entity(repositoryClass="App\Repository\Season\SeasonRepository")
 * @package App\Entity\Season
 */
class Season extends AbstractEntity
{
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $name;

    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private \DateTime $seasonStart;

    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private \DateTime $seasonEnd;

    /**
     * @ORM\ManyToOne(targetEntity=Competition::class)
     * @var Competition
     */
    private Competition $competition;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param \DateTime $seasonStart
     */
    public function setSeasonStart(\DateTime $seasonStart): void
    {
        $this->seasonStart = $seasonStart;
    }

    /**
     * @return \DateTime
     */
    public function getSeasonStart(): \DateTime
    {
        return $this->seasonStart;
    }

    /**
     * @param \DateTime $seasonEnd
     */
    public function setSeasonEnd(\DateTime $seasonEnd): void
    {
        $this->seasonEnd = $seasonEnd;
    }

    /**
     * @return \DateTime
     */
    public function getSeasonEnd(): \DateTime
    {
        return $this->seasonEnd;
    }

    /**
     * @param Competition $competition
     */
    public function setCompetition(Competition $competition): void
    {
        $this->competition = $competition;
    }

    /**
     * @return Competition
     */
    public function getCompetition(): Competition
    {
        return $this->competition;
    }
}