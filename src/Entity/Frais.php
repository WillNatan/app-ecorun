<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FraisRepository")
 */
class Frais
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
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProductForm", mappedBy="frais", fetch="EAGER", orphanRemoval=true)
     */

    private $product;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|ProductForm[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(ProductForm $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
            $product->addFrai($this);
        }

        return $this;
    }

    public function removeProduct(ProductForm $product): self
    {
        if ($this->product->contains($product)) {
            $this->product->removeElement($product);
            $product->removeFrai($this);
        }

        return $this;
    }
}
