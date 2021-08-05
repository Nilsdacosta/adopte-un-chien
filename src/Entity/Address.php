<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="text")
     */
    private $zipcode;

    /**
     * @ORM\Column(type="text")
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=Announcer::class, mappedBy="address")
     */
    private $announcers;

    /**
     * @ORM\OneToMany(targetEntity=Adopter::class, mappedBy="address")
     */
    private $adopters;

    public function __construct()
    {
        $this->announcers = new ArrayCollection();
        $this->adopters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Announcer[]
     */
    public function getAnnouncers(): Collection
    {
        return $this->announcers;
    }

    public function addAnnouncer(Announcer $announcer): self
    {
        if (!$this->announcers->contains($announcer)) {
            $this->announcers[] = $announcer;
            $announcer->setAddress($this);
        }

        return $this;
    }

    public function removeAnnouncer(Announcer $announcer): self
    {
        if ($this->announcers->removeElement($announcer)) {
            // set the owning side to null (unless already changed)
            if ($announcer->getAddress() === $this) {
                $announcer->setAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adopter[]
     */
    public function getAdopters(): Collection
    {
        return $this->adopters;
    }

    public function addAdopter(Adopter $adopter): self
    {
        if (!$this->adopters->contains($adopter)) {
            $this->adopters[] = $adopter;
            $adopter->setAddress($this);
        }

        return $this;
    }

    public function removeAdopter(Adopter $adopter): self
    {
        if ($this->adopters->removeElement($adopter)) {
            // set the owning side to null (unless already changed)
            if ($adopter->getAddress() === $this) {
                $adopter->setAddress(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNumber().' '.$this->getStreet().' '.$this->getZipcode(). ' '.$this->getCity();
    }
}
