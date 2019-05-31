<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductFormRepository")
 */
class ProductForm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Devis", inversedBy="productForms")
     * @ORM\JoinColumn(name="devis_id", referencedColumnName="id")
     */
    private $Devis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="pdtForm", fetch="EAGER")
     * @ORM\JoinColumn(name="pdt_id", referencedColumnName="id")
     */
    private $name;



    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="float")
     */
    private $width;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Attributes", inversedBy="linkedproduct", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinTable(name="attributes_product_form")
     */
    private $attributes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Frais", inversedBy="product", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinTable(name="frais_product")
     */
    private $frais;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $heureFraisPose;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $heureFraisMaquette;

    /**
     * @ORM\Column(type="integer")
     */
    private $qte;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
        $this->frais = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevis(): ?Devis
    {
        return $this->Devis;
    }

    public function setDevis(?Devis $Devis): self
    {
        $this->Devis = $Devis;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getName(): ?Products
    {
        return $this->name;
    }

    public function setName(?Products $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Attributes[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attributes $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
            $attribute->addLinkedproduct($this);
        }

        return $this;
    }

    public function removeAttribute(Attributes $attribute): self
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
            $attribute->removeLinkedproduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|Frais[]
     */
    public function getFrais(): Collection
    {
        return $this->frais;
    }

    public function addFrai(Frais $frai): self
    {
        if (!$this->frais->contains($frai)) {
            $this->frais[] = $frai;
        }

        return $this;
    }

    public function removeFrai(Frais $frai): self
    {
        if ($this->frais->contains($frai)) {
            $this->frais->removeElement($frai);
        }

        return $this;
    }

    public function getHeureFraisPose(): ?float
    {
        return $this->heureFraisPose;
    }

    public function setHeureFraisPose(?float $heureFraisPose): self
    {
        $this->heureFraisPose = $heureFraisPose;

        return $this;
    }

    public function getHeureFraisMaquette(): ?float
    {
        return $this->heureFraisMaquette;
    }

    public function setHeureFraisMaquette(?float $heureFraisMaquette): self
    {
        $this->heureFraisMaquette = $heureFraisMaquette;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }
}
