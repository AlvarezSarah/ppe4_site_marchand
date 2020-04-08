<?php

namespace App\Entity;


use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Licence", inversedBy="produits")
     */
    private $idLicence;



    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Marque", inversedBy="produits")
     */
    private $idMarque;


    /**
     * @var string|null
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="taille", type="string", length=255, nullable=true)
     */
    private $taille;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prixht", type="string", length=50, nullable=true)
     */
    private $prixht;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stock", type="string", length=50, nullable=true)
     */
    private $stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    /**
     * @return string|null
     */
    public function getTaille(): ?string
    {
        return $this->taille;
    }

    /**
     * @param string|null $taille
     */
    public function setTaille(?string $taille): void
    {
        $this->taille = $taille;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixht(): ?string
    {
        return $this->prixht;
    }

    public function setPrixht(?string $prixht): self
    {
        $this->prixht = $prixht;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(?string $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection|Licence[]
     */
    public function getIdLicence(): ?Collection
    {
        return $this->idLicence;
    }

    public function setIdLicence(?Collection $idLicence): self
    {
        $this->idLicence = $idLicence;

        return $this;
    }

    public function removeIdLicence(Licence $licence): self
    {
        if ($this->idLicence->contains($licence)) {
            $this->idLicence->removeElement($licence);
            $licence->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Marque[]
     */
    public function getIdMarque(): ?Collection
    {
        return $this->idMarque;
    }

    public function setIdMarque(?Collection $idMarque): self
    {
        $this->idMarque = $idMarque;

        return $this;
    }

    public function removeIdMarque(Marque $marque): self
    {
        if ($this->idMarque->contains($marque)) {
            $this->idMarque->removeElement($marque);
            $marque->removeProduit($this);
        }

        return $this;
    }
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->libelle);
    }

}
