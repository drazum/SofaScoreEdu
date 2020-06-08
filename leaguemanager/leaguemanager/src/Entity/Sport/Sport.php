<?php


namespace App\Entity\Sport;

use App\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Sport
 * @ORM\Entity(repositoryClass="App\Repository\Sport\SportRepository")
 * @package App\Entity\Sport
 */
class Sport extends AbstractEntity
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
}