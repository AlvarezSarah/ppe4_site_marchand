<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Magasin
 *
 * @ORM\Table(name="magasin", indexes={@ORM\Index(name="id_image", columns={"id_image"}), @ORM\Index(name="id_adresse", columns={"id_adresse"})})
 * @ORM\Entity
 * @Vich\Uploadable()
 */
class Magasin
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
     * @ORM\Column(name="horaire_ouverture", type="string", length=500, nullable=true)
     */
    private $horaireOuverture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="float", scale=4, precision=7)
     */
    private $lng;

    /**
     * @ORM\Column(type="float", scale=4, precision=6)
     */
    private $lat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_postal", type="string", length=250, nullable=true)
     */
    private $codePostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=250, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="departement", type="string", length=50, nullable=true)
     */
    private $departement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pays", type="string", length=50, nullable=true)
     */
    private $pays;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="courriel", type="string", length=50, nullable=true)
     */
    private $courriel;


    /**
     * @var string|null
     * @ORM\Column(name="filename", type="string", length=255)
     */

    private $filename;

    /**
     * @var File|null
     * @Assert\Image (
     *      mimeTypes="image/jpeg")
     * @Vich\UploadableField(mapping="magasin_image", fileNameProperty="filename")
     */

    private $imageFile;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", inversedBy="magasins")
     */
    private $idProduit;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraireOuverture(): ?string
    {
        return $this->horaireOuverture;
    }

    public function setHoraireOuverture(?string $horaireOuverture): self
    {
        $this->horaireOuverture = $horaireOuverture;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(?string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCourriel(): ?string
    {
        return $this->courriel;
    }

    public function setCourriel(?string $courriel): self
    {
        $this->courriel = $courriel;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->nom);
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Magasin
     */
    public function setFilename(?string $filename): Magasin
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Magasin
     */
    public function setImageFile(?File $imageFile): Magasin
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getIdProduit(): ?Collection
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Collection $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    public function removeIdProduit(Produit $produit): self
    {
        if ($this->idProduit->contains($produit)) {
            $this->idProduit->removeElement($produit);
            $produit->removeMagasin($this);
        }

        return $this;
    }


}


