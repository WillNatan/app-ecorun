<?php

namespace App\Entity;

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
     * @ORM\Column(type="integer")
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

    public function getNumDevis(): ?int
    {
        return $this->numDevis;
    }

    public function setNumDevis(int $numDevis): self
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
}
