<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class ProduitSearch {

    /**
     * @var ArrayCollection
     */

    private $licences;

    /**
     * @var string|null
     */

    private $libelle;

    /**
     * @var ArrayCollection
     */

    private $marques;

    public function __construct()

    {
        $this->licences = new ArrayCollection();
        $this->marques = new ArrayCollection();
    }

    /**
     * @return ArrayCollection $licences
     */

    public function getLicences(): ArrayCollection
    {
        return $this->licences;
    }

    /**
     * @param ArrayCollection $licences
     */

    public function setLicences (ArrayCollection $licences): void
    {
        $this->licences = $licences;
    }

    /**
     * @return null|string
     */
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    /**
     * @param null|string $libelle
     * @return ProduitSearch
     */
    public function setLibelle(?string $libelle): ProduitSearch
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * @return ArrayCollection $marques
     */

    public function getMarques(): ArrayCollection
    {
        return $this->marques;
    }

    /**
     * @param ArrayCollection $marques
     */

    public function setMarques (ArrayCollection $marques): void
    {
        $this->marques = $marques;
    }
}

