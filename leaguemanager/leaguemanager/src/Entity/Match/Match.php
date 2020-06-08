<?php


namespace App\Entity\Match;

use App\Entity\AbstractEntity;
use App\Entity\Competition\Competition;
use App\Entity\Competitor\Competitor;
use App\Entity\Score\Score;
use App\Entity\Season\Season;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class Match
 * @ORM\MappedSuperclass(repositoryClass="App\Repository\Match\MatchRepository")
 * @package App\Entity\Match
 */
abstract class Match extends AbstractEntity
{
    protected const NOT_STARTED = 0;
    protected const PAUSE = 1;
    protected const CANCELED = 2;
    protected const ENDED = 3;

    /**
     * @ORM\ManyToOne(targetEntity=Competitor::class)
     * @var Competitor
     */
    protected Competitor $homeCompetitor;

    /**
     * @ORM\ManyToOne(targetEntity=Competitor::class)
     * @var Competitor
     */
    protected Competitor $awayCompetitor;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected DateTime $matchStart;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $status;

    /**
     * @ORM\ManyToOne(targetEntity=Competition::class)
     * @var Competition
     */
    protected Competition $competition;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class)
     * @var Season
     */
    protected Season $season;

    /**
     * @ORM\Embedded(class="App\Entity\Score\Score")
     * @var Score
     */
    protected Score $homeScore;

    /**
     * @ORM\Embedded(class="App\Entity\Score\Score")
     * @var Score
     */
    protected Score $awayScore;

    /**
     * @var int
     */
    protected ?int $winnerCode = null;

    public function __construct()
    {
        $this->homeScore = new Score();
        $this->awayScore = new Score();
    }

    /**
     * @return Competitor
     */
    public function getHomeCompetitor(): Competitor
    {
        return $this->homeCompetitor;
    }

    /**
     * @param Competitor $homeCompetitor
     */
    public function setHomeCompetitor(Competitor $homeCompetitor): void
    {
        $this->homeCompetitor = $homeCompetitor;
    }

    /**
     * @return Competitor
     */
    public function getAwayCompetitor(): Competitor
    {
        return $this->awayCompetitor;
    }

    /**
     * @param Competitor $awayCompetitor
     */
    public function setAwayCompetitor(Competitor $awayCompetitor): void
    {
        $this->awayCompetitor = $awayCompetitor;
    }

    /**
     * @return DateTime
     */
    public function getMatchStart(): DateTime
    {
        return $this->matchStart;
    }

    /**
     * @param DateTime $matchStart
     */
    public function setMatchStart(DateTime $matchStart): void
    {
        $this->matchStart = $matchStart;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Competition
     */
    public function getCompetition(): Competition
    {
        return $this->competition;
    }

    /**
     * @param Competition $competition
     */
    public function setCompetition(Competition $competition): void
    {
        $this->competition = $competition;
    }

    /**
     * @return Season
     */
    public function getSeason(): Season
    {
        return $this->season;
    }

    /**
     * @param Season $season
     */
    public function setSeason(Season $season): void
    {
        $this->season = $season;
    }

    /**
     * @return Score
     */
    public function getHomeScore(): Score
    {
        return $this->homeScore;
    }

    /**
     * @param Score $homeScore
     */
    public function setHomeScore(Score $homeScore): void
    {
        $this->homeScore = $homeScore;
    }

    /**
     * @return Score
     */
    public function getAwayScore(): Score
    {
        return $this->awayScore;
    }

    /**
     * @param Score $awayScore
     */
    public function setAwayScore(Score $awayScore): void
    {
        $this->awayScore = $awayScore;
    }

    /**
     * @return int
     */
    public function getWinnerCode(): int
    {
        return $this->winnerCode;
    }

    /**
     * @param int $winnerCode
     */
    public function setWinnerCode(int $winnerCode): void
    {
        $this->winnerCode = $winnerCode;
    }
}