<?php

namespace App\Entity;

use App\Repository\AdopterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdopterRepository::class)
 */
class Adopter extends User
{
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private ?string $firstname;

    /**
     * @ORM\OneToMany(targetEntity=ContactRequest::class, mappedBy="adopter", orphanRemoval=true)
     */
    private ?Collection $requests;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="adopters", cascade={"persist"})
     */
    private ?Collection $address;

    public function __construct()
    {
        $this->requests = new ArrayCollection();
    }

    public function getRoles(): array
    {
        return ['ROLE_ADOPTER'];
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return Collection<int, ContactRequest>
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(ContactRequest $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests[] = $request;
            $request->setAdopter($this);
        }

        return $this;
    }

    public function removeRequest(ContactRequest $request): self
    {
        if ($this->requests->removeElement($request)) {
            // set the owning side to null (unless already changed)
            if ($request->getAdopter() === $this) {
                $request->setAdopter(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}
