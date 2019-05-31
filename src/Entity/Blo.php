<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BloRepository")
 */
class Blo
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Bla", inversedBy="Blo", cascade={"all"})
     *@ORM\JoinTable(name="bla_blo")
     */
    private $blas;

    public function __construct()
    {
        $this->blas = new ArrayCollection();
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

    /**
     * @return Collection|Bla[]
     */
    public function getBlas(): Collection
    {
        return $this->blas;
    }

    public function addBla(Bla $bla): self
    {
        if (!$this->blas->contains($bla)) {
            $this->blas[] = $bla;
            $bla->addBlo($this);
        }

        return $this;
    }

    public function removeBla(Bla $bla): self
    {
        if ($this->blas->contains($bla)) {
            $this->blas->removeElement($bla);
            $bla->removeBlo($this);
        }

        return $this;
    }
}
