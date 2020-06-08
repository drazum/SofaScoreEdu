<?php


namespace App\Entity\Competition;


use App\Entity\AbstractEntity;
use App\Entity\Category\Category;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Competition
 * @ORM\Entity(repositoryClass="App\Repository\Competition\CompetitionRepository")
 * @package App\Entity\Competition
 */
class Competition extends AbstractEntity
{
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @var Category
     */
    private Category $category;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $seasonMatches;

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
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @param int $noOfMatches
     */
    public function setSeasonMatches(int $noOfMatches): void
    {
        $this->seasonMatches = $noOfMatches;
    }

    /**
     * @return int
     */
    public function getSeasonMatches(): int
    {
        return $this->seasonMatches;
    }
}