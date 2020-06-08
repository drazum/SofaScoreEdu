<?php


namespace App\Entity\Category;

use App\Entity\AbstractEntity;
use App\Entity\Sport\Sport;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Category
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 * @package App\Entity\Category
 */
class Category extends AbstractEntity
{
    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $name;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Sport::class)
     * @ORM\JoinColumn()
     * @var Collection
     */
    private Collection $sport;

    public function __construct()
    {
        $this->sport = new ArrayCollection();
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
     * @return Collection
     */
    public function getSport(): Collection
    {
        return $this->sport;
    }

    /**
     * @param Collection $sport
     */
    public function setSport(Collection $sport): void
    {
        $this->sport = $sport;
    }
}