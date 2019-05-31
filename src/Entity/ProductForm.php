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
     * @ORM\OneToMany(targetEntity="App\Entity\Attributes", mappedBy="product", cascade={"all"})
     */
    private $attributes;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="float")
     */
    private $width;

    public function __construct()
    {

        $this->attributes = new ArrayCollection();
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
            $attribute->setProduct($this);
        }

        return $this;
    }

    public function removeAttribute(Attributes $attribute): self
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
            // set the owning side to null (unless already changed)
            if ($attribute->getProduct() === $this) {
                $attribute->setProduct(null);
            }
        }

        return $this;
    }
}
