<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *     min=200,
     *     max=12000,
     *     minMessage="Votre message doit contenir au minimum 200 caractères.",
     *     maxMessage="Votre message doit contenir au maximum 12000 caractères."
     * )
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfSending;

    /**
     * @ORM\ManyToOne(targetEntity=ContactRequest::class, inversedBy="messages")
     */
    private $request;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     */
    private $isRead;

    public function __construct()
    {
        $this->dateOfSending = new \DateTime('now');
        $this->isRead = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDateOfSending(): ?\DateTimeInterface
    {
        return $this->dateOfSending;
    }

    public function setDateOfSending(\DateTimeInterface $dateOfSending): self
    {
        $this->dateOfSending = $dateOfSending;

        return $this;
    }

    public function getRequest(): ?ContactRequest
    {
        return $this->request;
    }

    public function setRequest(?ContactRequest $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function getIsRead(): ?bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }
}
