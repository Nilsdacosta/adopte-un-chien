<?php

namespace App\Entity;

use App\Repository\RequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RequestRepository::class)
 */
class Request
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="request")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity=Advertisement::class, inversedBy="requests")
     */
    private $advertisement;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfRequest;



    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setRequest($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getRequest() === $this) {
                $message->setRequest(null);
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

    public function getDateOfRequest(): ?\DateTimeInterface
    {
        return $this->dateOfRequest;
    }

    public function setDateOfRequest(\DateTimeInterface $dateOfRequest): self
    {
        $this->dateOfRequest = $dateOfRequest;

        return $this;
    }
}
