<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DevisRepository")
 */
class Devis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modeReglement;

    /**
     * @ORM\Column(type="string")
     */
    private $numDevis;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCrea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateValid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customers", inversedBy="devis")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductForm", mappedBy="Devis", cascade={"all"})
     */
    private $productForms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaires", mappedBy="Devis")
     */
    private $commentaires;

    public function __construct()
    {
        $this->productForms = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getModeReglement(): ?string
    {
        return $this->modeReglement;
    }

    public function setModeReglement(string $modeReglement): self
    {
        $this->modeReglement = $modeReglement;

        return $this;
    }

    public function getNumDevis(): ?string
    {
        return $this->numDevis;
    }

    public function setNumDevis(string $numDevis): self
    {
        $this->numDevis = $numDevis;

        return $this;
    }

    public function getDateCrea(): ?\DateTimeInterface
    {
        return $this->dateCrea;
    }

    public function setDateCrea(\DateTimeInterface $dateCrea): self
    {
        $this->dateCrea = $dateCrea;

        return $this;
    }

    public function getDateValid(): ?\DateTimeInterface
    {
        return $this->dateValid;
    }

    public function setDateValid(\DateTimeInterface $dateValid): self
    {
        $this->dateValid = $dateValid;

        return $this;
    }

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection|ProductForm[]
     */
    public function getProductForms(): Collection
    {
        return $this->productForms;
    }

    public function addProductForm(ProductForm $productForm): self
    {
        if (!$this->productForms->contains($productForm)) {
            $this->productForms[] = $productForm;
            $productForm->setDevis($this);
        }

        return $this;
    }

    public function removeProductForm(ProductForm $productForm): self
    {
        if ($this->productForms->contains($productForm)) {
            $this->productForms->removeElement($productForm);
            // set the owning side to null (unless already changed)
            if ($productForm->getDevis() === $this) {
                $productForm->setDevis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setDevis($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getDevis() === $this) {
                $commentaire->setDevis(null);
            }
        }

        return $this;
    }
}
