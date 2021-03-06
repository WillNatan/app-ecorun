<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributesRepository")
 */
class Attributes
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
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProductForm", mappedBy="attributes", fetch="EAGER", orphanRemoval=true)
     */
    private $linkedproduct;



    public function __construct()
    {
        $this->linkedproduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
    public function getLinkedproduct(): Collection
    {
        return $this->linkedproduct;
    }

    public function addLinkedproduct(ProductForm $linkedproduct): self
    {
        if (!$this->linkedproduct->contains($linkedproduct)) {
            $this->linkedproduct[] = $linkedproduct;
        }

        return $this;
    }

    public function removeLinkedproduct(ProductForm $linkedproduct): self
    {
        if ($this->linkedproduct->contains($linkedproduct)) {
            $this->linkedproduct->removeElement($linkedproduct);
        }

        return $this;
    }
    
}
