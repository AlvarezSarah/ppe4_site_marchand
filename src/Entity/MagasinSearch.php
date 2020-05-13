<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class MagasinSearch {



    /**
     * @var string|null
     */

    private $nom;

    /**
     * @var integer|null
     */

    private $distance;

    /**
     * @var float|null
     */

    private $lat;

    /**
     * @var float|null
     */

    private $lng;

    /**
     * @return null|string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param null|string $libelle
     * @return MagasinSearch
     */
    public function setNom(?string $nom): MagasinSearch
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     * @return MagasinSearch
     */
    public function setDistance(?int $distance): MagasinSearch
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float|null $lat
     * @return MagasinSearch
     */
    public function setLat(?float $lat): MagasinSearch
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @param float|null $lng
     * @return MagasinSearch
     */
    public function setLng(?float $lng): MagasinSearch
    {
        $this->lng = $lng;
        return $this;
    }


}


