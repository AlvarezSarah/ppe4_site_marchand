<?php

namespace App\Entity;

use App\Form\ProduitType;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use App\Entity\Categorie;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 * @Vich\Uploadable()
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
     * @ORM\Column(name="auteur", type="string", length=255, nullable=true)
     */
    private $auteur;

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

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */

    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="produit_image", fileNameProperty="filename")
     */

    private $imageFile;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", inversedBy="produits")
     */
    private $idCategorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande", inversedBy="produits")
     */
    private $idCommande;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", inversedBy="produits")
     */
    private $idImage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function getPrixht(): ?string
    {
        return $this->prixht;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->libelle);
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function setPrixht(?string $prixht): self
    {
        $this->prixht = $prixht;

        return $this;
    }

    public function setStock(?string $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getIdCategorie(): ?Collection
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?Collection $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    public function removeIdCategorie(Categorie $categorie): self
    {
        if ($this->idCategorie->contains($categorie)) {
            $this->idCategorie->removeElement($categorie);
            $categorie->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getIdCommande(): Collection
    {
        return $this->idCommande;
    }

    public function addIdCommande(Commande $idCommande): self
    {
        if (!$this->idCommande->contains($idCommande)) {
            $this->idCommande[] = $idCommande;
            $idCommande->addProduit($this);
        }

        return $this;
    }

    public function removeIdCommande(Commande $idCommande): self
    {
        if ($this->idCommande->contains($idCommande)) {
            $this->idCommande->removeElement($idCommande);
            $idCommande->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getIdImage(): Collection
    {
        return $this->idImage;
    }

    public function addIdImage(Image $idImage): self
    {
        if (!$this->idImage->contains($idImage)) {
            $this->idImage[] = $idImage;
            $idImage->addProduit($this);
        }

        return $this;
    }

    public function removeIdImage(Image $idImage): self
    {
        if ($this->idImage->contains($idImage)) {
            $this->idImage->removeElement($idImage);
            $idImage->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFileName(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Produit
     */
    public function setFileName(?string $filename): Produit
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
     * @return Produit
     */
    public function setImageFile(?File $imageFile): Produit
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
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



}
