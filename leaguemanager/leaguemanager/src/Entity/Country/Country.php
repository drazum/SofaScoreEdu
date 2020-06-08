<?php


namespace App\Entity\Country;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 * @ORM\Embeddable()
 * @package App\Entity\Country
 */
class Country extends CountryData
{
    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private ?string $iso = null;

    /**
     * @param string $iso
     */
    public function setIso(string $iso): void
    {
        $this->iso = $iso;
    }

    /**
     * @return string
     */
    public function getIso(): string
    {
        return $this->iso;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        // TODO: just return from parent
        return null;
    }
}