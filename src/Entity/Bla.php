<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlaRepository")
 */
class Bla
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Blo", mappedBy="blas", cascade={"all"})
     *
     */
    private $Blo;

    public function __construct()
    {
        $this->Blo = new ArrayCollection();
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
     * @return Collection|Blo[]
     */
    public function getBlo(): Collection
    {
        return $this->Blo;
    }

    public function addBlo(Blo $blo): self
    {
        if (!$this->Blo->contains($blo)) {
            $this->Blo[] = $blo;
        }

        return $this;
    }

    public function removeBlo(Blo $blo): self
    {
        if ($this->Blo->contains($blo)) {
            $this->Blo->removeElement($blo);
        }

        return $this;
    }
}
