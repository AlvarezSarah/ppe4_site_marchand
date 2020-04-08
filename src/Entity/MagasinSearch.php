<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class MagasinSearch {

    /**
     * @var string|null
     */

    private $nom;

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

}


