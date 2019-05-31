<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
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
     * @ORM\OneToMany(targetEntity="App\Entity\ProductForm", mappedBy="name", cascade={"all"})
     */
    private $pdtForm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="products")
     */
    private $category;



    public function __toString()
    {
        return (string) $this->getName();
    }

    public function __construct()
    {
        $this->pdtForm = new ArrayCollection();

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

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|ProductForm[]
     */
    public function getPdtForm(): Collection
    {
        return $this->pdtForm;
    }

    public function addPdtForm(ProductForm $pdtForm): self
    {
        if (!$this->pdtForm->contains($pdtForm)) {
            $this->pdtForm[] = $pdtForm;
            $pdtForm->setName($this);
        }

        return $this;
    }

    public function removePdtForm(ProductForm $pdtForm): self
    {
        if ($this->pdtForm->contains($pdtForm)) {
            $this->pdtForm->removeElement($pdtForm);
            // set the owning side to null (unless already changed)
            if ($pdtForm->getName() === $this) {
                $pdtForm->setName(null);
            }
        }

        return $this;
    }


}
