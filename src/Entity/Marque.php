<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Produit;


/**
 * Marque
 *
 * @ORM\Table(name="marque")
 * @ORM\Entity(repositoryClass="App\Repository\MarqueRepository")
 */
class Marque
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle", type="string", length=50, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", inversedBy="Marques")
     */
    private $idProduit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdProduit(): Collection
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Collection $idProduit): self
    {
        $this->idProduitd = $idProduit;

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }

    public function removeIdProduit(Produit $produit): self
    {
        if ($this->idProduit->contains($produit)) {
            $this->idProduit->removeElement($produit);
            $produit->removeMarque($this);
        }

        return $this;
    }
}

