<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Announcer::class, mappedBy="category")
     */
    private $announcers;

    public function __construct()
    {
        $this->announcers = new ArrayCollection();
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
            $announcer->setCategory($this);
        }

        return $this;
    }

    public function removeAnnouncer(Announcer $announcer): self
    {
        if ($this->announcers->removeElement($announcer)) {
            // set the owning side to null (unless already changed)
            if ($announcer->getCategory() === $this) {
                $announcer->setCategory(null);
            }
        }

        return $this;
    }
}
