<?php

namespace App\Entity;

use App\Repository\DogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DogRepository::class)
 */
class Dog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Le nom du chien doit faire au moins {{ limit }} charactères"
     * )
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Breed::class, mappedBy="dogs")
     */
    private $breeds;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOB;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $history;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lof;

    /**
     * @ORM\Column(type="boolean")
     */
    private $acceptCats;

    /**
     * @ORM\Column(type="boolean")
     */
    private $acceptDogs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdopted = false;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="dog", orphanRemoval=true)
     */
    private $pictures;


    /**
     * @ORM\ManyToOne(targetEntity=Advertisement::class, inversedBy="dogs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advertisement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sex;

    public function __construct()
    {
        $this->breeds = new ArrayCollection();
        $this->pictures = new ArrayCollection();
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
     * @return Collection|Breed[]
     */
    public function getBreeds(): Collection
    {
        return $this->breeds;
    }

    public function addBreed(Breed $breed): self
    {
        if (!$this->breeds->contains($breed)) {
            $this->breeds[] = $breed;
            $breed->addDog($this);
        }

        return $this;
    }

    public function removeBreed(Breed $breed): self
    {
        if ($this->breeds->removeElement($breed)) {
            $breed->removeDog($this);
        }

        return $this;
    }

    public function getDateOB(): ?\DateTimeInterface
    {
        return $this->dateOB;
    }

    public function setDateOB(?\DateTimeInterface $dateOB): self
    {
        $this->dateOB = $dateOB;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getLof(): ?bool
    {
        return $this->lof;
    }

    public function setLof(bool $lof): self
    {
        $this->lof = $lof;

        return $this;
    }

    public function getAcceptCats(): ?bool
    {
        return $this->acceptCats;
    }

    public function setAcceptCats(bool $acceptCats): self
    {
        $this->acceptCats = $acceptCats;

        return $this;
    }

    public function getAcceptDogs(): ?bool
    {
        return $this->acceptDogs;
    }

    public function setAcceptDogs(bool $acceptDogs): self
    {
        $this->acceptDogs = $acceptDogs;

        return $this;
    }

    public function getIsAdopted(): ?bool
    {
        return $this->isAdopted;
    }

    public function setIsAdopted(bool $isAdopted): self
    {
        $this->isAdopted = $isAdopted;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setDog($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getDog() === $this) {
                $picture->setDog(null);
            }
        }

        return $this;
    }

    public function getAdvertisement(): ?Advertisement
    {
        return $this->advertisement;
    }

    public function setAdvertisement(?Advertisement $advertisement): self
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    public function getSex(): ?bool
    {
        return $this->sex;
    }

    public function setSex(bool $sex): self
    {
        $this->sex = $sex;

        return $this;
    }
}
