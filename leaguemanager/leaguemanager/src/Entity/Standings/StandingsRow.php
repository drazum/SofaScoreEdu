<?php


namespace App\Entity\Standings;


use App\Entity\AbstractEntity;
use App\Entity\Competitor\Competitor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Class StandingsRow
 * @ORM\Entity(repositoryClass="App\Repository\Standings\StandingsRowRepository")
 * @package App\Entity\Standings
 */
class StandingsRow extends AbstractEntity
{
    /**
     * @ORM\ManyToOne(targetEntity=Competitor::class)
     * @Groups({"common", "common_full"})
     * @var Competitor
     */
    private Competitor $competitor;

    /**
     * @ORM\ManyToOne(targetEntity=Standings::class)
     * @Groups({"common_full"})
     * @var Standings
     */
    private Standings $standings;

    /**
     * Number of finished games
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $matches;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $wins = 0;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $losses = 0;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $scoresFor = 0;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $scoresAgainst = 0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $draws;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $points;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @var float|null
     */
    private ?float $percentage;

    public function __construct()
    {
//        $this->standings = new ArrayCollection();
    }

    /**
     * @return Competitor
     */
    public function getCompetitor(): Competitor
    {
        return $this->competitor;
    }

    /**
     * @param Competitor $competitor
     */
    public function setCompetitor(Competitor $competitor): void
    {
        $this->competitor = $competitor;
    }

    /**
     * @return Standings
     */
    public function getStandings(): Standings
    {
        return $this->standings;
    }

    /**
     * @param Standings $standings
     */
    public function setStandings(Standings $standings): void
    {
        $this->standings = $standings;
    }

    /**
     * @return int
     */
    public function getMatches(): int
    {
        return $this->matches;
    }

    /**
     * @param int $matches
     */
    public function setMatches(int $matches): void
    {
        $this->matches = $matches;
    }

    /**
     * @return int
     */
    public function getWins(): int
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     */
    public function setWins(int $wins): void
    {
        $this->wins = $wins;
    }

    /**
     * @return int
     */
    public function getLosses(): int
    {
        return $this->losses;
    }

    /**
     * @param int $losses
     */
    public function setLosses(int $losses): void
    {
        $this->losses = $losses;
    }

    /**
     * @return int
     */
    public function getScoresFor(): int
    {
        return $this->scoresFor;
    }

    /**
     * @param int $scoresFor
     */
    public function setScoresFor(int $scoresFor): void
    {
        $this->scoresFor = $scoresFor;
    }

    /**
     * @return int
     */
    public function getScoresAgainst(): int
    {
        return $this->scoresAgainst;
    }

    /**
     * @param int $scoresAgainst
     */
    public function setScoresAgainst(int $scoresAgainst): void
    {
        $this->scoresAgainst = $scoresAgainst;
    }

    /**
     * @return int
     */
    public function getDraws(): int
    {
        return $this->draws;
    }

    /**
     * @param int $draws
     */
    public function setDraws(int $draws): void
    {
        $this->draws = $draws;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    /**
     * @return int
     */
    public function getPercentage(): int
    {
        return $this->percentage;
    }

    /**
     * @param int $percentage
     */
    public function setPercentage(int $percentage): void
    {
        $this->percentage = $percentage;
    }

}