<?php


namespace App\Entity\Competitor;

use App\Entity\AbstractEntity;
use App\Entity\Country\Country;
use App\Entity\Sport\Sport;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Competitor
 * @ORM\Entity(repositoryClass="App\Repository\Competitor\CompetitorRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "person"=Person::class,
 *     "pair"=Pair::class,
 *     "team"=Team::class
 * })
 * @ORM\Table(name="competitor")
 *
 * @package App\Entity\Competitor
 */
abstract class Competitor extends AbstractEntity
{
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     */
    protected string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     */
    protected string $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class)
     * @var Sport
     */
    protected Sport $sport;

    /**
     * @ORM\Embedded(class="App\Entity\Country\Country")
     * @var Country
     */
    protected Country $country;

    public function __construct()
    {
        $this->country = new Country();
    }

    /**
     * @param string $iso
     */
    public function setIso(string $iso): void
    {
        $this->country->setIso($iso);
    }

    /**
     * @return string
     */
    public function getIso(): string
    {
        return $this->country->getIso();
    }

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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return Sport
     */
    public function getSport(): Sport
    {
        return $this->sport;
    }

    /**
     * @param Sport $sport
     */
    public function setSport(Sport $sport): void
    {
        $this->sport = $sport;
    }
}