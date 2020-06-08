<?php


namespace App\Entity\Score;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Score
 * @ORM\Embeddable()
 * @package App\Entity\Score
 */
class Score
{
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $halfTime = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $overTime = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $final = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $firstQuarter = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $secondQuarter = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $thirdQuarter = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private ?int $fourthQuarter = null;

    /**
     * @return int
     */
    public function getHalfTime(): int
    {
        return $this->halfTime;
    }

    /**
     * @param int $halfTime
     */
    public function setHalfTime(int $halfTime): void
    {
        $this->halfTime = $halfTime;
    }

    /**
     * @return int
     */
    public function getOverTime(): int
    {
        return $this->overTime;
    }

    /**
     * @param int $overTime
     */
    public function setOverTime(int $overTime): void
    {
        $this->overTime = $overTime;
    }

    /**
     * @return int
     */
    public function getFinal(): int
    {
        return $this->final;
    }

    /**
     * @param int $final
     */
    public function setFinal(int $final): void
    {
        $this->final = $final;
    }

    /**
     * @return int
     */
    public function getFirstQuarter(): int
    {
        return $this->firstQuarter;
    }

    /**
     * @param int $firstQuarter
     */
    public function setFirstQuarter(int $firstQuarter): void
    {
        $this->firstQuarter = $firstQuarter;
    }

    /**
     * @return int
     */
    public function getSecondQuarter(): int
    {
        return $this->secondQuarter;
    }

    /**
     * @param int $secondQuarter
     */
    public function setSecondQuarter(int $secondQuarter): void
    {
        $this->secondQuarter = $secondQuarter;
    }

    /**
     * @return int
     */
    public function getThirdQuarter(): int
    {
        return $this->thirdQuarter;
    }

    /**
     * @param int $thirdQuarter
     */
    public function setThirdQuarter(int $thirdQuarter): void
    {
        $this->thirdQuarter = $thirdQuarter;
    }

    /**
     * @return int
     */
    public function getFourthQuarter(): int
    {
        return $this->fourthQuarter;
    }

    /**
     * @param int $fourthQuarter
     */
    public function setFourthQuarter(int $fourthQuarter): void
    {
        $this->fourthQuarter = $fourthQuarter;
    }

}